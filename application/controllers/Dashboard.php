<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Cek Login
        if (!$this->session->userdata('id_user')) {
            redirect('auth');
        }
        $this->load->model('SPK_model');
    }

    public function index()
    {
        $data['title'] = "Dashboard & Statistik";
        
        // 1. Hitung Statistik Data Master (Card Atas)
        $data['count_kriteria'] = $this->db->count_all('tb_kriteria');
        $data['count_alternatif'] = $this->db->count_all('tb_alternatif');
        $data['count_users'] = $this->db->where('role', 'dm')->count_all_results('tb_users');

        // 2. Ambil Data Hasil Borda untuk Grafik
        $hasil_borda = $this->SPK_model->hitung_borda();

        // 3. Pisahkan Nama Lokasi dan Skor untuk dikirim ke ChartJS
        $chart_labels = [];
        $chart_data   = [];

        // Kita ambil 5-10 besar saja biar grafik tidak kepanjangan (opsional)
        // Atau ambil semua juga boleh. Di sini saya ambil semua.
        foreach ($hasil_borda as $row) {
            $chart_labels[] = $row['nama_alternatif']; // Sumbu X (Nama)
            $chart_data[]   = $row['total_poin'];      // Sumbu Y (Poin)
        }

        // Encode ke JSON agar bisa dibaca Javascript
        $data['chart_labels'] = json_encode($chart_labels);
        $data['chart_data']   = json_encode($chart_data);

        $data['isi'] = 'dashboard_view';
        $this->load->view('layout/wrapper', $data);
    }
}