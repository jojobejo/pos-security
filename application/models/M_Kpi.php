<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_Kpi extends CI_Model
{
    public function getkpi($kduser)
    {
        return $this->db->query("SELECT * FROM tb_kpiwhat
        ");
    }
    public function addkpi($data)
    {
        return $this->db->insert('tb_kpi', $data);
    }
    public function getwhtkpi($kduser, $bln)
    {
        return $this->db->query("SELECT * FROM tb_kpi_wht WHERE kd_user = '$kduser' AND bln_pembuatan = '$bln'
        ");
    }
    public function get_tujuan_kpi($kduser, $bln)
    {
        return $this->db->query("SELECT * FROM tb_kpi_wht WHERE kd_user = '$kduser' AND bln_pembuatan = '$bln'
        ");
    }
}
