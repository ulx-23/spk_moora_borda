<div class="row">
    <div class="col-md-12">
        
        <?= $this->session->flashdata('pesan'); ?>

        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 fw-bold text-primary"><i class="fas fa-users-cog"></i> Manajemen Pengguna</h6>
                <a href="<?= base_url('users/tambah') ?>" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Tambah User
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Jabatan</th>
                                <th>Role</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach($users as $row): ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="fw-bold"><?= $row['nama_lengkap'] ?></td>
                                <td><?= $row['username'] ?></td>
                                <td><?= $row['jabatan'] ?></td>
                                <td class="text-center">
                                    <?php if($row['role'] == 'admin'): ?>
                                        <span class="badge bg-dark">Administrator</span>
                                    <?php else: ?>
                                        <span class="badge bg-info text-dark">Decision Maker</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('users/edit/'.$row['id_user']) ?>" class="btn btn-sm btn-warning text-white">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <?php if($row['username'] !== 'admin'): ?>
                                    <a href="<?= base_url('users/hapus/'.$row['id_user']) ?>" onclick="return confirm('Yakin hapus user ini? Semua penilaian yang dia buat juga akan hilang.')" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>