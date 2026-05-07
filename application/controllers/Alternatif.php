<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alternatif extends CI_Controller {

    public function __construct()
{
    parent::__construct();
    // 1. Cek Login
    if (!$this->session->userdata('id_user')) {
        redirect('auth');
    }
    // 2. Cek Role (Hanya Admin yang boleh)
    if ($this->session->userdata('role') != 'admin') {
        // Tampilkan pesan error akses ditolak (opsional) atau redirect dashboard
        redirect('dashboard'); 
    }
    
    $this->load->model('SPK_model');
}

    // Tampilkan Daftar Alternatif
    public function index()
    {
        $data['title'] = "Data Alternatif (Lokasi)";
        $data['alternatif'] = $this->SPK_model->get_alternatif();
        
        $data['isi'] = 'alternatif/view_alternatif';
        $this->load->view('layout/wrapper', $data);
    }

    // Form Tambah
    public function tambah()
    {
        $data['title'] = "Tambah Alternatif";
        $data['isi'] = 'alternatif/view_form_alternatif';
        $data['action'] = base_url('alternatif/simpan');
        $data['row'] = null; 
        
        $this->load->view('layout/wrapper', $data);
    }

    // Form Edit
    public function edit($id)
    {
        $data['title'] = "Edit Alternatif";
        $data['isi'] = 'alternatif/view_form_alternatif';
        $data['action'] = base_url('alternatif/update');
        $data['row'] = $this->SPK_model->get_by_id('tb_alternatif', 'id_alternatif', $id);
        
        $this->load->view('layout/wrapper', $data);
    }

    // Proses Simpan
    public function simpan()
    {
        $data = [
            'kode_alternatif' => $this->input->post('kode_alternatif'),
            'nama_alternatif' => $this->input->post('nama_alternatif'),
        ];

        $this->SPK_model->insert_data('tb_alternatif', $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Lokasi berhasil ditambahkan!</div>');
        redirect('alternatif');
    }

    // Proses Update
    public function update()
    {
        $id = $this->input->post('id_alternatif');
        $data = [
            'kode_alternatif' => $this->input->post('kode_alternatif'),
            'nama_alternatif' => $this->input->post('nama_alternatif'),
        ];

        $this->SPK_model->update_data('tb_alternatif', $data, ['id_alternatif' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-info">Lokasi berhasil diupdate!</div>');
        redirect('alternatif');
    }

    // Proses Hapus
    public function hapus($id)
    {
        // Hapus data alternatif
        $this->SPK_model->delete_data('tb_alternatif', ['id_alternatif' => $id]);
        
        // OPTIONAL: Hapus juga nilai penilaian yang terkait agar database bersih
        $this->SPK_model->delete_data('tb_penilaian', ['id_alternatif' => $id]);

        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Lokasi berhasil dihapus!</div>');
        redirect('alternatif');
    }
}