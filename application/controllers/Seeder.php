<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seeder extends CI_Controller
{
    private const TAHUN = [
        ['tahun' => 2024, 'tanggal' => '2024-08-15', 'faktor' => 0.82],
        ['tahun' => 2025, 'tanggal' => '2025-08-14', 'faktor' => 0.92],
        ['tahun' => 2026, 'tanggal' => '2026-08-13', 'faktor' => 1.00],
    ];

    private const INDIKATOR = [
        ['id' => 7, 'kode' => 'SDM', 'nama' => 'Sumber Daya Manusia', 'maks' => 52],
        ['id' => 8, 'kode' => 'KL', 'nama' => 'Potensi Kelembagaan', 'maks' => 28],
        ['id' => 9, 'kode' => 'PSR', 'nama' => 'Sarana dan Prasarana', 'maks' => 62],
        ['id' => 10, 'kode' => 'SDA', 'nama' => 'Sumber Daya Alam', 'maks' => 80],
    ];

    private const KATEGORI = [
        8 => ['nama' => 'Persawahan', 'ikon' => 'fas fa-tractor'],
        9 => ['nama' => 'Perladangan', 'ikon' => 'fas fa-mountain'],
        10 => ['nama' => 'Peternakan', 'ikon' => 'fas fa-drumstick-bite'],
        11 => ['nama' => 'Perkebunan', 'ikon' => 'fas fa-leaf'],
        12 => ['nama' => 'Pertambangan', 'ikon' => 'fas fa-oil-can'],
        13 => ['nama' => 'Kerajinan', 'ikon' => 'fas fa-hammer'],
        14 => ['nama' => 'Industri Sedang/Besar', 'ikon' => 'fas fa-industry'],
        15 => ['nama' => 'Perikanan', 'ikon' => 'fas fa-fish'],
        16 => ['nama' => 'Jasa/Perdagangan', 'ikon' => 'fas fa-shopping-cart'],
    ];

    private const PADUKUHAN = [
        7 => 'Geblagan',
        8 => 'Gatak',
        9 => 'Ngebel',
        10 => 'Ngrame',
        11 => 'Jetis',
        12 => 'Jadan',
        13 => 'Brajan',
        14 => 'Gonjen',
        15 => 'Kasihan',
        16 => 'Kembaran',
    ];

    private const DRIFT = [
        7 => 1.00,
        8 => 0.92,
        9 => 1.04,
        10 => 0.96,
        11 => 0.98,
        12 => 1.02,
        13 => 1.05,
        14 => 1.00,
        15 => 0.94,
        16 => 0.97,
    ];

    private const PROFIL = [
        7 => [
            ['kategori' => 8, 'bobot' => [0.55, 0.40, 0.52, 0.62]],
            ['kategori' => 15, 'bobot' => [0.25, 0.30, 0.28, 0.24]],
            ['kategori' => 16, 'bobot' => [0.16, 0.22, 0.16, 0.10]],
        ],
        8 => [
            ['kategori' => 9, 'bobot' => [0.18, 0.15, 0.18, 0.22]],
            ['kategori' => 10, 'bobot' => [0.12, 0.12, 0.10, 0.14]],
            ['kategori' => 16, 'bobot' => [0.08, 0.08, 0.08, 0.06]],
        ],
        9 => [
            ['kategori' => 11, 'bobot' => [0.60, 0.42, 0.55, 0.65]],
            ['kategori' => 12, 'bobot' => [0.20, 0.28, 0.25, 0.22]],
            ['kategori' => 16, 'bobot' => [0.14, 0.18, 0.16, 0.10]],
        ],
        10 => [
            ['kategori' => 10, 'bobot' => [0.40, 0.30, 0.36, 0.42]],
            ['kategori' => 8, 'bobot' => [0.24, 0.24, 0.26, 0.24]],
            ['kategori' => 16, 'bobot' => [0.14, 0.16, 0.14, 0.12]],
        ],
        11 => [
            ['kategori' => 13, 'bobot' => [0.36, 0.30, 0.32, 0.36]],
            ['kategori' => 16, 'bobot' => [0.22, 0.22, 0.24, 0.22]],
            ['kategori' => 9, 'bobot' => [0.12, 0.13, 0.14, 0.12]],
        ],
        12 => [
            ['kategori' => 15, 'bobot' => [0.62, 0.45, 0.58, 0.66]],
            ['kategori' => 16, 'bobot' => [0.22, 0.28, 0.24, 0.18]],
            ['kategori' => 10, 'bobot' => [0.12, 0.16, 0.14, 0.12]],
        ],
        13 => [
            ['kategori' => 13, 'bobot' => [0.58, 0.44, 0.52, 0.58]],
            ['kategori' => 16, 'bobot' => [0.24, 0.30, 0.26, 0.22]],
            ['kategori' => 11, 'bobot' => [0.14, 0.16, 0.18, 0.16]],
        ],
        14 => [
            ['kategori' => 11, 'bobot' => [0.50, 0.38, 0.46, 0.54]],
            ['kategori' => 8, 'bobot' => [0.28, 0.30, 0.30, 0.28]],
            ['kategori' => 16, 'bobot' => [0.14, 0.18, 0.16, 0.12]],
        ],
        15 => [
            ['kategori' => 16, 'bobot' => [0.30, 0.28, 0.30, 0.30]],
            ['kategori' => 13, 'bobot' => [0.18, 0.16, 0.18, 0.16]],
            ['kategori' => 10, 'bobot' => [0.08, 0.08, 0.08, 0.08]],
        ],
        16 => [
            ['kategori' => 14, 'bobot' => [0.28, 0.26, 0.30, 0.30]],
            ['kategori' => 16, 'bobot' => [0.16, 0.16, 0.16, 0.16]],
            ['kategori' => 9, 'bobot' => [0.08, 0.08, 0.08, 0.08]],
        ],
    ];

    public function __construct()
    {
        parent::__construct();

        if (!is_cli()) {
            show_404();
        }
    }

    public function generate()
    {
        $this->db->trans_start();

        $this->resetData();
        $this->ensureMaster();

        $pertanyaan = $this->buildPertanyaan();
        $survey = $this->buildSurvey($pertanyaan);
        $this->db->insert_batch('pertanyaan', $this->dbRows($pertanyaan));
        $this->db->insert_batch('survey', $survey);

        $skor = $this->buildSkor($pertanyaan);
        $hasil = $this->buildHasil($skor);
        $this->db->insert_batch('hasil_perhitungan', $hasil);

        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            echo "Seeder gagal.\n";

            return;
        }

        printf(
            "Seeder selesai: %d tahun, %d pertanyaan, %d survey, %d hasil.\n",
            count(self::TAHUN),
            count($pertanyaan),
            count($survey),
            count($hasil)
        );
    }

    private function resetData(): void
    {
        $this->db->query('DELETE FROM `survey`');
        $this->db->query('DELETE FROM `pertanyaan`');
        $this->db->query('DELETE FROM `hasil_perhitungan`');
    }

    private function ensureMaster(): void
    {
        foreach (self::INDIKATOR as $item) {
            $this->ensureRow('indikator', 'id_indikator', $item['id'], [
                'id_indikator' => $item['id'],
                'nama_indikator' => $item['nama'],
                'kode_indikator' => $item['kode'],
                'skor_maksimal' => $item['maks'],
            ]);
        }

        foreach (self::KATEGORI as $id => $item) {
            $this->ensureRow('kategori', 'id_kategori', $id, [
                'id_kategori' => $id,
                'nama_kategori' => $item['nama'],
                'ikon' => $item['ikon'],
            ]);
        }

        foreach (self::PADUKUHAN as $id => $nama) {
            $this->ensureRow('padukuhan', 'id_padukuhan', $id, [
                'id_padukuhan' => $id,
                'nama_padukuhan' => $nama,
            ]);
        }
    }

    private function ensureRow(string $table, string $key, int $id, array $data): void
    {
        if ($this->db->get_where($table, [$key => $id])->num_rows() === 0) {
            $this->db->insert($table, $data);
        }
    }

    private function buildPertanyaan(): array
    {
        $rows = [];

        foreach (self::TAHUN as $tahun) {
            $padukuhanIndex = 0;
            foreach (self::PADUKUHAN as $idPadukuhan => $namaPadukuhan) {
                $surveyor = 1 + (($tahun['tahun'] + $padukuhanIndex) % 3);
                foreach (self::PROFIL[$idPadukuhan] as $profil) {
                    foreach (self::INDIKATOR as $posisi => $indikator) {
                        $rows[] = [
                            'id_pertanyaan' => count($rows) + 1,
                            'tahun' => (string) $tahun['tahun'],
                            'tanggal_survey' => $tahun['tanggal'],
                            'id_surveyor' => $surveyor,
                            'pertanyaan' => 'Skor ' . $indikator['nama'] . ' pada sektor ' . self::KATEGORI[$profil['kategori']]['nama'],
                            'id_kategori' => $profil['kategori'],
                            'id_indikator' => $indikator['id'],
                            'id_padukuhan' => $idPadukuhan,
                            'kode_indikator' => $indikator['kode'],
                            'skor' => $this->nilaiSkor($indikator['maks'], $profil['bobot'][$posisi], $tahun['faktor'], self::DRIFT[$idPadukuhan]),
                        ];
                    }
                }
                $padukuhanIndex++;
            }
        }

        return $rows;
    }

    private function nilaiSkor(int $maksimal, float $bobot, float $faktor, float $drift): int
    {
        $nilai = (int) round($maksimal * $bobot * $faktor * $drift);

        return max(1, min($maksimal, $nilai));
    }

    private function dbRows(array $pertanyaan): array
    {
        $kolom = ['id_pertanyaan', 'tanggal_survey', 'id_surveyor', 'pertanyaan', 'id_kategori', 'id_indikator', 'id_padukuhan', 'skor'];
        $rows = [];

        foreach ($pertanyaan as $item) {
            $rows[] = array_intersect_key($item, array_flip($kolom));
        }

        return $rows;
    }

    private function buildSurvey(array $pertanyaan): array
    {
        $rows = [];

        foreach ($pertanyaan as $item) {
            $rows[] = [
                'id_user' => $item['id_surveyor'],
                'id_pertanyaan' => $item['id_pertanyaan'],
                'tanggal_survey' => $item['tanggal_survey'],
            ];
        }

        return $rows;
    }

    private function buildSkor(array $pertanyaan): array
    {
        $skor = [];

        foreach ($pertanyaan as $item) {
            $tahun = $item['tahun'];
            $id = $item['id_padukuhan'];
            $kode = $item['kode_indikator'];
            $skor[$tahun][$id][$kode] = ($skor[$tahun][$id][$kode] ?? 0) + $item['skor'];
        }

        return $skor;
    }

    private function buildHasil(array $skor): array
    {
        $rows = [];

        foreach (self::TAHUN as $tahun) {
            $tahunLabel = (string) $tahun['tahun'];
            foreach (self::PADUKUHAN as $idPadukuhan => $namaPadukuhan) {
                $rows[] = $this->hasilRow($tahunLabel, $tahun['tanggal'], $idPadukuhan, $skor[$tahunLabel][$idPadukuhan] ?? []);
            }
        }

        return $rows;
    }

    private function hasilRow(string $tahun, string $tanggal, int $idPadukuhan, array $mentah): array
    {
        $normal = $this->fuzzy_model->normalisasi($mentah);
        $inferensi = $this->fuzzy_model->inferensi($this->fuzzy_model->fuzzifikasi($normal));
        $skor = $this->fuzzy_model->defuzzifikasi($inferensi['kekuatan']);

        return [
            'id_padukuhan' => $idPadukuhan,
            'tahun' => $tahun,
            'skor_sda' => (int) ($mentah['SDA'] ?? 0),
            'skor_sdm' => (int) ($mentah['SDM'] ?? 0),
            'skor_kl' => (int) ($mentah['KL'] ?? 0),
            'skor_psr' => (int) ($mentah['PSR'] ?? 0),
            'skor_fuzzy' => $skor,
            'hasil_keputusan' => $this->fuzzy_model->klasifikasi($skor),
            'detail_rule' => json_encode($inferensi['aktif']),
            'date_create' => $tanggal,
        ];
    }
}
