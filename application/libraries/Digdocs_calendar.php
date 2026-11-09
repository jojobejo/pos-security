<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Digdocs_calendar
{
    const STATUSES = [
        'active' => 'Aktif',
        'due' => 'Segera Kedaluwarsa',
        'expired' => 'Kedaluwarsa',
        'none' => 'Tanpa Kedaluwarsa',
    ];
    const RECURRENCES = [
        'none' => 'Tidak berulang',
        'daily' => 'Harian',
        'weekly' => 'Mingguan',
        'monthly' => 'Bulanan',
        'yearly' => 'Tahunan',
    ];
    const FREQUENCIES = [
        'daily' => 'Harian',
        'weekly' => 'Mingguan',
        'monthly' => 'Bulanan',
    ];

    public function today()
    {
        return new DateTimeImmutable('today', new DateTimeZone('Asia/Jakarta'));
    }

    public function date($value)
    {
        if (!preg_match('/^[1-9]\d{3}-\d{2}-\d{2}$/D', $value)) {
            return null;
        }

        $date = DateTimeImmutable::createFromFormat('!Y-m-d', $value, new DateTimeZone('Asia/Jakarta'));
        return $date && $date->format('Y-m-d') === $value ? $date : null;
    }

    public function status($document, DateTimeImmutable $today)
    {
        if ($document->expires_on === null) {
            return 'none';
        }

        $expiry = $this->date($document->expires_on);
        if ($expiry < $today) {
            return 'expired';
        }

        return $this->reminder_start($document, $expiry) <= $today ? 'due' : 'active';
    }

    public function next_expiry($document)
    {
        $expiry = $this->date($document->expires_on);
        switch ($document->recurrence) {
            case 'daily':
                return $expiry->modify('+1 day');
            case 'weekly':
                return $expiry->modify('+1 week');
            case 'monthly':
                return $this->add_months($expiry, 1);
            case 'yearly':
                return $this->add_months($expiry, 12);
        }
    }

    public function occurrence($document, DateTimeImmutable $today)
    {
        $status = $this->status($document, $today);
        if ($status !== 'due' && $status !== 'expired') {
            return null;
        }

        $expiry = $this->date($document->expires_on);
        $start = $this->reminder_start($document, $expiry);
        if ($status === 'expired') {
            $date = $expiry->modify('+1 day');
        } elseif ($document->reminder_frequency === 'monthly') {
            $months = ((int) $today->format('Y') - (int) $start->format('Y')) * 12
                + (int) $today->format('n') - (int) $start->format('n');
            $date = $this->add_months($start, $months);
            if ($date > $today) {
                $date = $this->add_months($start, $months - 1);
            }
        } elseif ($document->reminder_frequency === 'weekly') {
            $weeks = intdiv((int) $start->diff($today)->days, 7);
            $date = $start->modify('+' . $weeks . ' weeks');
        } else {
            $date = $today;
        }

        $scheduledOn = $date->format('Y-m-d');
        return [
            'date' => $scheduledOn,
            'key' => hash('sha256', implode('|', [
                $document->expires_on, $document->reminder_days, $document->reminder_frequency, $scheduledOn,
            ])),
        ];
    }

    private function reminder_start($document, DateTimeImmutable $expiry)
    {
        return $expiry->modify('-' . (int) $document->reminder_days . ' days');
    }

    private function add_months(DateTimeImmutable $date, $months)
    {
        $month = $date->modify('first day of this month')->modify(sprintf('%+d months', $months));
        $day = min((int) $date->format('j'), (int) $month->format('t'));
        return $month->setDate((int) $month->format('Y'), (int) $month->format('n'), $day);
    }
}
