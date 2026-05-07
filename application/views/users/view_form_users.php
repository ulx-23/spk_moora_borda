<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h6 class="m-0 fw-bold"><i class="fas fa-user-plus"></i> <?= $title ?></h6>
            </div>
            <div class="card-body">
                
                <form action="<?= $action ?>" method="post">
                    
                    <?php if($row): ?>
                        <input type="hidden" name="id_user" value="<?= $row->id_user ?>">
                    <?php endif; ?>

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" placeholder="Contoh: Budi Santoso" 
                               value="<?= $row ? $row->nama_lengkap : '' ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control" placeholder="Contoh: Staff IT / Kepala Dinas" 
                               value="<?= $row ? $row->jabatan : '' ?>" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Username (untuk Login)</label>
                            <input type="text" name="username" class="form-control" 
                                   value="<?= $row ? $row->username : '' ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Role (Hak Akses)</label>
                            <select name="role" class="form-select" required>
                                <option value="dm" <?= ($row && $row->role == 'dm') ? 'selected' : '' ?>>Decision Maker (Penilai)</option>
                                <option value="admin" <?= ($row && $row->role == 'admin') ? 'selected' : '' ?>>Administrator</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" 
                               placeholder="<?= $row ? 'Biarkan kosong jika tidak ingin mengubah password' : 'Masukkan Password Baru' ?>" 
                               <?= $row ? '' : 'required' ?>>
                        <?php if($row): ?>
                            <small class="text-muted">* Isi hanya jika ingin mengganti password lama.</small>
                        <?php endif; ?>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="<?= base_url('users') ?>" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan User</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>