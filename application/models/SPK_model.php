<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SPK_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    // 1. Ambil Data Kriteria
    public function get_kriteria()
    {
        return $this->db->get('tb_kriteria')->result_array();
    }

    // 2. Ambil Data Alternatif
    public function get_alternatif()
    {
        return $this->db->get('tb_alternatif')->result_array();
    }

    // 3. Ambil Daftar DM (User dengan role 'dm')
    public function get_dms()
    {
        $this->db->where('role', 'dm');
        return $this->db->get('tb_users')->result_array();
    }

    // ==========================================================
    // INTI PERHITUNGAN MOORA (Per Individu DM)
    // ==========================================================
    public function hitung_moora($id_user)
    {
        $kriteria = $this->get_kriteria();
        $alternatif = $this->get_alternatif();
        
        // A. Ambil Nilai Mentah (Matriks Keputusan)
        // Format: [id_alternatif][id_kriteria] = nilai
        $raw_data = [];
        $pembagi = []; // Untuk menyimpan akar kuadrat (denominator)

        // Inisialisasi pembagi dengan 0
        foreach ($kriteria as $k) {
            $pembagi[$k['id_kriteria']] = 0;
        }

        foreach ($alternatif as $a) {
            foreach ($kriteria as $k) {
                // Query ambil nilai dari tabel penilaian
                $this->db->where('id_user', $id_user);
                $this->db->where('id_alternatif', $a['id_alternatif']);
                $this->db->where('id_kriteria', $k['id_kriteria']);
                $q = $this->db->get('tb_penilaian')->row();
                
                $nilai = $q ? $q->nilai : 0; // Jika kosong dianggap 0
                $raw_data[$a['id_alternatif']][$k['id_kriteria']] = $nilai;

                // Hitung kuadrat untuk pembagi (Langkah 1 MOORA)
                $pembagi[$k['id_kriteria']] += pow($nilai, 2);
            }
        }

        // Akar kuadratkan pembagi
        foreach ($pembagi as $id_k => $val) {
            $pembagi[$id_k] = sqrt($val);
        }

        // B. Normalisasi & Optimasi (Langkah 2 & 3 MOORA)
        $nilai_yi = []; // Menyimpan nilai akhir Yi setiap alternatif

        foreach ($alternatif as $a) {
            $total_benefit = 0;
            $total_cost = 0;

            foreach ($kriteria as $k) {
                $nilai_mentah = $raw_data[$a['id_alternatif']][$k['id_kriteria']];
                $denominator = $pembagi[$k['id_kriteria']];
                
                // Cegah pembagian dengan nol
                $ternormalisasi = ($denominator != 0) ? $nilai_mentah / $denominator : 0;

                // Kalikan dengan Bobot
                $teroptimasi = $ternormalisasi * $k['bobot'];

                // Pisahkan Benefit dan Cost
                if (strtolower($k['type']) == 'benefit') {
                    $total_benefit += $teroptimasi;
                } else {
                    $total_cost += $teroptimasi;
                }
            }

            // Hitung Yi (Benefit - Cost)
            $yi = $total_benefit - $total_cost;
            
            $nilai_yi[] = [
                'id_alternatif' => $a['id_alternatif'],
                'nama_alternatif' => $a['nama_alternatif'],
                'nilai_yi' => $yi
            ];
        }

        // C. Ranking (Urutkan dari Yi terbesar ke terkecil)
        usort($nilai_yi, function($a, $b) {
            return $b['nilai_yi'] <=> $a['nilai_yi']; // Descending
        });

        return $nilai_yi;
    }

    // ==========================================================
    // INTI PERHITUNGAN AGREGASI BORDA (Gabungan Semua DM)
    // ==========================================================
    public function hitung_borda()
    {
        $dms = $this->get_dms();
        $alternatif = $this->get_alternatif();
        $total_alternatif = count($alternatif);
        
        $poin_borda = []; 

        // Inisialisasi poin 0 untuk semua alternatif
        foreach ($alternatif as $a) {
            $poin_borda[$a['id_alternatif']] = [
                'id_alternatif' => $a['id_alternatif'],
                'nama_alternatif' => $a['nama_alternatif'],
                'total_poin' => 0,
                'detail_rank' => [] // Info tambahan rank per DM
            ];
        }

        // Loop setiap DM untuk ambil ranking mereka
        foreach ($dms as $dm) {
            // Panggil fungsi MOORA untuk DM ini
            $hasil_moora = $this->hitung_moora($dm['id_user']);
            
            // Berikan poin berdasarkan ranking
            // Rank 1 = Poin Max (jumlah alternatif), Rank Terakhir = 1
            $rank = 1;
            foreach ($hasil_moora as $row) {
                $poin = $total_alternatif - $rank + 1;
                
                // Tambahkan poin ke alternatif terkait
                $poin_borda[$row['id_alternatif']]['total_poin'] += $poin;
                
                // Simpan history ranking (untuk display laporan)
                $poin_borda[$row['id_alternatif']]['detail_rank'][$dm['username']] = [
                    'rank' => $rank,
                    'poin' => $poin,
                    'yi' => $row['nilai_yi']
                ];

                $rank++;
            }
        }

        // Urutkan berdasarkan Total Poin Terbesar (Final Ranking)
        usort($poin_borda, function($a, $b) {
            return $b['total_poin'] <=> $a['total_poin'];
        });

        return $poin_borda;
    }
    // ==========================================================
    // BAGIAN CRUD PENILAIAN
    // ==========================================================

    // Ambil nilai spesifik user dalam format array [id_alt][id_krit] => nilai
    public function get_penilaian_matrix($id_user)
    {
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('tb_penilaian')->result_array();
        
        $matrix = [];
        foreach($query as $row) {
            $matrix[$row['id_alternatif']][$row['id_kriteria']] = $row['nilai'];
        }
        return $matrix;
    }

    // Simpan data penilaian (Hapus data lama user tsb, lalu insert baru)
    public function simpan_penilaian($id_user, $data_nilai)
    {
        // 1. Bersihkan nilai lama milik user ini (agar tidak duplikat)
        $this->db->where('id_user', $id_user);
        $this->db->delete('tb_penilaian');

        // 2. Siapkan data baru untuk batch insert
        $batch_data = [];
        foreach ($data_nilai as $id_alternatif => $kriteria_nilai) {
            foreach ($kriteria_nilai as $id_kriteria => $nilai) {
                // Pastikan nilai tidak kosong/nol kalau tidak perlu
                $batch_data[] = [
                    'id_user' => $id_user,
                    'id_alternatif' => $id_alternatif,
                    'id_kriteria' => $id_kriteria,
                    'nilai' => $nilai
                ];
            }
        }

        // 3. Insert sekaligus
        if (!empty($batch_data)) {
            $this->db->insert_batch('tb_penilaian', $batch_data);
        }
    }
    // ==========================================================
    // FUNGSI CRUD GENERIK (BISA DIPAKAI SEMUA TABEL)
    // ==========================================================

    public function get_by_id($tabel, $id_column, $id)
    {
        return $this->db->get_where($tabel, [$id_column => $id])->row();
    }

    public function insert_data($tabel, $data)
    {
        return $this->db->insert($tabel, $data);
    }

    public function update_data($tabel, $data, $where)
    {
        return $this->db->update($tabel, $data, $where);
    }

    public function delete_data($tabel, $where)
    {
        return $this->db->delete($tabel, $where);
    }
}