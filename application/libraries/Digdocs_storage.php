<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Digdocs_storage
{
    const MAX_FILES = 10;
    const MAX_BYTES = 10 * 1024 * 1024;
    const TYPES = [
        'pdf' => ['application/pdf'],
        'jpg' => ['image/jpeg'],
        'jpeg' => ['image/jpeg'],
        'png' => ['image/png'],
        'webp' => ['image/webp'],
        'txt' => ['text/plain'],
        'csv' => ['text/plain', 'text/csv'],
        'docx' => ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'word/document.xml'],
        'xlsx' => ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'xl/workbook.xml'],
        'pptx' => ['application/vnd.openxmlformats-officedocument.presentationml.presentation', 'ppt/presentation.xml'],
    ];

    private $directory;

    public function __construct()
    {
        $ci =& get_instance();
        $ci->config->load('digdocs');
        $configured = $ci->config->item('digdocs_storage');
        $directory = realpath($configured);
        $webRoot = realpath($_SERVER['DOCUMENT_ROOT'] ?? '');
        $project = realpath(FCPATH);
        $mode = $directory ? fileperms($directory) : false;
        // macOS ACLs can allow adding and deleting files even when is_writable() returns false.
        // Check write access through the actual upload and deletion operations.
        if (!$directory || !$webRoot || !is_dir($directory)
            || !is_readable($directory) || $mode === false || ($mode & 0077) !== 0
            || $this->within($directory, $webRoot) || $this->within($directory, $project)
            || $this->within($webRoot, $directory) || $this->within($project, $directory)) {
            throw new RuntimeException('Penyimpanan privat arsip belum tersedia.');
        }

        $this->directory = $directory;
    }

    public function store(array $file)
    {
        $tmp = $file['tmp_name'] ?? '';
        if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK || !is_uploaded_file($tmp)) {
            throw new InvalidArgumentException('Pilih lampiran yang berhasil diunggah. Batasnya 10 MB per file.');
        }
        $size = filesize($tmp);
        if (!$size || $size > self::MAX_BYTES) {
            throw new InvalidArgumentException('Ukuran lampiran harus antara 1 byte dan 10 MB.');
        }

        $name = basename(str_replace('\\', '/', $file['name']));
        if (!mb_check_encoding($name, 'UTF-8')) {
            throw new InvalidArgumentException('Nama lampiran harus menggunakan UTF-8.');
        }
        $name = trim(preg_replace('/[\p{C}]/u', '', $name));
        $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        if (mb_strlen($name) > 255 || !isset(self::TYPES[$extension])) {
            throw new InvalidArgumentException('Format atau nama lampiran tidak diizinkan.');
        }

        $mime = (new finfo(FILEINFO_MIME_TYPE))->file($tmp);
        $allowed = self::TYPES[$extension];
        if (in_array($extension, ['docx', 'xlsx', 'pptx'], true)) {
            if (!in_array($mime, [$allowed[0], 'application/zip'], true)
                || !$this->is_office_package($tmp, $allowed[1])) {
                throw new InvalidArgumentException('Isi lampiran Office tidak cocok dengan formatnya.');
            }
            $mime = $allowed[0];
        } elseif (!in_array($mime, $allowed, true)
            || (strpos($mime, 'image/') === 0 && (@getimagesize($tmp)['mime'] ?? null) !== $mime)
            || ($mime === 'application/pdf' && file_get_contents($tmp, false, null, 0, 5) !== '%PDF-')) {
            throw new InvalidArgumentException('Isi lampiran tidak cocok dengan formatnya.');
        }

        $key = bin2hex(random_bytes(32));
        $path = $this->path($key);
        if (!@move_uploaded_file($tmp, $path)) {
            throw new RuntimeException('Lampiran gagal disimpan.');
        }
        if (!@chmod($path, 0600)) {
            $this->remove($key);
            throw new RuntimeException('Izin penyimpanan lampiran tidak dapat diatur.');
        }

        return ['original_name' => $name, 'storage_name' => $key, 'mime_type' => $mime];
    }

    public function open($key)
    {
        $path = $this->path($key);
        if (is_link($path) || !is_file($path)) {
            return false;
        }

        return @fopen($path, 'rb');
    }

    public function remove($key)
    {
        $path = $this->path($key);
        if (!@unlink($path) && file_exists($path)) {
            // The DB no longer references this file. Keep the path in the private server log for cleanup.
            error_log('digdocs: failed to remove private attachment ' . $key);
            return false;
        }
        return true;
    }

    private function path($key)
    {
        if (!preg_match('/^[a-f0-9]{64}$/D', $key)) {
            throw new RuntimeException('Referensi lampiran tidak valid.');
        }
        return $this->directory . DIRECTORY_SEPARATOR . $key;
    }

    private function within($path, $root)
    {
        return $path === $root || strpos($path, rtrim($root, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR) === 0;
    }

    private function is_office_package($path, $entry)
    {
        if (!class_exists('ZipArchive')) {
            return false;
        }

        $zip = new ZipArchive();
        if ($zip->open($path, ZipArchive::CHECKCONS) !== true) {
            return false;
        }

        $types = $zip->getFromName('[Content_Types].xml', 256 * 1024 + 1);
        $hasEntry = $zip->locateName($entry) !== false;
        $zip->close();
        if (!$hasEntry || !$types || strlen($types) > 256 * 1024) {
            return false;
        }

        $xml = new DOMDocument();
        if (!@$xml->loadXML($types, LIBXML_NONET) || $xml->doctype !== null) {
            return false;
        }

        foreach ($xml->getElementsByTagNameNS('http://schemas.openxmlformats.org/package/2006/content-types', 'Override') as $type) {
            if ($type->getAttribute('PartName') === '/' . $entry
                && preg_match('~^application/vnd\.openxmlformats-officedocument\.[a-z.]+\+xml$~D', $type->getAttribute('ContentType'))) {
                return true;
            }
        }
        return false;
    }
}
