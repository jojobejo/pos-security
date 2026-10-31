<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
        $this->load->model('M_Logistik');
        $this->load->model('M_Hrd');
    }

    public function index()
    {
        $data['page_title'] = 'KARISMA';
        $data['logistik'] = $this->M_Logistik->get_all_do()->result();
        $data['tamu'] = $this->M_Hrd->getalltamulb()->result();

        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/body.php', $data);
        $this->load->view('partial/main/footer.php');
    }

    public function konfirm_tamu()
    {

        $id = $this->input->post('id');
        $tanggal = $this->input->post('tanggal');
        $nama = $this->input->post('nama');
        $perusahaan = $this->input->post('perusahaan');
        $alamat = $this->input->post('alamat');
        $jumlahpersonil = $this->input->post('jumlahpersonil');
        $tujuan = $this->input->post('tujuan');
        $jammasuk = $this->input->post('jammasuk');
        $jamkeluar = $this->input->post('jamkeluar');
        $keterangan = $this->input->post('keterangan');

        $data = array(
            'tanggal' => $tanggal,
            'nama' => $nama,
            'perusahaan' => $perusahaan,
            'alamat' => $alamat,
            'jumlahpersonil' => $jumlahpersonil,
            'tujuan' => $tujuan,
            'jammasuk' => $jammasuk,
            'jamkeluar' => $jamkeluar,
            'keterangan' => $keterangan,

        );
        $this->M_Hrd->konfirmtamulb($data);
        $this->M_Hrd->hapus_lap_tamu_lby($id);
        redirect('dashboard');
    }
}
