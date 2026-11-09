<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Digdocs extends CI_Model
{
    public function can_access()
    {
        $username = $this->session->userdata('username');
        if ($this->session->userdata('status') !== 'is_login'
            || !in_array($username, ['HRD2', 'GA1'], true)
            || (int) $this->session->userdata('id') <= 0) {
            return false;
        }

        $debug = $this->db->db_debug;
        $cache = $this->db->cache_on;
        $this->db->db_debug = false;
        $this->db->cache_off();
        try {
            $query = $this->db->query(
                "SELECT a.user_id FROM docsdig_access a JOIN tb_user u ON u.id = a.user_id
                 WHERE a.user_id = ? AND a.username = ? AND BINARY u.username = a.username AND u.password <> ''",
                [(int) $this->session->userdata('id'), $username]
            );
            return $query && $query->num_rows() === 1;
        } finally {
            $this->db->db_debug = $debug;
            $this->db->cache_on = $cache;
        }
    }

    public function listing(array $filters, $today, $page, $pageSize)
    {
        $this->db->from('docsdig_documents');
        if ($filters['q'] !== '') {
            $this->db->group_start()->like('title', $filters['q'])
                ->or_like('document_number', $filters['q'])->or_like('description', $filters['q'])->group_end();
        }
        if ($filters['category'] !== '') {
            $this->db->where('category', $filters['category']);
        }
        if ($filters['from'] !== '') {
            $this->db->where('expires_on >=', $filters['from']);
        }
        if ($filters['to'] !== '') {
            $this->db->where('expires_on <=', $filters['to']);
        }

        $reminderStart = 'DATE_SUB(expires_on, INTERVAL reminder_days DAY)';
        switch ($filters['status']) {
            case 'none':
                $this->db->where('expires_on', null);
                break;
            case 'expired':
                $this->db->where('expires_on <', $today);
                break;
            case 'due':
                $this->db->where('expires_on >=', $today)->where($reminderStart . ' <=', $today);
                break;
            case 'active':
                $this->db->where($reminderStart . ' >', $today);
                break;
        }

        return $this->rows($this->db->order_by('updated_at', 'DESC')->order_by('id', 'DESC')
            ->limit($pageSize + 1, ($page - 1) * $pageSize)->get());
    }

    public function categories()
    {
        return $this->rows($this->db->distinct()->select('category')->order_by('category')->get('docsdig_documents'));
    }

    public function document($id)
    {
        $query = $this->db->get_where('docsdig_documents', ['id' => $id]);
        if (!$query) {
            throw new RuntimeException('Data arsip tidak dapat dibaca.');
        }
        return $query->row();
    }

    public function reminders($userId, $today)
    {
        return $this->rows($this->db->query(
            'SELECT d.id, d.title, d.expires_on, d.reminder_days, d.reminder_frequency, r.occurrence AS last_read
             FROM docsdig_documents d
             LEFT JOIN docsdig_reminder_reads r ON r.document_id = d.id AND r.user_id = ?
             WHERE DATE_SUB(d.expires_on, INTERVAL d.reminder_days DAY) <= ?
             ORDER BY d.expires_on, d.id',
            [$userId, $today]
        ));
    }

    public function acknowledge($document, $userId, $occurrence)
    {
        return $this->db->query(
            'INSERT INTO docsdig_reminder_reads (document_id, user_id, occurrence)
             SELECT id, ?, ? FROM docsdig_documents WHERE id = ? AND version = ?
             ON DUPLICATE KEY UPDATE occurrence = VALUES(occurrence)',
            [$userId, $occurrence, $document->id, $document->version]
        );
    }

    public function renewal_history($id)
    {
        return $this->rows($this->db->select('actor_id, previous_expiry, new_expiry, created_at')
            ->where(['document_id' => $id, 'action' => 'renewed'])
            ->order_by('id', 'DESC')->get('docsdig_audit'));
    }

    public function create(array $documents, $actor, $action)
    {
        return $this->transaction(function () use ($documents, $actor, $action) {
            foreach ($documents as $data) {
                if (!$this->db->insert('docsdig_documents', $data)
                    || !$this->audit($this->db->insert_id(), $actor, $action)) {
                    return false;
                }
            }
            return true;
        });
    }

    public function change($document, $version, array $data, $actor, $action)
    {
        return $this->transaction(function () use ($document, $version, $data, $actor, $action) {
            $this->db->where(['id' => $document->id, 'version' => $version]);
            if ($action === 'deleted') {
                $ok = $this->db->delete('docsdig_documents');
            } else {
                $ok = $this->db->update('docsdig_documents', $data + ['version' => $version + 1]);
            }

            if (!$ok || $this->db->affected_rows() !== 1) {
                return false;
            }

            $dates = [];
            if (array_key_exists('expires_on', $data)
                && ($action === 'renewed' || $document->expires_on !== $data['expires_on'])) {
                $dates = [
                    'previous_expiry' => $document->expires_on,
                    'new_expiry' => $data['expires_on'],
                ];
            }
            return $this->audit($document->id, $actor, $action, $dates);
        });
    }

    public function audit($id, $actor, $action, array $dates = [])
    {
        return $this->db->insert('docsdig_audit', [
            'document_id' => $id,
            'actor_id' => $actor,
            'action' => $action,
        ] + $dates);
    }

    private function rows($query)
    {
        if (!$query) {
            throw new RuntimeException('Data arsip tidak dapat dibaca.');
        }
        return $query->result();
    }

    private function transaction(callable $action)
    {
        if (!$this->db->trans_begin()) {
            return false;
        }

        try {
            if ($action() && $this->db->trans_status() && $this->db->trans_commit()) {
                return true;
            }
            return false;
        } finally {
            if ($this->db->trans_active()) {
                $this->db->trans_rollback();
            }
        }
    }
}
