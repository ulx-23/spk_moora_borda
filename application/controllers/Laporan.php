<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct()
{
    parent::__construct();
    // Cek Login Saja
    if (!$this->session->userdata('id_user')) {
        redirect('auth');
    }
    $this->load->model('SPK_model');
}

    public function index()
    {
        // Data untuk Header
        $data['title'] = "Laporan Hasil Keputusan";
        
        // Data Hasil Perhitungan
        $data['hasil_borda'] = $this->SPK_model->hitung_borda();
        
        $dms = $this->SPK_model->get_dms();
        $data['dms'] = $dms;
        $data['detail_moora'] = [];
        foreach($dms as $dm) {
            $data['detail_moora'][$dm['username']] = $this->SPK_model->hitung_moora($dm['id_user']);
        }

        // PENTING: Cara load template
        // Kita kirim variable 'isi' yang berisi lokasi file view konten
        $data['isi'] = 'laporan/view_laporan';
        
        // Load Wrapper (Induk Layout)
        $this->load->view('layout/wrapper', $data);
    }
    public function cetak()
    {
        // 1. Ambil Data Hasil Borda (Final)
        $data['hasil_borda'] = $this->SPK_model->hitung_borda();
        
        // 2. Ambil data User/DM (Opsional, jika ingin ditampilkan)
        $data['dms'] = $this->SPK_model->get_dms();

        // 3. Load View KHUSUS CETAK (Tanpa Wrapper/Sidebar)
        $this->load->view('laporan/view_cetak_laporan', $data);
    }
}