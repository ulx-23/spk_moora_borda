<?php 
    $role = $this->session->userdata('role'); 
    $uri  = $this->uri->segment(1); 
    
    // PERBAIKAN ERROR: Pastikan role tidak NULL
    // Jika null, kita isi string kosong agar strtoupper tidak error
    $role_safe = $role ?? ''; 
?>

<div class="border-end" id="sidebar-wrapper">
    <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
        <i class="fas fa-chart-line me-2"></i>SPK GDSS
    </div>

    <div class="list-group list-group-flush my-3">
        
        <a href="<?= base_url('dashboard') ?>" 
           class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= ($uri == 'dashboard' || $uri == '') ? 'active' : '' ?>">
            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
        </a>

        <?php if($role_safe == 'admin'): ?>
            <div class="sidebar-heading mt-3 mb-1 text-white-50" style="font-size: 0.75rem;">MASTER DATA</div>
            
            <a href="<?= base_url('kriteria') ?>" 
               class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= ($uri == 'kriteria') ? 'active' : '' ?>">
                <i class="fas fa-list me-2"></i>Data Kriteria
            </a>
            <a href="<?= base_url('alternatif') ?>" 
               class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= ($uri == 'alternatif') ? 'active' : '' ?>">
                <i class="fas fa-map-marker-alt me-2"></i>Data Alternatif
            </a>
            <a href="<?= base_url('users') ?>" 
               class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= ($uri == 'users') ? 'active' : '' ?>">
                <i class="fas fa-users me-2"></i>Data User (DM)
            </a>
        <?php endif; ?>
        
        <div class="sidebar-heading mt-3 mb-1 text-white-50" style="font-size: 0.75rem;">PENILAIAN</div>
        
        <a href="<?= base_url('penilaian') ?>" 
           class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= ($uri == 'penilaian') ? 'active' : '' ?>">
            <i class="fas fa-edit me-2"></i>Input Penilaian
        </a>
        
        <div class="sidebar-heading mt-3 mb-1 text-white-50" style="font-size: 0.75rem;">HASIL</div>

        <a href="<?= base_url('laporan') ?>" 
           class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= ($uri == 'laporan') ? 'active' : '' ?>">
            <i class="fas fa-trophy me-2"></i>Laporan Akhir
        </a>
        
        <!-- <a href="<?= base_url('auth/logout') ?>" 
           onclick="return confirm('Apakah Anda yakin ingin keluar dari sistem?')" 
           class="list-group-item list-group-item-action bg-transparent text-danger fw-bold mt-5">
            <i class="fas fa-power-off me-2"></i>Logout
        </a> -->
    </div>
</div>
<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-3 px-4 shadow-sm">
        <div class="d-flex align-items-center w-100 justify-content-between">
            
            <div class="d-flex align-items-center">
                <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle" style="cursor: pointer;"></i>
                <h4 class="m-0"><?= $title ?? 'Dashboard' ?></h4>
            </div>

            <div class="d-flex align-items-center">
                <div class="text-end me-3 d-none d-md-block">
                    <div class="fw-bold small text-dark">
                        <?= $this->session->userdata('nama_lengkap') ?? 'User' ?>
                    </div>
                    <div class="text-muted small" style="font-size: 0.8rem;">
                        <?php 
                            // AMBIL ROLE DENGAN AMAN
                            $role_cek = $this->session->userdata('role');
                            
                            // Jika role kosong, isi dengan string kosong biar gak error
                            if(empty($role_cek)) {
                                echo "-"; 
                            } else {
                                // Jika role 'dm', tulis 'DECISION MAKER', selain itu uppercase biasa
                                echo ($role_cek == 'dm') ? 'DECISION MAKER' : strtoupper($role_cek);
                            }
                        ?>
                    </div>
                </div>
                
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center link-dark text-decoration-none" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle fa-2x text-secondary"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end text-small shadow" aria-labelledby="dropdownUser2">
                        <li><a class="dropdown-item" href="<?= base_url('auth/logout') ?>" onclick="return confirm('Keluar sistem?')">Sign out</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </nav>

    <div class="container-fluid px-4 py-4">