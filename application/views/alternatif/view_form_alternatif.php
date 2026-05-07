<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h6 class="m-0 fw-bold"><i class="fas fa-edit"></i> <?= $title ?></h6>
            </div>
            <div class="card-body">
                
                <form action="<?= $action ?>" method="post">
                    
                    <?php if($row): ?>
                        <input type="hidden" name="id_alternatif" value="<?= $row->id_alternatif ?>">
                    <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label">Kode Alternatif</label>
                        <input type="text" name="kode_alternatif" class="form-control" placeholder="Contoh: A1" 
                               value="<?= $row ? $row->kode_alternatif : '' ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Lokasi</label>
                        <input type="text" name="nama_alternatif" class="form-control" placeholder="Contoh: Desa Suka Maju" 
                               value="<?= $row ? $row->nama_alternatif : '' ?>" required>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="<?= base_url('alternatif') ?>" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Data</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>