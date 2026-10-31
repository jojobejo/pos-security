<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Kpi extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
        $this->load->model('M_Kpi');
    }

    public function index()
    {
        $data['page_title'] = 'KPI DIGITAL';
        $kd_user = $this->session->userdata('kduser');
        $data['allkpi'] = $this->M_Kpi->getkpi($kd_user)->result();

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/kpi/dashboard_kpi.php', $data);
        $this->load->view('partial/main/footer.php');
    }
    public function what()
    {
        $data['page_title'] = 'KPI DIGITAL';
        $kd_user = $this->session->userdata('kduser');
        $data['allkpi'] = $this->M_Kpi->getkpi($kd_user)->result();

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/kpi/dashboard_kpiwhat.php', $data);
        $this->load->view('partial/main/footer.php');
    }
    public function addkpi()
    {
        $kduser = $this->input->post('kd_isi');
        $subdep = $this->input->post('sub_isi');
        $dep    = $this->input->post('dep_isi');
        $tgl    = $this->input->post('date_isi');
        $bln    = $this->input->post('date_isi1');

        $datakpi = array(
            'kd_user'           => $kduser,
            'sub_departemen'    => $subdep,
            'departmen'        => $dep,
            'tgl_pembuatan'     => $tgl,
            'bln_pembuatan'     => $bln,
        );
        $this->M_Kpi->addkpi($datakpi);

        redirect('dashboardkpi');
    }
    public function detail_kpi($kduser, $bln)
    {
        $data['page_title'] = 'KPI DIGITAL';
        $data['tujuan'] = $this->M_Kpi->get_tujuan_kpi($kduser, $bln);

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/kpi/detail_kpi.php', $data);
        $this->load->view('partial/main/footer.php');
    }
}
