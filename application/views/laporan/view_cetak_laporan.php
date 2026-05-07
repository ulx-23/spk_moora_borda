<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Hasil SPK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: "Times New Roman", Times, serif; color: #000; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h3, .header h4 { margin: 0; font-weight: bold; text-transform: uppercase; }
        .table thead th { background-color: #f0f0f0 !important; color: #000 !important; border-bottom: 2px solid #000; }
        
        /* Tanda Tangan Area */
        .signature-section { margin-top: 50px; display: flex; justify-content: flex-end; }
        .signature-box { text-align: center; width: 250px; }
        .signature-box .jabatan { margin-bottom: 80px; font-weight: bold; }
        .signature-box .nama { font-weight: bold; text-decoration: underline; }

        /* Sembunyikan tombol cetak saat diprint */
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="container mt-4">
        
        <div class="no-print mb-3">
            <a href="<?= base_url('laporan') ?>" class="btn btn-secondary btn-sm">
                &laquo; Kembali ke Dashboard
            </a>
            <button onclick="window.print()" class="btn btn-primary btn-sm">
                <i class="fas fa-print"></i> Print Lagi
            </button>
        </div>

        <div class="header">
            <h3>PEMERINTAH KABUPATEN/KOTA [NAMA KOTA]</h3>
            <h4>DINAS KESEHATAN / POSYANDU TERPADU</h4>
            <p class="m-0 small">Jl. Raya Contoh No. 123, Telp: (021) 12345678</p>
        </div>

        <div class="text-center mb-4">
            <h5 class="fw-bold text-decoration-underline">LAPORAN HASIL KEPUTUSAN (GDSS)</h5>
            <p>Perihal: Pemilihan Lokasi Posyandu Terbaik (Metode MOORA & Borda)</p>
        </div>

        <table class="table table-bordered table-sm align-middle border-dark">
            <thead class="text-center">
                <tr>
                    <th width="5%">Rank</th>
                    <th>Alternatif Lokasi</th>
                    <th>Total Poin Borda</th>
                    <th>Rincian Poin Juri</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach($hasil_borda as $row): ?>
                <tr class="<?= ($no == 1) ? 'fw-bold' : '' ?>">
                    <td class="text-center"><?= $no ?></td>
                    <td><?= $row['nama_alternatif'] ?></td>
                    <td class="text-center"><?= $row['total_poin'] ?></td>
                    <td class="small">
                        <?php 
                        $details = [];
                        foreach($row['detail_rank'] as $dm_name => $det) {
                            $details[] = "$dm_name: " . $det['poin'];
                        }
                        echo implode(" | ", $details);
                        ?>
                    </td>
                    <td class="text-center">
                        <?php if($no == 1): ?>
                            REKOMENDASI UTAMA
                        <?php elseif($no <= 3): ?>
                            Alternatif
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
                <?php $no++; endforeach; ?>
            </tbody>
        </table>

        <div class="signature-section">
            <div class="signature-box">
                <p class="mb-1">Kota [Nama Kota], <?= date('d F Y') ?></p>
                <div class="jabatan">Kepala Dinas / Pimpinan</div>
                
                <div class="nama">( ............................................ )</div>
                <div class="nip">NIP. ...........................</div>
            </div>
        </div>

    </div>

</body>
</html>