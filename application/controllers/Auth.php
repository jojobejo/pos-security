<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_Auth');
    }
    function index()
    {
        $this->load->view("partial/login/header");
        $this->load->view("content/login/body");
        $this->load->view("partial/login/footer");
    }
    function process()
    {
        $username = $this->input->post('user_isi');
        $password = $this->input->post('pass_isi');

        $check_username = $this->M_Auth->cek_username($username)->num_rows();
        if ($check_username > 0) {

            $check_password = $this->M_Auth->cek_password($username);

            foreach ($check_password as $key) {
                if ($key->username == $username && password_verify($password, $key->password)) {
                    $data_session = array(
                        'id'          => $key->id,
                        'username'    => $key->username,
                        'kduser'      => $key->kode_user,
                        'subdepartemen' => $key->sub_departemen,
                        'nama_user'   => $key->nama_user,
                        'akses_lv'    => $key->akses_lv,
                        'departemen'  => $key->departemen,
                        'status'      => "is_login"
                    );

                    if ($key->username === 'yunika' && $key->departemen === 'LOGISTIK') {
                        $this->session->set_userdata($data_session);
                        redirect('hrd_lap_expedisi');
                    } elseif ($key->departemen == 'KEUANGAN') {
                        $this->session->set_userdata($data_session);
                        redirect('hrd_lap_paket_pos');
                    } elseif ($key->departemen == 'MIA') {
                        $this->session->set_userdata($data_session);
                        redirect('hrd_lap_paket_pos');
                    } elseif ($key->departemen == 'HRD & GA') {
                        $this->session->set_userdata($data_session);
                        redirect('hrd_lap_paket_pos');
                    } else {
                        $this->session->set_userdata($data_session);
                        redirect('dashboard');
                    }
                } else {
                    $this->session->set_flashdata("gagal", "username / password salah!!!");
                    redirect('Auth');
                }
            }
        } else {
            $this->session->set_flashdata("gagal", "username salah");
            redirect('Auth');
        }
    }

    function logout()
    {
        $this->session->set_flashdata("logout", "Berhasil Log Out");
        $this->session->sess_destroy();
        redirect('Auth');
    }
}
