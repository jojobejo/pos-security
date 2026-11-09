<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Digdocs_preview
{
    const MAX_PART_BYTES = 2 * 1024 * 1024;
    const MAX_PACKAGE_BYTES = 12 * 1024 * 1024;
    const MAX_TEXT_BYTES = 512 * 1024;
    const MAX_IMAGE_BYTES = 512 * 1024;
    const MAX_SHEETS = 12;
    const MAX_ROWS = 100;
    const MAX_COLUMNS = 24;
    const MAX_SLIDES = 30;

    private $zip;
    private $packageBytes = 0;
    private $textBytes = 0;
    private $imageBytes = 0;
    private $limited = false;

    public static function kind($mime)
    {
        switch ($mime) {
            case 'application/pdf':
                return 'pdf';
            case 'image/jpeg':
            case 'image/png':
            case 'image/webp':
                return 'image';
            case Digdocs_storage::TYPES['xlsx'][0]:
                return 'sheets';
            case Digdocs_storage::TYPES['pptx'][0]:
                return 'slides';
            case Digdocs_storage::TYPES['docx'][0]:
            case 'text/plain':
            case 'text/csv':
                return 'text';
        }
        return null;
    }

    public function render($file, $mime)
    {
        $kind = self::kind($mime);
        if ($mime === 'text/plain' || $mime === 'text/csv') {
            $text = stream_get_contents($file, self::MAX_TEXT_BYTES + 1);
            if ($text === false) {
                throw new RuntimeException('Pratinjau tidak dapat dibaca.');
            }
            $text = $this->clip($text, self::MAX_TEXT_BYTES);
            return ['kind' => $kind, 'text' => $text, 'limited' => $this->limited];
        }

        if (!class_exists('ZipArchive') || !class_exists('DOMDocument')) {
            throw new RuntimeException('Pratinjau Office belum tersedia.');
        }
        $this->zip = new ZipArchive();
        if (@$this->zip->open(stream_get_meta_data($file)['uri'], ZipArchive::CHECKCONS) !== true) {
            throw new RuntimeException('Pratinjau tidak dapat dibaca.');
        }

        try {
            switch ($kind) {
                case 'sheets':
                    $data = ['pages' => $this->sheets()];
                    break;
                case 'slides':
                    $data = ['pages' => $this->slides()];
                    break;
                default:
                    $xml = $this->xml('word/document.xml');
                    if (!$xml) {
                        throw new RuntimeException('Pratinjau tidak dapat dibaca.');
                    }
                    $body = $this->child($xml->documentElement, 'body');
                    $data = ['text' => $body ? $this->paragraphs($body) : ''];
            }
            return ['kind' => $kind, 'limited' => $this->limited] + $data;
        } finally {
            $this->zip->close();
        }
    }

    private function sheets()
    {
        $part = 'xl/workbook.xml';
        $workbook = $this->xml($part);
        if (!$workbook) {
            throw new RuntimeException('Pratinjau tidak dapat dibaca.');
        }

        $links = $this->relationships($part);
        $strings = null;
        foreach ($links as $link) {
            if ($link['type'] === 'sharedStrings' && preg_match('~^xl/[^/]+\.xml$~D', $link['path'])) {
                $strings = $this->xml($link['path']);
                break;
            }
        }

        $shared = [];
        if ($strings) {
            foreach ($strings->documentElement->getElementsByTagNameNS('*', 'si') as $index => $item) {
                $shared[$index] = $this->string_value($item);
            }
        }
        unset($strings);

        $pages = [];
        foreach ($workbook->documentElement->getElementsByTagNameNS('*', 'sheet') as $sheet) {
            if (in_array($sheet->getAttribute('state'), ['hidden', 'veryHidden'], true)) {
                continue;
            }
            if (count($pages) >= self::MAX_SHEETS || $this->textBytes >= self::MAX_TEXT_BYTES) {
                $this->limited = true;
                break;
            }

            $link = $links[$this->relationship_id($sheet, 'id')] ?? null;
            if (!$link || $link['type'] !== 'worksheet' || !preg_match('~^xl/worksheets/[^/]+\.xml$~D', $link['path'])) {
                continue;
            }
            $xml = $this->xml($link['path']);
            $page = ['name' => $this->clip($sheet->getAttribute('name'), 160), 'rows' => [], 'columns' => 0];
            if (!$xml) {
                $page['unavailable'] = true;
            } else {
                $this->read_sheet($xml, $shared, $page);
            }
            $pages[] = $page;
        }
        return $pages;
    }

    private function read_sheet(DOMDocument $xml, array $shared, array &$page)
    {
        $sheetData = $this->child($xml->documentElement, 'sheetData');
        if (!$sheetData) {
            return;
        }

        $rowNumber = 0;
        foreach ($sheetData->getElementsByTagNameNS('*', 'row') as $row) {
            $rowNumber = (int) $row->getAttribute('r') ?: $rowNumber + 1;
            if ($row->getAttribute('hidden') === '1' || $row->getAttribute('hidden') === 'true') {
                continue;
            }
            if (count($page['rows']) >= self::MAX_ROWS || $this->textBytes >= self::MAX_TEXT_BYTES) {
                $this->limited = true;
                break;
            }

            $cells = [];
            $column = 0;
            foreach ($row->getElementsByTagNameNS('*', 'c') as $cell) {
                $column = $this->column_number($cell->getAttribute('r'), $column + 1);
                if ($column > self::MAX_COLUMNS) {
                    $this->limited = true;
                    continue;
                }

                $value = $this->child($cell, 'v');
                $value = $value ? $value->textContent : '';
                switch ($cell->getAttribute('t')) {
                    case 's':
                        $value = ctype_digit($value) ? ($shared[(int) $value] ?? '') : '';
                        break;
                    case 'inlineStr':
                        $inline = $this->child($cell, 'is');
                        $value = $inline ? $this->string_value($inline) : '';
                        break;
                    case 'b':
                        $value = $value === '1' ? 'TRUE' : 'FALSE';
                        break;
                }
                $cells[$column] = $this->clip($value, 512);
                $page['columns'] = max($page['columns'], $column);
            }

            if ($cells) {
                $page['rows'][] = ['number' => $rowNumber, 'cells' => (object) $cells];
            }
        }
    }

    private function slides()
    {
        $part = 'ppt/presentation.xml';
        $presentation = $this->xml($part);
        if (!$presentation) {
            throw new RuntimeException('Pratinjau tidak dapat dibaca.');
        }

        $links = $this->relationships($part);
        $pages = [];
        foreach ($presentation->documentElement->getElementsByTagNameNS('*', 'sldId') as $slide) {
            if (count($pages) >= self::MAX_SLIDES || $this->textBytes >= self::MAX_TEXT_BYTES) {
                $this->limited = true;
                break;
            }
            $link = $links[$this->relationship_id($slide, 'id')] ?? null;
            if (!$link || $link['type'] !== 'slide' || !preg_match('~^ppt/slides/[^/]+\.xml$~D', $link['path'])) {
                continue;
            }
            $xml = $this->xml($link['path']);
            $page = ['name' => 'Slide ' . (count($pages) + 1), 'text' => '', 'images' => []];
            if (!$xml) {
                $page['unavailable'] = true;
            } else {
                $page['text'] = $this->paragraphs($xml->documentElement);
                $page['images'] = $this->slide_images($xml, $link['path']);
            }
            $pages[] = $page;
        }
        return $pages;
    }

    private function slide_images(DOMDocument $xml, $part)
    {
        $nodes = $xml->documentElement->getElementsByTagNameNS('*', 'blip');
        if (!$nodes->length) {
            return [];
        }

        $links = $this->relationships($part);
        $images = [];
        foreach ($nodes as $node) {
            $link = $links[$this->relationship_id($node, 'embed')] ?? null;
            if (!$link || $link['type'] !== 'image' || !preg_match('~^ppt/media/[^/]+$~D', $link['path'])) {
                continue;
            }
            if (count($images) >= 6 || $this->imageBytes >= self::MAX_PART_BYTES) {
                $this->limited = true;
                break;
            }
            $bytes = $this->read_part($link['path'], min(self::MAX_IMAGE_BYTES, self::MAX_PART_BYTES - $this->imageBytes));
            if ($bytes === null) {
                continue;
            }
            $info = @getimagesizefromstring($bytes);
            if ($info && in_array($info['mime'], ['image/jpeg', 'image/png', 'image/webp'], true)
                && $info[0] <= 4096 && $info[1] <= 4096 && $info[0] * $info[1] <= 8000000) {
                $this->imageBytes += strlen($bytes);
                $images[] = ['mime' => $info['mime'], 'base64' => base64_encode($bytes)];
            } else {
                $this->limited = true;
            }
        }
        return $images;
    }

    private function paragraphs(DOMElement $element)
    {
        $lines = [];
        foreach ($element->getElementsByTagNameNS('*', 'p') as $paragraph) {
            $line = '';
            foreach ($paragraph->getElementsByTagNameNS('*', 't') as $node) {
                $line .= $node->textContent;
            }
            if (trim($line) !== '') {
                $lines[] = $this->clip($line, 8192) . "\n";
            }
            if ($this->textBytes >= self::MAX_TEXT_BYTES || count($lines) >= 1000) {
                $this->limited = true;
                break;
            }
        }
        return rtrim(implode('', $lines), "\n");
    }

    private function string_value(DOMElement $element)
    {
        $text = '';
        foreach ($element->getElementsByTagNameNS('*', 't') as $node) {
            if ($node->parentNode->localName !== 'rPh') {
                $text .= $node->textContent;
            }
        }
        return $text;
    }

    private function column_number($reference, $fallback)
    {
        if (!preg_match('/^([A-Z]{1,3})[0-9]+$/D', $reference, $match)) {
            return $fallback;
        }

        $column = 0;
        foreach (str_split($match[1]) as $letter) {
            $column = $column * 26 + ord($letter) - ord('A') + 1;
        }
        return $column;
    }

    private function child(DOMElement $parent, $name)
    {
        foreach ($parent->childNodes as $child) {
            if ($child instanceof DOMElement && $child->localName === $name) {
                return $child;
            }
        }
        return null;
    }

    private function relationship_id(DOMElement $element, $name)
    {
        return $element->getAttributeNS('http://schemas.openxmlformats.org/officeDocument/2006/relationships', $name)
            ?: $element->getAttributeNS('http://purl.oclc.org/ooxml/officeDocument/relationships', $name);
    }

    private function relationships($part)
    {
        $directory = dirname($part);
        $xml = $this->xml($directory . '/_rels/' . basename($part) . '.rels');
        $links = [];
        if (!$xml) {
            return $links;
        }

        foreach ($xml->documentElement->getElementsByTagNameNS('*', 'Relationship') as $link) {
            $mode = $link->getAttribute('TargetMode');
            $target = $link->getAttribute('Target');
            if (($mode !== '' && $mode !== 'Internal') || !preg_match('~^[a-zA-Z0-9._/-]+$~D', $target)
                || substr($target, 0, 2) === '//') {
                continue;
            }
            $parts = $target[0] === '/' ? [] : explode('/', $directory);
            foreach (explode('/', ltrim($target, '/')) as $name) {
                if ($name === '..') {
                    if (!$parts) {
                        continue 2;
                    }
                    array_pop($parts);
                } elseif ($name !== '.' && $name !== '') {
                    $parts[] = $name;
                }
            }
            $links[$link->getAttribute('Id')] = [
                'type' => basename($link->getAttribute('Type')),
                'path' => implode('/', $parts),
            ];
        }
        return $links;
    }

    private function xml($part)
    {
        $bytes = $this->read_part($part, self::MAX_PART_BYTES);
        if ($bytes === null) {
            return null;
        }

        $xml = new DOMDocument();
        // No entity substitution, DTD loading, XInclude or network access.
        if (!@$xml->loadXML($bytes, LIBXML_NONET | LIBXML_COMPACT) || $xml->doctype !== null) {
            $this->limited = true;
            return null;
        }
        return $xml;
    }

    private function read_part($name, $max)
    {
        $info = $this->zip->statName($name);
        if ($info === false) {
            return null;
        }
        if ($info['size'] < 1 || $info['size'] > min($max, self::MAX_PACKAGE_BYTES - $this->packageBytes)) {
            $this->limited = true;
            return null;
        }

        $bytes = @$this->zip->getFromIndex($info['index'], $info['size']);
        if ($bytes === false || strlen($bytes) !== $info['size']) {
            $this->limited = true;
            return null;
        }
        $this->packageBytes += strlen($bytes);
        return $bytes;
    }

    private function clip($value, $limit)
    {
        $limit = min($limit, self::MAX_TEXT_BYTES - $this->textBytes);
        if (strlen($value) > $limit) {
            $this->limited = true;
            $value = mb_strcut($value, 0, $limit, 'UTF-8');
        }
        $this->textBytes += strlen($value);
        return $value;
    }
}
