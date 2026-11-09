<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'libraries/Digdocs_storage.php';
require_once APPPATH . 'libraries/Digdocs_preview.php';

class C_Digdocs extends CI_Controller
{
    const PAGE_SIZE = 25;

    private $actor;
    private $today;

    public function __construct()
    {
        parent::__construct();

        header('Cache-Control: private, no-store, max-age=0');
        header('Referrer-Policy: no-referrer');
        header('X-Content-Type-Options: nosniff');
        header('Cross-Origin-Resource-Policy: same-origin');
        header('X-Frame-Options: DENY');

        $this->load->model('M_Digdocs', 'archive');
        if (!$this->archive->can_access()) {
            show_error('Akses Arsip Dokumen Digital ditolak.', 403);
        }

        // Keep DB error pages and query history out of archive responses.
        $this->db->db_debug = false;
        $this->db->save_queries = false;
        $this->db->cache_off();
        if (!$this->db->db_set_charset('utf8mb4')) {
            show_error('Koneksi database arsip belum tersedia.', 503);
        }
        $this->load->library('digdocs_calendar');
        $this->actor = (int) $this->session->userdata('id');
        $this->today = $this->digdocs_calendar->today();
    }

    public function index()
    {
        try {
            $filters = [
                'q' => $this->field('get', 'q', 200),
                'category' => $this->field('get', 'category', 100),
                'status' => $this->field('get', 'status', 10),
                'from' => $this->field('get', 'from', 10),
                'to' => $this->field('get', 'to', 10),
            ];
            $this->date_value($filters['from']);
            $this->date_value($filters['to']);
            if ($filters['status'] !== '' && !isset(Digdocs_calendar::STATUSES[$filters['status']])) {
                throw new InvalidArgumentException('Pilih status dokumen yang valid.');
            }
            if ($filters['from'] !== '' && $filters['to'] !== '' && $filters['from'] > $filters['to']) {
                throw new InvalidArgumentException('Batas awal kedaluwarsa harus sebelum atau sama dengan batas akhir.');
            }
            $page = $this->input->get('page');
            $page = is_string($page) && ctype_digit($page) ? min(max(1, (int) $page), 1000000) : 1;
            $documents = $this->archive->listing($filters, $this->today->format('Y-m-d'), $page, self::PAGE_SIZE);
            $this->render('index', [
                'filters' => $filters,
                'categories' => $this->archive->categories(),
                'documents' => array_slice($documents, 0, self::PAGE_SIZE),
                'page' => $page,
                'more' => count($documents) > self::PAGE_SIZE,
                'reminder_count' => count($this->unread_reminders()),
            ]);
        } catch (InvalidArgumentException $error) {
            show_error($error->getMessage(), 422);
        } catch (RuntimeException $error) {
            show_error('Data arsip tidak dapat dibaca.', 503);
        }
    }

    public function detail($id = null)
    {
        $document = $this->require_document($id);
        try {
            $this->render('detail', [
                'document' => $document,
                'preview_kind' => Digdocs_preview::kind($document->mime_type),
                'next_expiry' => $this->digdocs_calendar->next_expiry($document),
                'history' => $this->archive->renewal_history($document->id),
            ]);
        } catch (RuntimeException $error) {
            show_error('Riwayat arsip tidak dapat dibaca.', 503);
        }
    }

    public function add()
    {
        $this->render('form', ['document' => null, 'values' => []]);
    }

    public function edit($id = null)
    {
        $document = $this->require_document($id);
        $this->render('form', ['document' => $document, 'values' => (array) $document]);
    }

    public function save($id = null)
    {
        $this->require_post();
        $document = $id === null ? null : $this->require_document($id);
        if ($document) {
            try {
                $version = $this->require_version($document);
            } catch (RuntimeException $error) {
                $this->finish('digdocs/edit/' . $document->id, $error->getMessage(), 'warning');
            }
        }

        $attachment = null;
        try {
            $data = $this->document_fields();
            $file = $_FILES['attachment'] ?? [];
            if (!$document || ($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
                if (is_array($file['error'] ?? null)) {
                    throw new InvalidArgumentException('Pilih satu lampiran.');
                }
                $storage = new Digdocs_storage();
                $attachment = $storage->store($file);
                $data += $attachment;
            }

            $saved = $document
                ? $this->archive->change($document, $version, $data, $this->actor, $attachment ? 'replaced' : 'updated')
                : $this->archive->create([$data], $this->actor, 'uploaded');
            if (!$saved) {
                throw new RuntimeException('Dokumen tidak tersimpan. Muat ulang arsip dan coba lagi.');
            }
        } catch (InvalidArgumentException | RuntimeException $error) {
            if ($attachment) {
                $storage->remove($attachment['storage_name']);
            }
            // Keep fields on validation errors without persisting draft metadata in the session.
            $values = array_intersect_key($this->input->post(), array_flip([
                'title', 'category', 'document_number', 'description', 'issued_on', 'expires_on',
                'recurrence', 'reminder_days', 'reminder_frequency',
            ]));
            $values = array_filter($values, 'is_string');
            if ($document) {
                $values += (array) $document;
            }
            $this->output->set_status_header($error instanceof InvalidArgumentException ? 422 : 409);
            $this->render('form', ['document' => $document, 'values' => $values, 'error' => $error->getMessage()]);
            return;
        }

        if ($document && $attachment) {
            $storage->remove($document->storage_name);
        }
        $this->finish($document ? 'digdocs/detail/' . $document->id : 'digdocs', 'Dokumen tersimpan.');
    }

    public function import()
    {
        if ($this->input->method(true) === 'GET') {
            $this->render('import');
            return;
        }
        $this->require_post();

        $documents = [];
        $category = '';
        try {
            $category = $this->field('post', 'category', 100, true);
            $files = $_FILES['attachments'] ?? [];
            $names = $files['name'] ?? null;
            if (!is_array($names) || !$names || count($names) > Digdocs_storage::MAX_FILES) {
                throw new InvalidArgumentException('Pilih 1 sampai 10 lampiran untuk diimpor.');
            }

            $storage = new Digdocs_storage();
            foreach ($names as $index => $name) {
                if (!is_string($name)) {
                    throw new InvalidArgumentException('Daftar lampiran tidak valid.');
                }
                $attachment = $storage->store([
                    'name' => $name,
                    'tmp_name' => $files['tmp_name'][$index],
                    'error' => $files['error'][$index],
                ]);
                $title = pathinfo($attachment['original_name'], PATHINFO_FILENAME);
                $documents[] = $attachment + [
                    'title' => mb_substr($title !== '' ? $title : $attachment['original_name'], 0, 200),
                    'category' => $category,
                ];
            }

            if (!$this->archive->create($documents, $this->actor, 'imported')) {
                throw new RuntimeException('Impor gagal. Coba lagi.');
            }
        } catch (InvalidArgumentException | RuntimeException $error) {
            foreach ($documents as $attachment) {
                $storage->remove($attachment['storage_name']);
            }
            $this->output->set_status_header($error instanceof InvalidArgumentException ? 422 : 503);
            $this->render('import', ['category' => $category, 'error' => $error->getMessage()]);
            return;
        }

        $this->finish('digdocs', count($documents) . ' dokumen berhasil diimpor.');
    }

    public function renew($id = null)
    {
        $this->require_post();
        $document = $this->require_document($id);
        try {
            $version = $this->require_version($document);
            $next = $this->date_value($this->field('post', 'next_expiry', 10, true));
            if ($document->recurrence === 'none' || !$document->expires_on || $next <= $document->expires_on) {
                throw new InvalidArgumentException('Tanggal perpanjangan harus sesudah kedaluwarsa saat ini.');
            }
            if (!$this->archive->change($document, $version, ['expires_on' => $next], $this->actor, 'renewed')) {
                throw new RuntimeException('Perpanjangan tidak tersimpan. Muat ulang dokumen dan coba lagi.');
            }
        } catch (InvalidArgumentException | RuntimeException $error) {
            $this->finish('digdocs/detail/' . $document->id, $error->getMessage(), 'error');
        }
        $this->finish('digdocs/detail/' . $document->id, 'Perpanjangan telah dicatat.');
    }

    public function delete($id = null)
    {
        $this->require_post();
        $document = $this->require_document($id);
        try {
            $version = $this->require_version($document);
            $storage = new Digdocs_storage();
            if (!$this->archive->change($document, $version, [], $this->actor, 'deleted')) {
                throw new RuntimeException('Dokumen tidak dapat dihapus. Muat ulang dokumen dan coba lagi.');
            }
        } catch (RuntimeException $error) {
            $this->finish('digdocs/detail/' . $document->id, $error->getMessage(), 'error');
        }

        $removed = $storage->remove($document->storage_name);
        $this->finish(
            'digdocs',
            $removed ? 'Dokumen dihapus.' : 'Akses dokumen dihapus. Pembersihan file privat memerlukan pemeriksaan server.',
            $removed ? 'success' : 'warning'
        );
    }

    public function preview($id = null)
    {
        $this->send_file($id, true);
    }

    public function download($id = null)
    {
        $this->send_file($id, false);
    }

    public function notifications()
    {
        try {
            $this->render('notifications', ['reminders' => $this->unread_reminders()]);
        } catch (RuntimeException $error) {
            show_error('Pengingat tidak dapat dibaca.', 503);
        }
    }

    public function acknowledge($id = null)
    {
        $this->require_post();
        $document = $this->require_document($id);
        $occurrence = $this->digdocs_calendar->occurrence($document, $this->today);
        $submitted = $this->input->post('occurrence');
        if (!$occurrence || !is_string($submitted) || !hash_equals($occurrence['key'], $submitted)) {
            $this->finish('digdocs/notifications', 'Pengingat sudah berubah. Periksa daftar terbaru.', 'warning');
        }
        if (!$this->archive->acknowledge($document, $this->actor, $occurrence['key'])) {
            $this->finish('digdocs/notifications', 'Pengingat gagal ditandai.', 'error');
        }

        redirect('digdocs/notifications', 'location', 303);
    }

    private function document_fields()
    {
        $issued = $this->date_value($this->field('post', 'issued_on', 10));
        $expiry = $this->date_value($this->field('post', 'expires_on', 10));
        $recurrence = $this->field('post', 'recurrence', 10, true);
        $days = $this->field('post', 'reminder_days', 4, true);
        $frequency = $this->field('post', 'reminder_frequency', 10, true);
        if ($expiry && $issued && $expiry < $issued) {
            throw new InvalidArgumentException('Kedaluwarsa harus pada atau sesudah tanggal terbit atau mulai berlaku.');
        }
        if (!isset(Digdocs_calendar::RECURRENCES[$recurrence]) || (!$expiry && $recurrence !== 'none')) {
            throw new InvalidArgumentException('Periode berulang memerlukan tanggal kedaluwarsa.');
        }
        if (!ctype_digit($days) || (int) $days > 3650 || !isset(Digdocs_calendar::FREQUENCIES[$frequency])) {
            throw new InvalidArgumentException('Pengingat memerlukan jumlah hari antara 0 dan 3650 dan frekuensi yang valid.');
        }

        $number = $this->field('post', 'document_number', 100);
        return [
            'title' => $this->field('post', 'title', 200, true),
            'category' => $this->field('post', 'category', 100, true),
            'document_number' => $number === '' ? null : $number,
            'description' => $this->field('post', 'description', 5000),
            'issued_on' => $issued,
            'expires_on' => $expiry,
            'recurrence' => $recurrence,
            'reminder_days' => (int) $days,
            'reminder_frequency' => $frequency,
        ];
    }

    private function date_value($value)
    {
        if ($value === '') {
            return null;
        }
        if (!$this->digdocs_calendar->date($value)) {
            throw new InvalidArgumentException('Masukkan tanggal kalender yang valid.');
        }
        return $value;
    }

    private function field($method, $name, $max, $required = false)
    {
        $value = $this->input->$method($name) ?? '';
        if (!is_string($value) || !mb_check_encoding($value, 'UTF-8') || strpos($value, "\0") !== false) {
            throw new InvalidArgumentException('Format isian tidak valid.');
        }
        $value = trim($value);
        if (mb_strlen($value) > $max || ($required && $value === '')) {
            throw new InvalidArgumentException('Periksa isian wajib dan batas panjang karakter.');
        }
        return $value;
    }

    private function require_document($id)
    {
        if (!is_string($id) || !ctype_digit($id) || (int) $id < 1 || (int) $id > 4294967295) {
            show_404();
        }
        try {
            $document = $this->archive->document((int) $id);
        } catch (RuntimeException $error) {
            show_error('Data arsip tidak dapat dibaca.', 503);
        }
        if (!$document) {
            show_404();
        }
        return $document;
    }

    private function require_version($document)
    {
        if ($this->input->post('version') !== (string) $document->version) {
            throw new RuntimeException('Dokumen telah berubah. Muat ulang sebelum melanjutkan.');
        }
        return (int) $document->version;
    }

    private function require_post()
    {
        if ($this->input->method(true) !== 'POST') {
            header('Allow: POST');
            show_error('Metode permintaan tidak diizinkan.', 405);
        }
        if ((int) ($_SERVER['CONTENT_LENGTH'] ?? 0) > 0 && !$_POST && !$_FILES) {
            show_error('Permintaan kosong atau melebihi batas unggahan server.', 413);
        }
        $expected = $this->session->userdata('digdocs_csrf');
        $submitted = $this->input->post('digdocs_csrf');
        if (!is_string($expected) || !is_string($submitted) || !hash_equals($expected, $submitted)) {
            show_error('Token keamanan tidak valid. Muat ulang halaman dan coba lagi.', 403);
        }
    }

    private function unread_reminders()
    {
        $reminders = [];
        foreach ($this->archive->reminders($this->actor, $this->today->format('Y-m-d')) as $document) {
            $occurrence = $this->digdocs_calendar->occurrence($document, $this->today);
            if ($occurrence && $occurrence['key'] !== $document->last_read) {
                $reminders[] = ['document' => $document, 'occurrence' => $occurrence];
            }
        }
        return $reminders;
    }

    private function send_file($id, $preview)
    {
        if ($this->input->method(true) !== 'GET') {
            header('Allow: GET');
            show_error('Metode permintaan tidak diizinkan.', 405);
        }
        $document = $this->require_document($id);
        $kind = $preview ? Digdocs_preview::kind($document->mime_type) : null;
        if ($preview && !$kind) {
            show_error('Format ini hanya tersedia untuk diunduh.', 415);
        }
        try {
            $storage = new Digdocs_storage();
            $file = $storage->open($document->storage_name);
        } catch (RuntimeException $error) {
            show_error('Penyimpanan privat arsip belum tersedia.', 503);
        }
        if (!$file) {
            show_404();
        }
        $payload = null;
        if ($preview && $kind !== 'pdf' && $kind !== 'image') {
            try {
                $data = (new Digdocs_preview())->render($file, $document->mime_type);
                $payload = json_encode($data, JSON_INVALID_UTF8_SUBSTITUTE);
            } catch (RuntimeException $error) {
                $payload = false;
            }
            if ($payload === false) {
                fclose($file);
                show_error('Pratinjau tidak dapat dibaca. Gunakan Unduh lampiran.', 422);
            }
        }
        if (!$this->archive->audit($document->id, $this->actor, $preview ? 'previewed' : 'downloaded')) {
            fclose($file);
            show_error('Akses lampiran belum dapat dicatat.', 503);
        }

        // The modal fetches the response. A direct navigation treats it as an attachment.
        $fallback = 'dokumen.' . strtolower(pathinfo($document->original_name, PATHINFO_EXTENSION));
        header("Content-Security-Policy: default-src 'none'; frame-ancestors 'none'; base-uri 'none'; form-action 'none'");
        session_write_close();
        if ($payload !== null) {
            header('Content-Type: application/json; charset=utf-8');
            header('Content-Disposition: attachment; filename="pratinjau.json"');
            header('Content-Length: ' . strlen($payload));
            fclose($file);
            echo $payload;
            exit;
        }

        $type = $preview ? $document->mime_type : 'application/octet-stream';
        header('Content-Type: ' . $type);
        header('Content-Disposition: attachment; filename="' . $fallback . '"; filename*=UTF-8\'\'' . rawurlencode($document->original_name));
        header('Content-Length: ' . fstat($file)['size']);
        fpassthru($file);
        fclose($file);
        exit;
    }

    private function render($view, array $data = [])
    {
        $token = $this->session->userdata('digdocs_csrf');
        if (!$token) {
            $token = bin2hex(random_bytes(32));
            $this->session->set_userdata('digdocs_csrf', $token);
        }

        header("Content-Security-Policy: default-src 'none'; script-src 'self' 'wasm-unsafe-eval'; style-src 'self' 'unsafe-inline'; img-src 'self' data: blob:; font-src 'self' blob:; connect-src 'self'; worker-src 'self'; frame-ancestors 'none'; form-action 'self'; base-uri 'none'");
        $data += [
            'view' => $view,
            'csrf' => $token,
            'calendar' => $this->digdocs_calendar,
            'today' => $this->today,
            'message' => $this->session->flashdata('digdocs_message'),
        ];
        $this->load->view('content/digdocs/layout', $data);
    }

    private function finish($url, $message, $type = 'success')
    {
        $this->session->set_flashdata('digdocs_message', ['text' => $message, 'type' => $type]);
        redirect($url, 'location', 303);
    }
}
