<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends CI_Controller {

    public function __construct()
{
    parent::__construct();
    // Cek Login Saja
    if (!$this->session->userdata('id_user')) {
        redirect('auth');
    }
    $this->load->model('SPK_model');
}

    // Halaman 1: List DM (Pilih siapa yang mau input)
    public function index()
    {
        $data['title'] = "Input Penilaian";
        $data['dms'] = $this->SPK_model->get_dms();
        
        $data['isi'] = 'penilaian/view_pilih_dm';
        $this->load->view('layout/wrapper', $data);
    }

    // Halaman 2: Form Matrix Input
    public function input($id_user)
    {
        // Ambil data user
        $user = $this->db->get_where('tb_users', ['id_user' => $id_user])->row();
        
        if(!$user) {
            redirect('penilaian'); // Jika user tidak ada
        }

        $data['title'] = "Form Penilaian - " . $user->nama_lengkap;
        $data['user'] = $user;
        
        // Ambil komponen tabel
        $data['alternatif'] = $this->SPK_model->get_alternatif();
        $data['kriteria'] = $this->SPK_model->get_kriteria();
        
        // Ambil nilai yang sudah tersimpan (jika ada)
        $data['nilai_lama'] = $this->SPK_model->get_penilaian_matrix($id_user);

        $data['isi'] = 'penilaian/view_form_matrix';
        $this->load->view('layout/wrapper', $data);
    }

    // Proses Simpan ke Database
    public function simpan()
    {
        $id_user = $this->input->post('id_user');
        $nilai = $this->input->post('nilai'); // Array 2 Dimensi

        if($nilai) {
            $this->SPK_model->simpan_penilaian($id_user, $nilai);
            
            // Set notifikasi sukses (Flashdata)
            $this->session->set_flashdata('pesan', '<div class="alert alert-success">Data penilaian berhasil disimpan!</div>');
        }

        redirect('penilaian/input/'.$id_user);
    }
}