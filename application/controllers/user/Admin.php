<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->require_admin();
        $this->load->model('M_User');
    }

    private function require_admin()
    {
        if ($this->session->userdata('status') !== 'is_login'
            || (string) $this->session->userdata('akses_lv') !== '1'
            || $this->session->userdata('departemen') !== 'IT') {
            show_error('Halaman ini hanya dapat diakses admin IT.', 403);
        }
    }

    public function index()
    {
        $data['page_title'] = 'User Management';
        $data['alluser'] = $this->M_User->getAll();
        $this->load->view('partial/main/header.php', $data);
        $this->load->view('content/user/admin.php', $data);
        $this->load->view('partial/main/footer.php');
    }

    public function update($id)
    {
        if ($this->input->method(TRUE) !== 'POST') {
            show_error('Metode request tidak diizinkan.', 405);
            return;
        }

        $id = (int) $id;
        $username = trim($this->input->post('username', true));
        $namaUser = trim($this->input->post('nama_user', true));
        $password = (string) $this->input->post('password');

        if (!$id || $username === '' || $namaUser === '') {
            $this->session->set_flashdata('gagal', 'Nama dan username wajib diisi.');
            redirect('userAdmin');
            return;
        }
        if ($this->M_User->username_exists($username, $id)) {
            $this->session->set_flashdata('gagal', 'Username sudah digunakan user lain.');
            redirect('userAdmin');
            return;
        }

        $update = ['username' => $username, 'nama_user' => $namaUser];
        if ($password !== '') {
            if (strlen($password) < 4) {
                $this->session->set_flashdata('gagal', 'Password minimal 4 karakter.');
                redirect('userAdmin');
                return;
            }
            $update['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if (!$this->M_User->update_profile($id, $update)) {
            $this->session->set_flashdata('gagal', 'Data user tidak ditemukan atau gagal diperbarui.');
        } else {
            $this->session->set_flashdata('success', 'Data user berhasil diperbarui.');
            if ($id === (int) $this->session->userdata('id')) {
                $this->session->set_userdata(['username' => $username, 'nama_user' => $namaUser]);
            }
        }
        redirect('userAdmin');
    }
}
