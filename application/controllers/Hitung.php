<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hitung extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SPK_model');
    }

    public function index()
    {
        // 1. Cek Hasil Borda (Final)
        $data['hasil_borda'] = $this->SPK_model->hitung_borda();
        
        // Tampilkan debug sederhana (JSON) untuk memastikan data benar
        echo "<pre>";
        print_r($data['hasil_borda']);
        echo "</pre>";
    }
    
    // Fungsi untuk cek per DM (misal ingin lihat DM1 saja)
    public function cek_dm($id_user)
    {
        $data['hasil_moora'] = $this->SPK_model->hitung_moora($id_user);
        
        echo "<h1>Hasil MOORA User ID: $id_user</h1>";
        echo "<pre>";
        print_r($data['hasil_moora']);
        echo "</pre>";
    }
}