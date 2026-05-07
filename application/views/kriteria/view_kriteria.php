<div class="row">
    <div class="col-md-12">
        
        <?= $this->session->flashdata('pesan'); ?>

        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 fw-bold text-primary"><i class="fas fa-list"></i> Data Kriteria & Bobot</h6>
                <a href="<?= base_url('kriteria/tambah') ?>" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Tambah Baru
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th>Kode</th>
                                <th>Nama Kriteria</th>
                                <th>Bobot</th>
                                <th>Type</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1; 
                            $total_bobot = 0;
                            foreach($kriteria as $row): 
                                $total_bobot += $row['bobot'];
                            ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center fw-bold text-danger"><?= $row['kode_kriteria'] ?></td>
                                <td><?= $row['nama_kriteria'] ?></td>
                                <td class="text-center"><?= $row['bobot'] ?></td>
                                <td class="text-center">
                                    <?php if(strtolower($row['type']) == 'benefit'): ?>
                                        <span class="badge bg-success">Benefit</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Cost</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('kriteria/edit/'.$row['id_kriteria']) ?>" class="btn btn-sm btn-warning text-white">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('kriteria/hapus/'.$row['id_kriteria']) ?>" onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="3" class="text-end fw-bold">TOTAL BOBOT:</td>
                                <td class="text-center fw-bold 
                                    <?= ($total_bobot != 1) ? 'text-danger' : 'text-success' ?>">
                                    <?= $total_bobot ?>
                                    <?php if($total_bobot != 1): ?>
                                        <br><small>(Idealnya = 1.0)</small>
                                    <?php endif; ?>
                                </td>
                                <td colspan="2"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>