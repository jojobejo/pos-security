<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class M_Hrd extends CI_Model

{

    public function get_all_laporan()
    {
        return $this->db->query("SELECT a.*
        FROM hrdga_lap_distribusi a
        ");
    }
    public function getalltamulb()
    {
        return $this->db->query("SELECT a.*
        FROM hrdga_tamu_lby a
        ");
    }
    public function get_lap_id($id)
    {
        return $this->db->query("SELECT a.*
        FROM hrdga_lap_distribusi a
        WHERE id = $id
        ");
    }
    public function addlapdistribusihrd($data)
    {
        return $this->db->insert('hrdga_lap_distribusi', $data);
    }
    public function editlapdistribusihrd($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('hrdga_lap_distribusi', $data);
    }
    public function hapus_lap_distribusi_hrd($id)
    {
        return $this->db->delete('hrdga_lap_distribusi', array("id" => $id));
    }

    public function konfirmtamulb($data)
    {
        return $this->db->insert('hrdga_tamu', $data);
    }

    public function get_all_tamu_lb()
    {
        return $this->db->query("SELECT a.*
        FROM hrdga_tamu_lby a
        ");
    }

    public function hapus_lap_tamu_lby($id)
    {
        return $this->db->delete('hrdga_tamu_lby', array("id" => $id));
    }
    public function addlaptamuhrd($data)
    {
        return $this->db->insert('hrdga_tamu_lby', $data);
    }
    public function editlaptamu($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('hrdga_tamu', $data);
    }
    public function hapus_lap_tamu_lb($id)
    {
        return $this->db->delete('hrdga_tamu_lby', array("id" => $id));
    }
    public function hapus_lap_tamu_hrd($id)
    {
        return $this->db->delete('hrdga_tamu', array("id" => $id));
    }
    public function get_all_tamu()
    {
        return $this->db->query("SELECT a.*
        FROM hrdga_tamu a
        ");
    }
    //karyawan keluar masuk 

    public function get_all_laporan_karykm()
    {
        return $this->db->query("SELECT a.*
        FROM hrdga_karyawan_keluarmasuk a
        ");
    }
    public function addlapkarykm($data)
    {
        return $this->db->insert('hrdga_karyawan_keluarmasuk', $data);
    }
    public function editlapkarykm($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('hrdga_karyawan_keluarmasuk', $data);
    }
    public function hapuslapkarykm($id)
    {
        return $this->db->delete('hrdga_karyawan_keluarmasuk', array("id" => $id));
    }

    //laporan Expedisi

    public function get_all_laporan_expedisi()
    {
        return $this->db->select('a.*, penerima.nama_user AS nama_penerima, penerima.username AS username_penerima, penerima_konfirmasi.nama_user AS nama_penerima_konfirmasi')
            ->from('hrdga_expedisi a')
            ->join('hrdga_user penerima', 'penerima.id = a.penerima_berkas_id', 'left')
            ->join('hrdga_user penerima_konfirmasi', 'penerima_konfirmasi.id = a.diterima_oleh_id', 'left')
            ->order_by('a.tanggal', 'DESC')
            ->get();
    }

    public function get_penerima_berkas_logistik()
    {
        return $this->db->select('id, nama_user, username')
            ->from('hrdga_user')
            ->where('departemen', 'LOGISTIK')
            ->order_by('nama_user', 'ASC')
            ->get()
            ->result();
    }

    public function get_expedisi_by_id($id)
    {
        return $this->db->select('a.*, penerima.nama_user AS nama_penerima, penerima.username AS username_penerima, penerima_konfirmasi.nama_user AS nama_penerima_konfirmasi')
            ->from('hrdga_expedisi a')
            ->join('hrdga_user penerima', 'penerima.id = a.penerima_berkas_id', 'left')
            ->join('hrdga_user penerima_konfirmasi', 'penerima_konfirmasi.id = a.diterima_oleh_id', 'left')
            ->where('a.id', $id)
            ->get()
            ->row();
    }

    public function get_riwayat_penerimaan_expedisi($expedisiId)
    {
        return $this->db->select('r.*, u.nama_user AS nama_penerima')
            ->from('hrdga_expedisi_penerimaan_riwayat r')
            ->join('hrdga_user u', 'u.id = r.penerima_id', 'left')
            ->where('r.expedisi_id', $expedisiId)
            ->order_by('r.diterima_pada', 'DESC')
            ->get()
            ->result();
    }

    public function konfirmasi_penerimaan_expedisi($expedisiId, $penerimaId, $catatan)
    {
        $this->db->trans_start();

        $this->db->where('id', $expedisiId);
        $this->db->where('penerima_berkas_id', $penerimaId);
        $this->db->where('status_berkas', 'BELUM_DITERIMA');
        $this->db->update('hrdga_expedisi', [
            'status_berkas' => 'SUDAH_DITERIMA',
            'diterima_oleh_id' => $penerimaId,
            'diterima_pada' => date('Y-m-d H:i:s'),
            'catatan_penerimaan' => $catatan,
        ]);

        $updated = $this->db->affected_rows();
        if ($updated === 1) {
            $this->db->insert('hrdga_expedisi_penerimaan_riwayat', [
                'expedisi_id' => $expedisiId,
                'penerima_id' => $penerimaId,
                'status_berkas' => 'SUDAH_DITERIMA',
                'catatan' => $catatan,
                'diterima_pada' => date('Y-m-d H:i:s'),
            ]);
        }

        $this->db->trans_complete();

        return $this->db->trans_status() && $updated === 1;
    }

    public function addlapexpedisi($data)
    {
        return $this->db->insert('hrdga_expedisi', $data);
    }
    public function editlapexpedisi($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('hrdga_expedisi', $data);
    }
    public function hapuslapexpedisi($id)
    {
        return $this->db->delete('hrdga_expedisi', array("id" => $id));
    }

    //issue

    public function get_all_laporan_issue()
    {
        return $this->db->query("SELECT a.*
        FROM hrdga_issue a
        ");
    }
    public function export_lap_issue()
    {
        return $this->db->get('hrdga_issue')->result();
    }
    public function export_lap_km_karyawan()
    {
        return $this->db->get('hrdga_karyawan_keluarmasuk')->result();
    }
    public function addlapissue($data)
    {
        return $this->db->insert('hrdga_issue', $data);
    }
    public function editlapissue($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('hrdga_issue', $data);
    }
    public function hapuslapissue($id)
    {
        return $this->db->delete('hrdga_issue', array("id" => $id));
    }
    public function cari_lap_distribusi($v1, $v2)
    {
        return $this->db->query("SELECT a.*
        FROM hrdga_lap_distribusi a
        WHERE $v1 LIKE '$v2'
        ");
    }
    public function get_all_truk_service_histori()
    {
        return $this->db->query("SELECT a.*
        FROM hrdga_service_truk a
        ");
    }
    public function update_km_service($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('hrdga_service_truk', $data);
    }
    public function get_all_karyawan()
    {
        return $this->db->query("SELECT a.*
        FROM hrdga_user a WHERE id > '4'
        ");
    }
    public function update_karyawan($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('hrdga_user', $data);
    }
    public function add_karyawan($data)
    {
        return $this->db->insert('hrdga_user', $data);
    }



    var $table = 'hrdga_lap_distribusi';
    var $column_order = array('tglkeluar', 'tglmasuk', 'nopol', 'nolambung', 'namadriver', 'namahelper', 'tujuan', 'jamkeluar', 'kmkeluar', 'jammasuk', 'kmmasuk', 'keterangan', 'id'); //field yang ada di table user
    var $column_search = array('nopol', 'namadriver', 'namahelper', 'tujuan');
    var $order = array('id' => 'asc');

    private function _get_datatables_query()
    {

        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function truncate_lap_distribusi()
    {
        return $this->db->truncate('hrdga_lap_distribusi');
    }

    var $table1 = 'hrdga_tamu';

    var $column_order1 = [
        'tanggal', 'nama', 'perusahaan', 'alamat',
        'jumlahpersonil', 'tujuan', 'jammasuk', 'jamkeluar',
        'keterangan', 'nm_inputer'
    ];

    var $column_search1 = [
        'nama', 'perusahaan', 'alamat', 'tujuan', 'nm_inputer'
    ];

    var $order1 = ['id' => 'asc'];

    private function _get_query_tamu()
    {
        $this->db->from($this->table1);

        $i = 0;
        foreach ($this->column_search1 as $item) {
            if (!empty($_POST['search']['value'])) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search1) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by(
                $this->column_order1[$_POST['order']['0']['column']],
                $_POST['order']['0']['dir']
            );
        } else {
            $this->db->order_by(
                key($this->order1),
                $this->order1[key($this->order1)]
            );
        }
    }

    public function get_datatables_tamu()
    {
        $this->_get_query_tamu();

        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        return $this->db->get()->result();
    }

    public function count_filtered_tamu()
    {
        $this->_get_query_tamu();
        return $this->db->get()->num_rows();
    }

    public function count_all_tamu()
    {
        return $this->db->count_all($this->table1);
    }

    var $table_karykm = 'hrdga_karyawan_keluarmasuk';

    var $column_order_karykm = [
        'tanggal', 'nama', 'departemen', 'status',
        'jamkeluar', 'jammasuk', 'nopol', 'keterangan', 'nm_inputer'
    ];

    var $column_search_karykm = [
        'nama', 'departemen', 'status', 'nopol', 'keterangan', 'nm_inputer'
    ];

    var $order_karykm = ['id' => 'desc'];

    private function _get_query_karykm()
    {
        $this->db->from($this->table_karykm);

        $i = 0;
        foreach ($this->column_search_karykm as $item) {
            if (!empty($_POST['search']['value'])) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search_karykm) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by(
                $this->column_order_karykm[$_POST['order']['0']['column']],
                $_POST['order']['0']['dir']
            );
        } else {
            $this->db->order_by(
                key($this->order_karykm),
                $this->order_karykm[key($this->order_karykm)]
            );
        }
    }

    public function get_datatables_karykm()
    {
        $this->_get_query_karykm();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        return $this->db->get()->result();
    }

    public function count_filtered_karykm()
    {
        $this->_get_query_karykm();
        return $this->db->get()->num_rows();
    }

    public function count_all_karykm()
    {
        return $this->db->count_all($this->table_karykm);
    }

    var $table_expedisi = 'hrdga_expedisi';
    var $column_order_expedisi = [
        'tanggal', 'jamkeluar', 'jammasuk', 'nopol', 'namadriver',
        'notlpndriver', 'perusahaanpengirim', 'namabarang', 'jumlahbarang', 'keterangan',
        'penerima_berkas_id', 'status_berkas'
    ];
    var $column_search_expedisi = [
        'nopol', 'namadriver', 'perusahaanpengirim', 'namabarang'
    ];
    var $order_expedisi = ['tanggal' => 'desc'];

    private function _get_query_expedisi()
    {
        $this->db->select('a.*, penerima.nama_user AS nama_penerima');
        $this->db->from($this->table_expedisi . ' a');
        $this->db->join('hrdga_user penerima', 'penerima.id = a.penerima_berkas_id', 'left');

        if ($this->session->userdata('departemen') === 'LOGISTIK') {
            $this->db->where('a.penerima_berkas_id', (int) $this->session->userdata('id'));
        }

        $i = 0;
        foreach ($this->column_search_expedisi as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search_expedisi) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by(
                $this->column_order_expedisi[$_POST['order'][0]['column']],
                $_POST['order'][0]['dir']
            );
        } else {
            $this->db->order_by(key($this->order_expedisi), $this->order_expedisi[key($this->order_expedisi)]);
        }
    }

    public function get_datatables_expedisi()
    {
        $this->_get_query_expedisi();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        return $this->db->get()->result();
    }

    public function count_filtered_expedisi()
    {
        $this->_get_query_expedisi();
        return $this->db->get()->num_rows();
    }

    public function count_all_expedisi()
    {
        if ($this->session->userdata('departemen') === 'LOGISTIK') {
            return $this->db->where('penerima_berkas_id', (int) $this->session->userdata('id'))
                ->count_all_results($this->table_expedisi);
        }

        return $this->db->count_all($this->table_expedisi);
    }

    public function get_truck_checkup_list($limit = 50)
    {
        return $this->db->query("
            SELECT
                h.id_ckup,
                h.nopol,
                h.tanggal,
                h.jam,
                h.kilometer,
                h.input_by,
                COUNT(d.id_detail) AS total_item,
                SUM(CASE WHEN UPPER(d.status) = 'TIDAK BAIK' THEN 1 ELSE 0 END) AS total_problem
            FROM hrdga_checkup_mekanik h
            LEFT JOIN hrdga_checkup_mekanik_detail d ON d.id_ckup = h.id_ckup
            GROUP BY h.id_ckup
            ORDER BY h.id_ckup DESC
            LIMIT " . (int) $limit . "
        ")->result();
    }

    public function get_truck_checkup_header($id)
    {
        return $this->db
            ->where('id_ckup', (int) $id)
            ->get('hrdga_checkup_mekanik')
            ->row();
    }

    public function get_truck_checkup_detail($id)
    {
        return $this->db->query("
            SELECT
                d.id_detail,
                d.id_ckup,
                d.id_kategori,
                d.id_detail_kat,
                d.status,
                d.keterangan,
                d.evident,
                f.foto_list AS foto_kategori,
                k.nm_kategori,
                kd.nm_detail
            FROM hrdga_checkup_mekanik_detail d
            LEFT JOIN hrdga_checkup_mekanik_kategori k ON k.id_kategori = d.id_kategori
            LEFT JOIN hrdga_checkup_mekanik_kategori_detail kd ON kd.id_detail_kat = d.id_detail_kat
            LEFT JOIN (
                SELECT id_ckup, id_kategori, GROUP_CONCAT(foto) AS foto_list
                FROM hrdga_checkup_mekanik_kategori_foto
                GROUP BY id_ckup, id_kategori
            ) f ON f.id_ckup = d.id_ckup AND f.id_kategori = d.id_kategori
            WHERE d.id_ckup = " . (int) $id . "
            ORDER BY k.id_kategori ASC, kd.id_detail_kat ASC
        ")->result();
    }

    public function insert_truck_checkup_header($data)
    {
        $this->db->insert('hrdga_checkup_mekanik', $data);
        return $this->db->insert_id();
    }

    public function insert_truck_checkup_detail($data)
    {
        return $this->db->insert('hrdga_checkup_mekanik_detail', $data);
    }

    public function insert_truck_checkup_kategori_foto($data)
    {
        return $this->db->insert('hrdga_checkup_mekanik_kategori_foto', $data);
    }

    public function get_mekanik_kategori_all()
    {
        return $this->db
            ->order_by('id_kategori', 'asc')
            ->get('hrdga_checkup_mekanik_kategori')
            ->result();
    }

    public function get_mekanik_kategori_by_id($id)
    {
        return $this->db
            ->where('id_kategori', (int) $id)
            ->get('hrdga_checkup_mekanik_kategori')
            ->row();
    }

    public function insert_mekanik_kategori($data)
    {
        return $this->db->insert('hrdga_checkup_mekanik_kategori', $data);
    }

    public function update_mekanik_kategori($id, $data)
    {
        return $this->db
            ->where('id_kategori', (int) $id)
            ->update('hrdga_checkup_mekanik_kategori', $data);
    }

    public function delete_mekanik_kategori($id)
    {
        return $this->db
            ->where('id_kategori', (int) $id)
            ->delete('hrdga_checkup_mekanik_kategori');
    }

    public function count_mekanik_detail_by_kategori($id)
    {
        return $this->db
            ->where('id_kategori', (int) $id)
            ->from('hrdga_checkup_mekanik_kategori_detail')
            ->count_all_results();
    }

    public function get_mekanik_kategori_detail_all()
    {
        return $this->db->query("
            SELECT
                d.id_detail_kat,
                d.id_kategori,
                d.nm_detail,
                k.nm_kategori
            FROM hrdga_checkup_mekanik_kategori_detail d
            LEFT JOIN hrdga_checkup_mekanik_kategori k ON k.id_kategori = d.id_kategori
            ORDER BY d.id_kategori ASC, d.id_detail_kat ASC
        ")->result();
    }

    public function get_mekanik_kategori_detail_by_id($id)
    {
        return $this->db
            ->where('id_detail_kat', (int) $id)
            ->get('hrdga_checkup_mekanik_kategori_detail')
            ->row();
    }

    public function insert_mekanik_kategori_detail($data)
    {
        return $this->db->insert('hrdga_checkup_mekanik_kategori_detail', $data);
    }

    public function update_mekanik_kategori_detail($id, $data)
    {
        return $this->db
            ->where('id_detail_kat', (int) $id)
            ->update('hrdga_checkup_mekanik_kategori_detail', $data);
    }

    public function delete_mekanik_kategori_detail($id)
    {
        return $this->db
            ->where('id_detail_kat', (int) $id)
            ->delete('hrdga_checkup_mekanik_kategori_detail');
    }

    public function get_master_checkup_join()
    {
        return $this->db->query("
            SELECT
                k.id_kategori,
                k.nm_kategori,
                d.id_detail_kat,
                d.nm_detail
            FROM hrdga_checkup_mekanik_kategori k
            LEFT JOIN hrdga_checkup_mekanik_kategori_detail d
                ON d.id_kategori = k.id_kategori
            ORDER BY k.id_kategori ASC, d.id_detail_kat ASC
        ")->result();
    }
}
