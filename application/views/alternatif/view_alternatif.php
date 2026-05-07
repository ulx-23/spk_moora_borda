<div class="row">
    <div class="col-md-12">
        
        <?= $this->session->flashdata('pesan'); ?>

        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 fw-bold text-primary"><i class="fas fa-map-marker-alt"></i> Data Alternatif Lokasi</h6>
                <a href="<?= base_url('alternatif/tambah') ?>" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Tambah Lokasi
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Kode</th>
                                <th>Nama Alternatif / Lokasi</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach($alternatif as $row): ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center fw-bold text-success"><?= $row['kode_alternatif'] ?></td>
                                <td><?= $row['nama_alternatif'] ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('alternatif/edit/'.$row['id_alternatif']) ?>" class="btn btn-sm btn-warning text-white">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('alternatif/hapus/'.$row['id_alternatif']) ?>" onclick="return confirm('Yakin hapus lokasi ini? Nilai terkait juga akan terhapus.')" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
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