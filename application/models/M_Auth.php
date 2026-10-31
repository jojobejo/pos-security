<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class M_Auth extends CI_Model
{
    function cek_username($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('tb_user');
    }

    function cek_password($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('tb_user')->result();
    }
}
