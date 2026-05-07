<div class="row mb-4">
    <div class="col-md-12">
        <h2 class="fw-bold text-dark">Selamat Datang, <?= $this->session->userdata('nama_lengkap') ?>!</h2>
        <p class="text-muted">Sistem Pendukung Keputusan GDSS Metode MOORA & Borda Count.</p>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card text-white bg-primary shadow-sm h-100 border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title text-white-50 small text-uppercase fw-bold">Data Kriteria</h5>
                        <h2 class="fw-bold display-5"><?= $count_kriteria ?></h2>
                    </div>
                    <i class="fas fa-list fa-4x opacity-25"></i>
                </div>
            </div>
            <div class="card-footer bg-primary border-top border-white border-opacity-25">
                <a href="<?= base_url('kriteria') ?>" class="text-white text-decoration-none small fw-bold">
                    Lihat Detail <i class="fas fa-arrow-circle-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card text-white bg-success shadow-sm h-100 border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title text-white-50 small text-uppercase fw-bold">Alternatif Lokasi</h5>
                        <h2 class="fw-bold display-5"><?= $count_alternatif ?></h2>
                    </div>
                    <i class="fas fa-map-marker-alt fa-4x opacity-25"></i>
                </div>
            </div>
            <div class="card-footer bg-success border-top border-white border-opacity-25">
                <a href="<?= base_url('alternatif') ?>" class="text-white text-decoration-none small fw-bold">
                    Lihat Detail <i class="fas fa-arrow-circle-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card text-white bg-warning shadow-sm h-100 border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title text-white-50 small text-uppercase fw-bold">Decision Maker</h5>
                        <h2 class="fw-bold display-5"><?= $count_users ?></h2>
                    </div>
                    <i class="fas fa-users fa-4x opacity-25"></i>
                </div>
            </div>
            <div class="card-footer bg-warning border-top border-white border-opacity-25">
                <a href="<?= base_url('users') ?>" class="text-white text-decoration-none small fw-bold">
                    Lihat Detail <i class="fas fa-arrow-circle-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-8 mb-4">
        <div class="card shadow border-0">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold text-primary"><i class="fas fa-chart-bar me-1"></i> Grafik Peringkat (Borda Count)</h6>
            </div>
            <div class="card-body">
                <canvas id="myChart" height="150"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-info text-white py-3">
                <h6 class="m-0 fw-bold"><i class="fas fa-info-circle me-1"></i> Panduan Singkat</h6>
            </div>
            <div class="card-body bg-light">
                <ol class="ps-3 mb-0">
                    <li class="mb-2">Kelola data <strong>Kriteria</strong> & Bobot.</li>
                    <li class="mb-2">Masukkan data <strong>Alternatif</strong> (Lokasi).</li>
                    <li class="mb-2">Masuk ke <strong>Input Penilaian</strong> (User DM).</li>
                    <li class="mb-2">Lihat <strong>Laporan Akhir</strong> untuk detail.</li>
                </ol>
                <hr>
                <div class="alert alert-warning small mb-0">
                    <i class="fas fa-lightbulb"></i> Grafik di samping menunjukkan akumulasi poin dari semua juri. Semakin tinggi batang grafik, semakin direkomendasikan lokasinya.
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Ambil Data dari Controller (PHP ke JS)
    const labels = <?= $chart_labels ?>;
    const dataValues = <?= $chart_data ?>;

    const ctx = document.getElementById('myChart').getContext('2d');
    
    // Buat Gradient Warna agar Grafik Terlihat Mewah
    let gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(78, 115, 223, 1)');   // Warna Atas (Biru Gelap)
    gradient.addColorStop(1, 'rgba(78, 115, 223, 0.1)'); // Warna Bawah (Transparan)

    const myChart = new Chart(ctx, {
        type: 'bar', // Tipe Grafik: Batang
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Poin Borda',
                data: dataValues,
                backgroundColor: gradient,
                borderColor: '#4e73df',
                borderWidth: 1,
                borderRadius: 5, // Sudut batang melengkung
                barPercentage: 0.6,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { borderDash: [2, 2] } // Garis putus-putus
                },
                x: {
                    grid: { display: false } // Hilangkan grid vertikal biar bersih
                }
            },
            plugins: {
                legend: { display: false } // Sembunyikan legenda biar minimalis
            }
        }
    });
</script>