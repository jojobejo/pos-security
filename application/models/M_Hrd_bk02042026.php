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
        FROM tb_lap_distribusi a
        ");
    }
    public function getalltamulb()
    {
        return $this->db->query("SELECT a.*
        FROM tb_tamu_lby a
        ");
    }
    public function get_lap_id($id)
    {
        return $this->db->query("SELECT a.*
        FROM tb_lap_distribusi a
        WHERE id = $id
        ");
    }
    public function addlapdistribusihrd($data)
    {
        return $this->db->insert('tb_lap_distribusi', $data);
    }
    public function editlapdistribusihrd($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tb_lap_distribusi', $data);
    }
    public function hapus_lap_distribusi_hrd($id)
    {
        return $this->db->delete('tb_lap_distribusi', array("id" => $id));
    }

    public function konfirmtamulb($data)
    {
        return $this->db->insert('tb_tamu', $data);
    }

    public function get_all_tamu_lb()
    {
        return $this->db->query("SELECT a.*
        FROM tb_tamu_lby a
        ");
    }

    public function hapus_lap_tamu_lby($id)
    {
        return $this->db->delete('tb_tamu_lby', array("id" => $id));
    }
    public function addlaptamuhrd($data)
    {
        return $this->db->insert('tb_tamu_lby', $data);
    }
    public function editlaptamu($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tb_tamu', $data);
    }
    public function hapus_lap_tamu_lb($id)
    {
        return $this->db->delete('tb_tamu_lby', array("id" => $id));
    }
    public function hapus_lap_tamu_hrd($id)
    {
        return $this->db->delete('tb_tamu', array("id" => $id));
    }
    public function get_all_tamu()
    {
        return $this->db->query("SELECT a.*
        FROM tb_tamu a
        ");
    }
    //karyawan keluar masuk 

    public function get_all_laporan_karykm()
    {
        return $this->db->query("SELECT a.*
        FROM tb_karyawan_keluarmasuk a
        ");
    }
    public function addlapkarykm($data)
    {
        return $this->db->insert('tb_karyawan_keluarmasuk', $data);
    }
    public function editlapkarykm($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tb_karyawan_keluarmasuk', $data);
    }
    public function hapuslapkarykm($id)
    {
        return $this->db->delete('tb_karyawan_keluarmasuk', array("id" => $id));
    }

    //laporan Expedisi

    public function get_all_laporan_expedisi()
    {
        return $this->db->query("SELECT a.*
         FROM tb_expedisi a
         ");
    }

    public function addlapexpedisi($data)
    {
        return $this->db->insert('tb_expedisi', $data);
    }
    public function editlapexpedisi($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tb_expedisi', $data);
    }
    public function hapuslapexpedisi($id)
    {
        return $this->db->delete('tb_expedisi', array("id" => $id));
    }

    //issue

    public function get_all_laporan_issue()
    {
        return $this->db->query("SELECT a.*
        FROM tb_issue a
        ");
    }
    public function export_lap_issue()
    {
        return $this->db->get('tb_issue')->result();
    }
    public function export_lap_km_karyawan()
    {
        return $this->db->get('tb_karyawan_keluarmasuk')->result();
    }
    public function addlapissue($data)
    {
        return $this->db->insert('tb_issue', $data);
    }
    public function editlapissue($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tb_issue', $data);
    }
    public function hapuslapissue($id)
    {
        return $this->db->delete('tb_issue', array("id" => $id));
    }
    public function cari_lap_distribusi($v1, $v2)
    {
        return $this->db->query("SELECT a.*
        FROM tb_lap_distribusi a
        WHERE $v1 LIKE '$v2'
        ");
    }
    public function get_all_truk_service_histori()
    {
        return $this->db->query("SELECT a.*
        FROM tb_service_truk a
        ");
    }
    public function update_km_service($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tb_service_truk', $data);
    }
    public function get_all_karyawan()
    {
        return $this->db->query("SELECT a.*
        FROM tb_user a WHERE id > '4'
        ");
    }
    public function update_karyawan($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tb_user', $data);
    }
    public function add_karyawan($data)
    {
        return $this->db->insert('tb_user', $data);
    }



    var $table = 'tb_lap_distribusi';
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
        return $this->db->truncate('tb_lap_distribusi');
    }

    public function truncate_lap_tamu()
    {
        return $this->db->truncate('hrd_lap_tamu');
    }

    var $table1 = 'tb_tamu';

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

    var $table_karykm = 'tb_karyawan_keluarmasuk';

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

    var $table_expedisi = 'tb_expedisi';
    var $column_order_expedisi = [
        'tanggal', 'jamkeluar', 'jammasuk', 'nopol', 'namadriver',
        'notlpndriver', 'perusahaanpengirim', 'namabarang', 'jumlahbarang', 'keterangan'
    ];
    var $column_search_expedisi = [
        'nopol', 'namadriver', 'perusahaanpengirim', 'namabarang'
    ];
    var $order_expedisi = ['tanggal' => 'desc'];

    private function _get_query_expedisi()
    {
        $this->db->from($this->table_expedisi);

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
        return $this->db->count_all($this->table_expedisi);
    }

    var $table_pos = 'tb_terima_paket';

    var $column_order_pos = [
        'id',
        'tanggal',
        'kd_penerima',
        'keterangan_1',
        'tanggal_terima_1',
        'tanggal_terima_2',
        'jam_terima_1',
        'jam_terima_2',
        'status',
        'inputer'
    ];

    var $column_search_pos = [
        'kd_penerima',
        'keterangan_1',
        'status',
        'inputer'
    ];

    var $order_pos = ['tanggal' => 'desc'];

    private function _get_datatables_query_pos($user)
    {
        $this->db->from($this->table_pos);

        switch ($user) {
            case 'SUPRIYANTO':
                $this->db->where_in('kd_penerima', ['TRI', 'IKA', 'SUPRIYANTO']);
                break;
            case 'IKA':
                $this->db->where_in('kd_penerima', ['TRI', 'IKA', 'SUPRIYANTO']);
                break;
            case 'MIA':
                $this->db->where('kd_penerima', 'MIA');
                break;
            case 'NITA':
                $this->db->where('kd_penerima', 'NITA');
                break;
            case 'LADY':
                $this->db->where('kd_penerima', 'LADY');
                break;
            case 'SHEILA':
                $this->db->where('kd_penerima', 'SHEILA');
                break;
            default:
                $this->db->where_in('kd_penerima', ['TRI', 'IKA', 'SUPRIYANTO', 'LADY', 'MIA', 'NITA', 'SHEILA']);
                break;
        }

        if (!empty($_POST['search']['value'])) {
            $this->db->group_start();
            $this->db->like('keterangan_1', $_POST['search']['value']);
            $this->db->or_like('kd_penerima', $_POST['search']['value']);
            $this->db->group_end();
        }

        if (isset($_POST['order'])) {
            $this->db->order_by(
                $this->column_order_pos[$_POST['order'][0]['column']],
                $_POST['order'][0]['dir']
            );
        } else {
            $this->db->order_by('tanggal', 'DESC');
        }
    }


    public function get_datatables_get_pos_paket($user)
    {
        $this->_get_datatables_query_pos($user);

        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        return $this->db->get()->result();
    }


    public function count_all_pos_paket($user)
    {
        $this->_get_datatables_query_pos($user);
        return $this->db->count_all_results();
    }

    public function count_filtered_pos_paket($user)
    {
        $this->_get_datatables_query_pos($user);
        return $this->db->get()->num_rows();
    }


    public function insert_penerimaan_paket($data)
    {
        return $this->db->insert('tb_terima_paket', $data);
    }

    public function update_penerimaan_paket($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tb_terima_paket', $data);
    }

    public function get_paket_by_id($id)
    {
        return $this->db
            ->where('id', $id)
            ->get('tb_terima_paket')
            ->row();
    }

    public function hapus_penerimaan_paket($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_terima_paket');

        return $this->db->affected_rows();
    }

    public function insert_header_checklist_kendaraan($data)
    {
        $this->db->insert('tb_checklist_kendaraan', $data);
        return $this->db->insert_id();
    }

    public function insert_foto_checklist($data)
    {
        return $this->db->insert('tb_gbrupload_cheklist', $data);
    }

    public function get_foto_checklist($id_checklist)
    {
        return $this->db
            ->where('id_cheklist', $id_checklist)
            ->get('tb_gbrupload_cheklist')
            ->result();
    }


    public function insert_detail_checklist_kendaraan($data)
    {
        return $this->db->insert('tb_checklist_kendaraan_detail', $data);
    }

    public function get_master_parts_checklist_kendaraan()
    {
        return [
            'KABIN' => [
                'Kaca Depan', 'Kaca Samping L/R', 'Wipper', 'Pintu L/R',
                'Handle Pintu L/R', 'Talang Air', 'Lampu-lampu', 'Body',
                'Grill', 'Spion L/R', 'Roda Depan', 'Lain-lain'
            ],
            'BOX/BACK' => [
                'Box Bagian Luar', 'Box Bagian Dalam', 'Pintu Box Belakang',
                'Pintu Box Samping', 'Accu', 'Lampu-lampu', 'Tangki BBM + Tutup',
                'Gembok', 'Ban Belakang', 'Ban Serep',
                'Kebersihan Dalam', 'Kebersihan Luar'
            ]
        ];
    }

    public function get_laporan_checklist_kendaraan($filter)
    {
        $this->db->select('
            h.id,
            h.tanggal_check,
            h.driver,
            h.nopol,
            h.no_lambung,
            h.kilometer,
            h.inputer,
            SUM(CASE WHEN d.kondisi = "TIDAK BAIK" THEN 1 ELSE 0 END) AS total_tidak_baik
        ');
        $this->db->from('tb_checklist_kendaraan h');
        $this->db->join('tb_checklist_kendaraan_detail d', 'd.checklist_id = h.id', 'left');
        $this->db->group_by('h.id');

        if (!empty($filter['tanggal_awal'])) {
            $this->db->where('h.tanggal_check >=', $filter['tanggal_awal']);
        }

        if (!empty($filter['tanggal_akhir'])) {
            $this->db->where('h.tanggal_check <=', $filter['tanggal_akhir']);
        }

        if (!empty($filter['nopol'])) {
            $this->db->like('h.nopol', $filter['nopol']);
        }

        if (!empty($filter['driver'])) {
            $this->db->like('h.driver', $filter['driver']);
        }

        return $this->db->get()->result();
    }

    public function get_detail_checklist($checklist_id)
    {
        return $this->db
            ->where('checklist_id', $checklist_id)
            ->get('tb_checklist_kendaraan_detail')
            ->result();
    }

    var $table_checklist_kendaraan = 'tb_checklist_kendaraan h';

    var $column_order_checklist_kendaraan = [
        null,
        'tanggal_check',
        'driver',
        'nopol',
        'no_lambung',
        'kilometer',
        null,
        null
    ];

    var $column_search_checklist_kendaraan = [
        'driver',
        'nopol',
        'no_lambung'
    ];

    var $order_checklist_kendaraan = ['tanggal_check' => 'desc'];

    private function _get_datatables_query_checklist_kendaraan()
    {
        $this->db->select('
            h.id,
            h.tanggal_check,
            h.driver,
            h.nopol,
            h.no_lambung,
            h.kilometer,
            h.inputer,
            SUM(CASE WHEN d.kondisi = "TIDAK BAIK" THEN 1 ELSE 0 END) AS total_tidak_baik
        ');
        $this->db->from($this->table_checklist_kendaraan);
        $this->db->join(
            'tb_checklist_kendaraan_detail d',
            'd.checklist_id = h.id',
            'left'
        );
        $this->db->group_by('h.id');

        if (!empty($_POST['search']['value'])) {
            $this->db->group_start();
            foreach ($this->column_search_checklist_kendaraan as $item) {
                $this->db->or_like($item, $_POST['search']['value']);
            }
            $this->db->group_end();
        }

        if (isset($_POST['order'])) {
            $this->db->order_by(
                $this->column_order_checklist_kendaraan[$_POST['order'][0]['column']],
                $_POST['order'][0]['dir']
            );
        } else {
            $this->db->order_by(
                key($this->order_checklist_kendaraan),
                $this->order_checklist_kendaraan[key($this->order_checklist_kendaraan)]
            );
        }
    }

    public function get_datatables_checklist_kendaraan()
    {
        $this->_get_datatables_query_checklist_kendaraan();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

        return $this->db->get()->result();
    }

    public function count_filtered_checklist_kendaraan()
    {
        $this->_get_datatables_query_checklist_kendaraan();
        return $this->db->get()->num_rows();
    }

    public function count_all_checklist_kendaraan()
    {
        return $this->db
            ->from($this->table_checklist_kendaraan)
            ->count_all_results();
    }

    public function get_checklist_header($id)
    {
        return $this->db
            ->where('id', $id)
            ->get('tb_checklist_kendaraan')
            ->row();
    }

    public function get_checklist_detail_grouped($id)
    {
        $query = $this->db
            ->where('checklist_id', $id)
            ->order_by('kategori, nama_part')
            ->get('tb_checklist_kendaraan_detail')
            ->result();

        $grouped = [];
        foreach ($query as $row) {
            $grouped[$row->kategori][] = $row;
        }

        return $grouped;
    }

    public function get_exported_checklist_kendaraan()
    {
        return $this->db->query("SELECT
            h.id,
            h.tanggal_check,
            h.nopol,
            h.driver,
            COUNT(DISTINCT d.kategori) AS total_kategori,
            COUNT(d.id) AS total_part,
            SUM(CASE WHEN d.kondisi = 'BAIK' THEN 1 ELSE 0 END) AS total_baik,
            SUM(CASE WHEN d.kondisi = 'TIDAK BAIK' THEN 1 ELSE 0 END) AS total_tidak_baik
        FROM tb_checklist_kendaraan h
        LEFT JOIN tb_checklist_kendaraan_detail d ON d.checklist_id = h.id
        GROUP BY h.id;")->result();
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
            FROM tb_checkup_mekanik h
            LEFT JOIN tb_checkup_mekanik_detail d ON d.id_ckup = h.id_ckup
            GROUP BY h.id_ckup
            ORDER BY h.id_ckup DESC
            LIMIT " . (int) $limit . "
        ")->result();
    }

    public function get_truck_checkup_header($id)
    {
        return $this->db
            ->where('id_ckup', (int) $id)
            ->get('tb_checkup_mekanik')
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
                k.nm_kategori,
                kd.nm_detail
            FROM tb_checkup_mekanik_detail d
            LEFT JOIN tb_checkup_mekanik_kategori k ON k.id_kategori = d.id_kategori
            LEFT JOIN tb_checkup_mekanik_kategori_detail kd ON kd.id_detail_kat = d.id_detail_kat
            WHERE d.id_ckup = " . (int) $id . "
            ORDER BY k.id_kategori ASC, kd.id_detail_kat ASC
        ")->result();
    }

    public function insert_truck_checkup_header($data)
    {
        $this->db->insert('tb_checkup_mekanik', $data);
        return $this->db->insert_id();
    }

    public function insert_truck_checkup_detail($data)
    {
        return $this->db->insert('tb_checkup_mekanik_detail', $data);
    }

    public function get_mekanik_kategori_all()
    {
        return $this->db
            ->order_by('id_kategori', 'asc')
            ->get('tb_checkup_mekanik_kategori')
            ->result();
    }

    public function get_mekanik_kategori_by_id($id)
    {
        return $this->db
            ->where('id_kategori', (int) $id)
            ->get('tb_checkup_mekanik_kategori')
            ->row();
    }

    public function insert_mekanik_kategori($data)
    {
        return $this->db->insert('tb_checkup_mekanik_kategori', $data);
    }

    public function update_mekanik_kategori($id, $data)
    {
        return $this->db
            ->where('id_kategori', (int) $id)
            ->update('tb_checkup_mekanik_kategori', $data);
    }

    public function delete_mekanik_kategori($id)
    {
        return $this->db
            ->where('id_kategori', (int) $id)
            ->delete('tb_checkup_mekanik_kategori');
    }

    public function count_mekanik_detail_by_kategori($id)
    {
        return $this->db
            ->where('id_kategori', (int) $id)
            ->from('tb_checkup_mekanik_kategori_detail')
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
            FROM tb_checkup_mekanik_kategori_detail d
            LEFT JOIN tb_checkup_mekanik_kategori k ON k.id_kategori = d.id_kategori
            ORDER BY d.id_kategori ASC, d.id_detail_kat ASC
        ")->result();
    }

    public function get_mekanik_kategori_detail_by_id($id)
    {
        return $this->db
            ->where('id_detail_kat', (int) $id)
            ->get('tb_checkup_mekanik_kategori_detail')
            ->row();
    }

    public function insert_mekanik_kategori_detail($data)
    {
        return $this->db->insert('tb_checkup_mekanik_kategori_detail', $data);
    }

    public function update_mekanik_kategori_detail($id, $data)
    {
        return $this->db
            ->where('id_detail_kat', (int) $id)
            ->update('tb_checkup_mekanik_kategori_detail', $data);
    }

    public function delete_mekanik_kategori_detail($id)
    {
        return $this->db
            ->where('id_detail_kat', (int) $id)
            ->delete('tb_checkup_mekanik_kategori_detail');
    }

    public function get_master_checkup_join()
    {
        return $this->db->query("
            SELECT
                k.id_kategori,
                k.nm_kategori,
                d.id_detail_kat,
                d.nm_detail
            FROM tb_checkup_mekanik_kategori k
            LEFT JOIN tb_checkup_mekanik_kategori_detail d
                ON d.id_kategori = k.id_kategori
            ORDER BY k.id_kategori ASC, d.id_detail_kat ASC
        ")->result();
    }
}
