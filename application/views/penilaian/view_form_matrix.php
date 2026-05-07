<div class="row">
    <div class="col-md-12">
        
        <a href="<?= base_url('penilaian') ?>" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
        
        <?= $this->session->flashdata('pesan'); ?>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h6 class="m-0 fw-bold"><i class="fas fa-table"></i> Form Penilaian: <?= $user->nama_lengkap ?></h6>
            </div>
            <div class="card-body">
                
                <form action="<?= base_url('penilaian/simpan') ?>" method="post">
                    <input type="hidden" name="id_user" value="<?= $user->id_user ?>">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th class="align-middle" rowspan="2" width="5%">No</th>
                                    <th class="align-middle text-start" rowspan="2">Alternatif (Lokasi)</th>
                                    <th colspan="<?= count($kriteria) ?>">Kriteria</th>
                                </tr>
                                <tr>
                                    <?php foreach($kriteria as $k): ?>
                                    <th>
                                        <small class="d-block text-warning"><?= $k['kode_kriteria'] ?></small>
                                        <?= $k['nama_kriteria'] ?>
                                    </th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; foreach($alternatif as $a): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td class="text-start fw-bold"><?= $a['nama_alternatif'] ?></td>
                                    
                                    <?php foreach($kriteria as $k): 
                                        // Cek apakah ada nilai lama
                                        $val = isset($nilai_lama[$a['id_alternatif']][$k['id_kriteria']]) 
                                                ? $nilai_lama[$a['id_alternatif']][$k['id_kriteria']] 
                                                : 0;
                                    ?>
                                    <td>
                                        <input type="number" step="0.01" class="form-control text-center" 
                                               name="nilai[<?= $a['id_alternatif'] ?>][<?= $k['id_kriteria'] ?>]"
                                               value="<?= $val ?>" required>
                                    </td>
                                    <?php endforeach; ?>

                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-save me-2"></i> SIMPAN PERUBAHAN
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>