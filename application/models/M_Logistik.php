<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_Logistik extends CI_Model
{
    //Truck Plat Config
    public function getallplat()
    {
        return $this->db->get('tb_op_plat')->result();
    }
    public function addnoplatbaru($data)
    {
        return $this->db->insert('tb_op_plat', $data);
    }
    public function editnoplat($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tb_op_plat', $data);
    }
    public function deletenoplat($id)
    {
        return $this->db->delete('tb_op_plat', array("id" => $id));
    }
    //Helper Config
    public function getallhelper()
    {
        return $this->db->get('tb_op_helper')->result();
    }
    public function addhelperbaru($data)
    {
        return $this->db->insert('tb_op_helper', $data);
    }
    public function edithelper($id, $data)
    {
        $this->db->where('kd_helper', $id);
        return $this->db->update('tb_op_helper', $data);
    }
    public function hapushelper($id)
    {
        return $this->db->delete('tb_op_helper', array("id" => $id));
    }
    function kd_helper()
    {
        $cd = $this->db->query("SELECT MAX(RIGHT(kd_helper,4)) AS kd_max FROM tb_op_helper WHERE DATE(create_at)=CURDATE()");
        $kd = "";
        if ($cd->num_rows() > 0) {
            foreach ($cd->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'KIUH' . date('dmy') . $kd;
    }
    //Driver Config
    public function getalldriver()
    {
        return $this->db->get('tb_op_driver')->result();
    }
    public function getnorutdriveractive()
    {
        $this->db->select('*');
        $this->db->from('tb_op_driver');
        $this->db->where('status', 'ACTIVE');
        $this->db->order_by('no_urut_hr_i', 'ASC');
        return $this->db->get()->result();
    }
    public function adddriverbaru($data)
    {
        return $this->db->insert('tb_op_driver', $data);
    }
    public function editdriver($id, $data)
    {
        $this->db->where('kd_driver', $id);
        return $this->db->update('tb_op_driver', $data);
    }
    public function hapusdriver($id)
    {
        return $this->db->delete('tb_op_driver', array("id" => $id));
    }
    function kd_driver()
    {
        $cd = $this->db->query("SELECT MAX(RIGHT(kd_driver,4)) AS kd_max FROM tb_op_driver WHERE DATE(create_at)=CURDATE()");
        $kd = "";
        if ($cd->num_rows() > 0) {
            foreach ($cd->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'KIU' . date('dmy') . $kd;
    }
    function get_kd_order()
    {
        $cd = $this->db->query("SELECT MAX(RIGHT(kd_order,4)) as kd_max FROM tb_order_tracking_driver WHERE DATE(create_at)=CURDATE()");
        $kd = "";
        if ($cd->num_rows() > 0) {
            foreach ($cd->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'KIUD' . date('dmy') . $kd;
    }
    function insert_detail_order_driver($data)
    {
        return $this->db->insert('tb_det_tracking_driver', $data);
    }
    function insert_deliveri_order($data)
    {
        return $this->db->insert('tb_order_tracking_driver', $data);
    }

    function get_deliv_logistik()
    {
        return $this->db->query("SELECT 
        *, 
        COUNT(CASE WHEN  b.sts_driver = 'READY' then 1 ELSE NULL END) as 'd_ready' ,
        COUNT(CASE WHEN  b.sts_driver = 'PENDING' then 1 ELSE NULL END) as 'd_pending',
        COUNT(CASE WHEN b.sts_driver = 'ON THE ROAD' THEN 1 ELSE NULL END) as 'd_otr',
        COUNT(CASE WHEN b.sts_driver = 'WAITING' THEN 1 ELSE NULL END) as 'd_wait'
        FROM tb_order_tracking_driver a
        JOIN tb_det_tracking_driver b ON b.kd_deliveri = a.kd_order
        GROUP BY a.kd_order
        ORDER BY a.id
        ");
    } 
    function get_all_do()
    {
        return $this->db->query("SELECT 
       *, 
       COUNT(CASE WHEN  b.sts_driver = 'READY' then 1 ELSE NULL END) as 'd_ready' ,
       COUNT(CASE WHEN  b.sts_driver = 'PENDING' then 1 ELSE NULL END) as 'd_pending',
       COUNT(CASE WHEN b.sts_driver = 'ON THE ROAD' THEN 1 ELSE NULL END) as 'd_otr'
       FROM tb_order_tracking_driver a
       JOIN tb_det_tracking_driver b ON b.kd_deliveri = a.kd_order
       WHERE  YEARWEEK(a.create_at, 1) = YEARWEEK(CURDATE(), 1)
       GROUP BY a.kd_order
       ORDER BY a.id
       ");
    }
    public function get_driver($kduser)
    {
        $this->db->select('*');
        $this->db->limit('6');
        $this->db->from('tb_op_driver');
        $this->db->like('nama_driver', $kduser);
        return $this->db->get()->result_array();
    }
    function get_order($kd)
    {
        $this->db->select('*');
        $this->db->from('tb_order_tracking_driver');
        $this->db->where('kd_order', $kd);
        $this->db->limit(1);
        return $this->db->get()->result();
    }
    function get_det_deliv($kd)
    {
        return $this->db->query("SELECT 
        a.kd_helper,a.jml_kios,a.tonase,a.kubikasi,d.nama_helper,a.id,a.norut,a.tgl_jalan, a.nm_toko, a.kd_deliveri , a.kd_driver ,b.nama_driver, a.kd_truk , COALESCE(c.noplat,'-') as noplat , a.destinasi , a.sts_driver , COALESCE(NULLIF(a.keterangan,''),'-') as keterangan 
        FROM tb_det_tracking_driver a JOIN tb_op_driver b ON b.kd_driver = a.kd_driver LEFT JOIN tb_op_plat c ON c.nm_truk = a.kd_truk LEFT JOIN tb_op_helper d ON d.kd_helper = a.kd_helper 
        WHERE a.kd_deliveri = '$kd' 
        GROUP BY a.kd_driver");
    }
    function export_tracking()
    {
        return $this->db->query("SELECT a.id,a.norut,a.tgl_jalan, a.nm_toko, a.kd_deliveri,b.nama_driver,d.nama_helper ,a.kd_truk , COALESCE(c.noplat,'-') as noplat , a.destinasi ,a.jml_kios,a.tonase,a.kubikasi ,a.sts_driver , COALESCE(NULLIF(a.keterangan,''),'-') as keterangan 
        FROM tb_det_tracking_driver a 
        JOIN tb_op_driver b ON b.kd_driver = a.kd_driver 
        JOIN tb_op_helper d ON d.kd_helper = a.kd_helper
        LEFT JOIN tb_op_plat c ON c.nm_truk = a.kd_truk");
    }
    function get_det_jalan_driver($kdorder, $driver)
    {
        return $this->db->query("SELECT a.id, a.kd_deliveri , a.destinasi,a.tgl_jalan ,a.kd_driver ,b.nama_driver, a.kd_truk , c.noplat , a.nm_toko FROM tb_det_tracking_driver a JOIN tb_op_driver b ON b.kd_driver = a.kd_driver JOIN tb_op_plat c ON c.nm_truk = a.kd_truk WHERE a.kd_deliveri = '$kdorder' AND a.kd_driver = '$driver';");
    }
    public function get_kd($kd)
    {
        return $this->db->query("SELECT a.id, a.kd_deliveri , a.destinasi,a.tgl_jalan ,a.kd_driver ,b.nama_driver, a.kd_truk , c.noplat , a.nm_toko FROM tb_det_tracking_driver a JOIN tb_op_driver b ON b.kd_driver = a.kd_driver JOIN tb_op_plat c ON c.nm_truk = a.kd_truk WHERE a.kd_deliveri = '$kd' LIMIT 1");
    }
    function insert_pnd_driver($data)
    {
        return $this->db->insert_batch('tb_driver_pending', $data);
    }
    function delete_tr_detail_driver($id)
    {
        return $this->db->delete('tb_det_tracking_driver', array("id" => $id));
    }
    function get_pnd_driver()
    {
        return $this->db->query("SELECT a.kd_deliveri , a.tgl_jalan , c.nama_driver , b.noplat , a.kd_truk , a.destinasi , COUNT(a.nm_toko) AS jml_toko ,a.note_pending, a.kd_driver
        FROM tb_driver_pending a
        join tb_op_plat b ON b.nm_truk = a.kd_truk
        JOIN tb_op_driver c ON c.kd_driver = a.kd_driver
        GROUP BY a.kd_deliveri , a.kd_driver
        ");
    }
    function get_det_driver_pnd($kd1, $kd2)
    {
        return $this->db->query("SELECT a.id,a.kd_deliveri , a.tgl_jalan , c.nama_driver , b.noplat , a.kd_truk , a.destinasi ,a.nm_toko ,a.note_pending, a.kd_driver
        FROM tb_driver_pending a
        join tb_op_plat b ON b.nm_truk = a.kd_truk
        JOIN tb_op_driver c ON c.kd_driver = a.kd_driver
        WHERE a.kd_deliveri = '$kd1' AND a.kd_driver = '$kd2'");
    }
    public function get_kd_det_pnd($kd)
    {
        return $this->db->query("SELECT a.id, a.kd_deliveri , a.destinasi,a.tgl_jalan ,a.kd_driver ,b.nama_driver, a.kd_truk , c.noplat , a.nm_toko FROM tb_det_tracking_driver a JOIN tb_op_driver b ON b.kd_driver = a.kd_driver JOIN tb_op_plat c ON c.nm_truk = a.kd_truk WHERE a.kd_deliveri = '$kd' LIMIT 1");
    }
    public function get_all_driver()
    {
        $this->db->select('*');
        $this->db->from('tb_op_driver');
        $this->db->where('status', 'ACTIVE');
        $this->db->order_by("no_urut_hr_i", "asc");
        return $this->db->get()->result();
    }
    public function select_kd_truk()
    {
        $this->db->select('*');
        $this->db->from('tb_op_plat');
        return $this->db->get()->result();
    }
    public function select_kd_helper()
    {
        $this->db->select('*');
        $this->db->from('tb_op_helper');
        $this->db->where('status', 'ACTIVE');
        return $this->db->get()->result();
    }
    public function get_data_driver()
    {
        return $this->db->query("SELECT b.nama_driver , b.kd_driver, 
        COUNT(CASE WHEN  a.sts_driver = 'READY' then 1 ELSE NULL END) + COUNT(CASE WHEN  a.sts_driver = 'ON THE ROAD' then 1 ELSE NULL END)  as 'd_ready',
        COUNT(CASE WHEN  a.sts_driver = 'PENDING' then 1 ELSE NULL END) as 'd_pending',
        ROUND((COUNT(CASE WHEN  a.sts_driver = 'READY' then 1 ELSE NULL END) + COUNT(CASE WHEN  a.sts_driver = 'ON THE ROAD' then 1 ELSE NULL END)) / (COUNT(CASE WHEN  a.sts_driver = 'READY' then 1 ELSE NULL END) + COUNT(CASE WHEN  a.sts_driver = 'ON THE ROAD' then 1 ELSE NULL END) + COUNT(CASE WHEN  a.sts_driver = 'PENDING' then 1 ELSE NULL END)) * 100 , 2) AS persentase
        FROM tb_det_tracking_driver a
        JOIN tb_op_driver b ON b.kd_driver = a.kd_driver
        GROUP BY a.kd_driver         
        ");
    }
    public function get_det_tracking($kd)
    {
        return $this->db->query("SELECT a.sts_driver,d.nama_helper,a.kd_deliveri , a.tgl_jalan ,a.kd_truk , COALESCE(c.noplat,'-') AS noplat , a.destinasi,COALESCE(NULLIF(a.keterangan,''),'-') AS keterangan
        FROM tb_det_tracking_driver a
        LEFT JOIN tb_op_driver b ON b.kd_driver = a.kd_driver
        LEFT JOIN tb_op_plat c on c.nm_truk = a.kd_truk
        LEFT JOIN tb_op_helper d on d.kd_helper = a.kd_helper
        WHERE b.kd_driver = '$kd'
        GROUP BY a.kd_deliveri
        ");
    }
    public function get_det_data_driver($kd)
    {
        return $this->db->query("SELECT b.nama_driver , b.kd_driver
        FROM tb_det_tracking_driver a
        JOIN tb_op_driver b ON b.kd_driver = a.kd_driver
        WHERE b.kd_driver = '$kd' 
        GROUP BY a.kd_driver 
        ");
    }
    public function get_deliv($kd)
    {
        $this->db->select('*');
        $this->db->from('tb_det_tracking_driver a');
        $this->db->join('tb_op_driver b', 'b.kd_driver = a.kd_driver', 'left');
        $this->db->join('tb_op_plat c', 'c.nm_truk = a.kd_truk', 'left');
        $this->db->join('tb_op_helper d', 'd.kd_helper = a.kd_helper', 'left');
        $this->db->where('kd_deliveri', $kd);
        return $this->db->get()->result();
    }
    public function detail_deliv($kd)
    {
        $this->db->select('*');
        $this->db->from('tb_order_tracking_driver');
        $this->db->where('kd_order', $kd);
        return $this->db->get()->result();
    }
    public function edit_detail_order_driver($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tb_det_tracking_driver', $data);
    }
    public function deleteorder($id)
    {
        return $this->db->delete('tb_order_tracking_driver', array("kd_order" => $id));
    }
    public function deletedetailorder($id)
    {
        return $this->db->delete('tb_det_tracking_driver', array('kd_deliveri' => $id));
    }
    public function export_lap_distribusi()
    {
        return $this->db->get('tb_lap_distribusi')->result();
    }

    function get_tmp_distribusi()
    {
        return $this->db->query("SELECT a.*,b.noplat,b.nm_truk,c.nama_driver,d.nama_helper
        FROM tb_tmp_lap_distribusi a
        join tb_op_plat b ON b.nm_truk = a.kd_truk
        JOIN tb_op_driver c ON c.kd_driver = a.kd_driver
        JOIN tb_op_helper d ON d.kd_helper = a.kd_helper
        WHERE a.status ='ready'
        ");
    }
    public function insert_lap_distribusi($data)
    {
        return $this->db->insert('tb_lap_distribusi', $data);
    }
    public function edited_tmp_lap_dis($id, $data)
    {
        $this->db->where('id_lap_dis', $id);
        return $this->db->update('tb_tmp_lap_distribusi', $data);
    }
    public function delete_tmp_lap_dis($id)
    {
        return $this->db->delete('tb_tmp_lap_distribusi', array('id_lap_dis' => $id));
    }
}
