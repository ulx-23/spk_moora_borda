<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SPK_model');
    }

    // Tampilkan Daftar User
    public function index()
    {
        $data['title'] = "Data Pengguna (User)";
        // Ambil semua data dari tb_users
        $data['users'] = $this->db->get('tb_users')->result_array();
        
        $data['isi'] = 'users/view_users';
        $this->load->view('layout/wrapper', $data);
    }

    // Form Tambah
    public function tambah()
    {
        $data['title'] = "Tambah User Baru";
        $data['isi'] = 'users/view_form_users';
        $data['action'] = base_url('users/simpan');
        $data['row'] = null; 
        
        $this->load->view('layout/wrapper', $data);
    }

    // Form Edit
    public function edit($id)
    {
        $data['title'] = "Edit User";
        $data['isi'] = 'users/view_form_users';
        $data['action'] = base_url('users/update');
        $data['row'] = $this->SPK_model->get_by_id('tb_users', 'id_user', $id);
        
        $this->load->view('layout/wrapper', $data);
    }

    // Proses Simpan Baru
    public function simpan()
    {
        $data = [
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'jabatan'      => $this->input->post('jabatan'),
            'username'     => $this->input->post('username'),
            'password'     => md5($this->input->post('password')), // Enkripsi MD5
            'role'         => $this->input->post('role'),
        ];

        $this->SPK_model->insert_data('tb_users', $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">User berhasil ditambahkan!</div>');
        redirect('users');
    }

    // Proses Update
    public function update()
    {
        $id = $this->input->post('id_user');
        
        $data = [
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'jabatan'      => $this->input->post('jabatan'),
            'username'     => $this->input->post('username'),
            'role'         => $this->input->post('role'),
        ];

        // Cek apakah password diisi?
        $password_baru = $this->input->post('password');
        if (!empty($password_baru)) {
            $data['password'] = md5($password_baru); // Update password jika diisi
        }

        $this->SPK_model->update_data('tb_users', $data, ['id_user' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-info">Data user berhasil diupdate!</div>');
        redirect('users');
    }

    // Proses Hapus
    public function hapus($id)
    {
        // Hapus user
        $this->SPK_model->delete_data('tb_users', ['id_user' => $id]);
        
        // PENTING: Hapus juga nilai penilaian yang pernah dibuat user ini
        // Agar tidak jadi data sampah
        $this->SPK_model->delete_data('tb_penilaian', ['id_user' => $id]);

        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">User berhasil dihapus!</div>');
        redirect('users');
    }
}