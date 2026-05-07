<?php
// Menggabungkan pecahan layout
require_once('header.php');
require_once('sidebar.php');

// Memuat konten dinamis (variabel $isi dikirim dari Controller)
if (isset($isi) && $isi) {
    $this->load->view($isi);
}

require_once('footer.php');