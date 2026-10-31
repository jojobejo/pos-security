<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_User extends CI_Model
{
    public function getAll()
    {
        return $this->db->select('id, nama_user, username, departemen, akses_lv')
            ->order_by('nama_user', 'ASC')->get('tb_user')->result();
    }

    public function username_exists($username, $exceptId)
    {
        return $this->db->where('username', $username)->where('id !=', (int) $exceptId)
            ->count_all_results('tb_user') > 0;
    }

    public function update_profile($id, $data)
    {
        $this->db->where('id', (int) $id)->update('tb_user', $data);
        $error = $this->db->error();
        if (!empty($error['code'])) {
            return false;
        }
        return $this->db->where('id', (int) $id)->count_all_results('tb_user') === 1;
    }

    public function addUser($data)
    {
        return $this->db->insert('tb_user', $data);
    }

    public function editUser($iduser, $data)
    {
        $this->db->where('id', $iduser);
        return $this->db->update('tb_user', $data);
    }

    public function deleteUser($iduser)
    {
        $this->db->where('id', $iduser);
        return $this->db->delete('tb_user');
    }
    function kduser()
    {
        $cd = $this->db->query("SELECT MAX(RIGHT(kode_user,4)) AS kd_max FROM tb_user WHERE DATE(create_at)=CURDATE()");
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
}
