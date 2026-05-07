<div class="row">
    <div class="col-md-12 mb-4">
        <h4><i class="fas fa-edit"></i> Input Penilaian</h4>
        <p class="text-muted">Pilih Decision Maker (DM) yang akan melakukan penilaian.</p>
    </div>

    <?php foreach($dms as $dm): ?>
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body text-center">
                <div class="mb-3 text-primary">
                    <i class="fas fa-user-circle fa-4x"></i>
                </div>
                <h5 class="card-title fw-bold"><?= $dm['nama_lengkap'] ?></h5>
                <p class="card-text text-muted"><?= $dm['jabatan'] ?></p>
                
                <a href="<?= base_url('penilaian/input/'.$dm['id_user']) ?>" class="btn btn-primary w-100">
                    <i class="fas fa-pen"></i> Input Nilai
                </a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>