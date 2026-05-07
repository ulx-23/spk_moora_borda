<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria extends CI_Controller {

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

    // Tampilkan Daftar Kriteria
    public function index()
    {
        $data['title'] = "Data Kriteria";
        $data['kriteria'] = $this->SPK_model->get_kriteria();
        
        $data['isi'] = 'kriteria/view_kriteria';
        $this->load->view('layout/wrapper', $data);
    }

    // Tampilkan Form Tambah
    public function tambah()
    {
        $data['title'] = "Tambah Kriteria";
        $data['isi'] = 'kriteria/view_form_kriteria';
        $data['action'] = base_url('kriteria/simpan');
        $data['row'] = null; // Kosong karena tambah baru
        
        $this->load->view('layout/wrapper', $data);
    }

    // Tampilkan Form Edit
    public function edit($id)
    {
        $data['title'] = "Edit Kriteria";
        $data['isi'] = 'kriteria/view_form_kriteria';
        $data['action'] = base_url('kriteria/update');
        
        // Ambil data lama berdasarkan ID
        $data['row'] = $this->SPK_model->get_by_id('tb_kriteria', 'id_kriteria', $id);
        
        $this->load->view('layout/wrapper', $data);
    }

    // Proses Simpan Baru
    public function simpan()
    {
        $data = [
            'kode_kriteria' => $this->input->post('kode_kriteria'),
            'nama_kriteria' => $this->input->post('nama_kriteria'),
            'bobot'         => $this->input->post('bobot'),
            'type'          => $this->input->post('type'),
        ];

        $this->SPK_model->insert_data('tb_kriteria', $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success">Data berhasil ditambahkan!</div>');
        redirect('kriteria');
    }

    // Proses Update Data
    public function update()
    {
        $id = $this->input->post('id_kriteria');
        $data = [
            'kode_kriteria' => $this->input->post('kode_kriteria'),
            'nama_kriteria' => $this->input->post('nama_kriteria'),
            'bobot'         => $this->input->post('bobot'),
            'type'          => $this->input->post('type'),
        ];

        $this->SPK_model->update_data('tb_kriteria', $data, ['id_kriteria' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-info">Data berhasil diupdate!</div>');
        redirect('kriteria');
    }

    // Proses Hapus
    public function hapus($id)
    {
        $this->SPK_model->delete_data('tb_kriteria', ['id_kriteria' => $id]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Data berhasil dihapus!</div>');
        redirect('kriteria');
    }
}