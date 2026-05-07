<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h6 class="m-0 fw-bold"><i class="fas fa-trophy"></i> HASIL AGREGASI (BORDA COUNT)</h6>
                <a href="<?= base_url('laporan/cetak') ?>" target="_blank" class="btn btn-sm btn-light text-primary fw-bold border">
                    <i class="fas fa-print"></i> Cetak PDF
                </a>
            </div>
            <div class="card-body">
                <div class="alert alert-success border-0 shadow-sm">
                    <i class="fas fa-info-circle me-2"></i>
                    Lokasi dengan <strong>Poin Tertinggi</strong> adalah rekomendasi terbaik.
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th width="5%">Rank</th>
                                <th>Alternatif Lokasi</th>
                                <th>Total Poin</th>
                                <th>Detail Voting (Poin per DM)</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach($hasil_borda as $row): ?>
                            <tr class="<?= ($no == 1) ? 'table-warning' : '' ?>">
                                <td class="text-center fw-bold fs-5"><?= ($no == 1) ? '🥇' : $no ?></td>
                                <td class="fw-bold"><?= $row['nama_alternatif'] ?></td>
                                <td class="text-center fw-bold fs-5 text-primary"><?= $row['total_poin'] ?></td>
                                <td>
                                    <?php foreach($row['detail_rank'] as $dm_name => $det): ?>
                                        <small class="badge bg-secondary me-1 mb-1">
                                            <?= $dm_name ?>: <?= $det['poin'] ?> (R<?= $det['rank'] ?>)
                                        </small>
                                    <?php endforeach; ?>
                                </td>
                                <td class="text-center">
                                    <?php if($no == 1): ?>
                                        <span class="badge bg-success">TERBAIK</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php $no++; endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold text-dark"><i class="fas fa-calculator"></i> DETAIL PERHITUNGAN MOORA (Per User)</h6>
            </div>
            <div class="card-body">
                
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <?php $i=0; foreach($dms as $dm): $active = ($i==0) ? 'active' : ''; ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?= $active ?>" id="tab-<?= $dm['id_user'] ?>" data-bs-toggle="tab" data-bs-target="#content-<?= $dm['id_user'] ?>" type="button" role="tab">
                            <i class="fas fa-user-tie me-1"></i> <?= $dm['nama_lengkap'] ?>
                        </button>
                    </li>
                    <?php $i++; endforeach; ?>
                </ul>

                <div class="tab-content p-3 border border-top-0" id="myTabContent">
                    <?php $j=0; foreach($dms as $dm): $active = ($j==0) ? 'show active' : ''; ?>
                    <div class="tab-pane fade <?= $active ?>" id="content-<?= $dm['id_user'] ?>" role="tabpanel">
                        <table class="table table-sm table-striped table-hover mt-2">
                            <thead class="table-light">
                                <tr>
                                    <th width="10%" class="text-center">Ranking</th>
                                    <th>Alternatif</th>
                                    <th class="text-end">Nilai Yi (Optimasi)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $rank_moora = 1;
                                foreach($detail_moora[$dm['username']] as $dm_row): 
                                ?>
                                <tr>
                                    <td class="text-center fw-bold"><?= $rank_moora++ ?></td>
                                    <td><?= $dm_row['nama_alternatif'] ?></td>
                                    <td class="text-end font-monospace"><?= number_format($dm_row['nilai_yi'], 9) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php $j++; endforeach; ?>
                </div>

            </div>
        </div>
    </div>
</div>