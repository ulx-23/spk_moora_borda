<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h6 class="m-0 fw-bold"><i class="fas fa-edit"></i> <?= $title ?></h6>
            </div>
            <div class="card-body">
                
                <form action="<?= $action ?>" method="post">
                    
                    <?php if($row): ?>
                        <input type="hidden" name="id_kriteria" value="<?= $row->id_kriteria ?>">
                    <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label">Kode Kriteria</label>
                        <input type="text" name="kode_kriteria" class="form-control" placeholder="Contoh: C1" 
                               value="<?= $row ? $row->kode_kriteria : '' ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Kriteria</label>
                        <input type="text" name="nama_kriteria" class="form-control" placeholder="Contoh: Jarak Lokasi" 
                               value="<?= $row ? $row->nama_kriteria : '' ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bobot (Desimal)</label>
                        <input type="number" step="0.01" name="bobot" class="form-control" placeholder="Contoh: 0.35" 
                               value="<?= $row ? $row->bobot : '' ?>" required>
                        <small class="text-muted">Gunakan titik (.) untuk desimal. Contoh: 0.15</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tipe Atribut</label>
                        <select name="type" class="form-select" required>
                            <option value="Benefit" <?= ($row && $row->type == 'Benefit') ? 'selected' : '' ?>>Benefit (Makin Besar Makin Baik)</option>
                            <option value="Cost" <?= ($row && $row->type == 'Cost') ? 'selected' : '' ?>>Cost (Makin Kecil Makin Baik)</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="<?= base_url('kriteria') ?>" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Data</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>