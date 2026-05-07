<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SPK_model');
    }

    public function index()
    {
        // Jika user sudah login, lempar langsung ke dashboard
        if ($this->session->userdata('id_user')) {
            redirect('dashboard');
        }

        $this->load->view('login_view');
    }

    public function process()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password')); // Kita pakai MD5 sesuai database kamu

        // Cek User di Database
        $user = $this->db->get_where('tb_users', ['username' => $username, 'password' => $password])->row();

        if ($user) {
            // Jika User Ditemukan, Buat Session
            $params = [
                'id_user' => $user->id_user,
                'username' => $user->username,
                'nama_lengkap' => $user->nama_lengkap,
                'role' => $user->role,
                'status' => 'login'
            ];
            $this->session->set_userdata($params);

            // Redirect ke Dashboard
            redirect('dashboard');
        } else {
            // Jika Gagal
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center">Username atau Password Salah!</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}