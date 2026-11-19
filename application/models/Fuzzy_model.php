<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fuzzy_model extends CI_Model
{
    public const VARIABLES = [
        'SDA' => ['R' => [5, 35, 55], 'S' => [45, 55, 65], 'T' => [55, 75, 100]],
        'SDM' => ['R' => [8, 33, 55], 'S' => [45, 55, 75], 'T' => [55, 85, 100]],
        'KL'  => ['R' => [10, 30, 50], 'S' => [40, 60, 80], 'T' => [50, 80, 100]],
        'PSR' => ['R' => [10, 35, 55], 'S' => [40, 50, 65], 'T' => [55, 75, 100]],
    ];

    public const OUTPUT = [
        'R' => [0, 37, 74],
        'S' => [37, 111, 148],
        'T' => [111, 185, 222],
    ];

    public const RULE_MATRIX = [
        'RRRRRRRSS',
        'RRRRRRSSS',
        'RRRRRSSST',
        'RRRRSSSTT',
        'RRSSSSTTT',
        'RRSSSTTTT',
        'RSSSSTTTT',
        'SSSSTTTTT',
        'STTTTTTTT',
    ];

    public const LABELS = [
        'R' => 'Rendah',
        'S' => 'Sedang',
        'T' => 'Tinggi',
    ];

    private const OUTPUT_MAX = 222;
    private const OUTPUT_STEP = 0.1;
    private const LOW_THRESHOLD = 74;
    private const HIGH_THRESHOLD = 148;

    public function indikatorByCode(): array
    {
        $result = [];
        foreach ($this->db->get('indikator')->result_array() as $row) {
            $result[$row['kode_indikator']] = $row;
        }

        return $result;
    }

    public function skorPadukuhan(int $idPadukuhan): array
    {
        $rows = $this->db->select('i.kode_indikator, SUM(p.skor) AS skor, i.skor_maksimal')
            ->from('pertanyaan p')
            ->join('indikator i', 'i.id_indikator = p.id_indikator')
            ->where('p.id_padukuhan', $idPadukuhan)
            ->group_by('i.kode_indikator')
            ->get()
            ->result_array();

        $scores = [];
        foreach ($rows as $row) {
            $scores[$row['kode_indikator']] = (int) $row['skor'];
        }

        return $scores;
    }

    public function normalisasi(array $scores): array
    {
        $indikator = $this->indikatorByCode();
        $result = [];
        foreach (self::VARIABLES as $code => $params) {
            $maksimal = (float) ($indikator[$code]['skor_maksimal'] ?? 100);
            $result[$code] = $maksimal > 0 ? round(((float) ($scores[$code] ?? 0) / $maksimal) * 100, 2) : 0.0;
        }

        return $result;
    }

    public function derajatKeanggotaan(float $nilai, array $parameter, string $himpunan): float
    {
        [$a, $b, $c] = $parameter;

        if ($himpunan === 'R') {
            if ($nilai <= $b) {
                return 1.0;
            }
            if ($nilai >= $c) {
                return 0.0;
            }

            return ($c - $nilai) / ($c - $b);
        }

        if ($himpunan === 'T') {
            if ($nilai <= $a) {
                return 0.0;
            }
            if ($nilai >= $b) {
                return 1.0;
            }

            return ($nilai - $a) / ($b - $a);
        }

        if ($nilai <= $a || $nilai >= $c) {
            return 0.0;
        }

        return $nilai < $b ? ($nilai - $a) / ($b - $a) : ($c - $nilai) / ($c - $b);
    }

    public function fuzzifikasi(array $nilaiNormal): array
    {
        $hasil = [];
        foreach (self::VARIABLES as $code => $parameter) {
            $hasil[$code] = [];
            foreach (self::LABELS as $key => $label) {
                $hasil[$code][$key] = $this->derajatKeanggotaan((float) $nilaiNormal[$code], $parameter[$key], $key);
            }
        }

        return $hasil;
    }

    public function aturan(): array
    {
        $kode = ['R', 'S', 'T'];
        $aturan = [];
        $nomor = 1;
        foreach (self::RULE_MATRIX as $baris => $kolomKeluaran) {
            foreach ($kode as $indeksSda => $sda) {
                foreach ($kode as $indeksPsr => $psr) {
                    foreach ($kode as $indeksSdm => $sdm) {
                        $aturan[] = [
                            'nomor' => $nomor++,
                            'KL' => $kode[(int) floor($baris / 3)],
                            'SDA' => $sda,
                            'PSR' => $psr,
                            'SDM' => $sdm,
                            'TD' => $kolomKeluaran[$indeksPsr * 3 + $indeksSdm],
                        ];
                    }
                }
            }
        }

        return $aturan;
    }

    public function inferensi(array $fuzzifikasi): array
    {
        $kekuatan = ['R' => 0.0, 'S' => 0.0, 'T' => 0.0];
        $aktif = [];

        foreach ($this->aturan() as $aturan) {
            $alpha = min(
                $fuzzifikasi['KL'][$aturan['KL']],
                $fuzzifikasi['SDA'][$aturan['SDA']],
                $fuzzifikasi['PSR'][$aturan['PSR']],
                $fuzzifikasi['SDM'][$aturan['SDM']]
            );

            if ($alpha <= 0) {
                continue;
            }

            $kekuatan[$aturan['TD']] = max($kekuatan[$aturan['TD']], $alpha);
            $aktif[] = [
                'nomor' => $aturan['nomor'],
                'label' => sprintf(
                    'Jika KL %s, SDA %s, PSR %s, dan SDM %s maka %s',
                    self::LABELS[$aturan['KL']],
                    self::LABELS[$aturan['SDA']],
                    self::LABELS[$aturan['PSR']],
                    self::LABELS[$aturan['SDM']],
                    self::LABELS[$aturan['TD']]
                ),
                'alpha' => round($alpha, 4),
                'hasil' => $aturan['TD'],
            ];
        }

        usort($aktif, static fn (array $a, array $b): int => $b['alpha'] <=> $a['alpha']);

        return ['kekuatan' => $kekuatan, 'aktif' => array_slice($aktif, 0, 8)];
    }

    public function defuzzifikasi(array $kekuatan): float
    {
        $pembilang = 0.0;
        $penyebut = 0.0;

        for ($x = 0; $x <= self::OUTPUT_MAX; $x += self::OUTPUT_STEP) {
            $keanggotaan = 0.0;
            foreach (self::OUTPUT as $key => $parameter) {
                $nilai = min(
                    $kekuatan[$key],
                    $this->derajatKeanggotaan((float) $x, $parameter, $key)
                );
                $keanggotaan = max($keanggotaan, $nilai);
            }
            $pembilang += $x * $keanggotaan;
            $penyebut += $keanggotaan;
        }

        return $penyebut > 0 ? round($pembilang / $penyebut, 2) : 0.0;
    }

    public function klasifikasi(float $skor): string
    {
        if ($skor < self::LOW_THRESHOLD) {
            return 'Rendah';
        }

        return $skor < self::HIGH_THRESHOLD ? 'Sedang' : 'Tinggi';
    }

    public function hitung(int $idPadukuhan, string $tahun): array
    {
        $potensi = $this->potensiPerPadukuhan($idPadukuhan, $tahun)[$idPadukuhan] ?? [];
        $mentah = $this->skorPadukuhan($idPadukuhan);
        $normal = $this->normalisasi($mentah);
        $fuzzifikasi = $this->fuzzifikasi($normal);
        $inferensi = $this->inferensi($fuzzifikasi);
        $skor = $this->defuzzifikasi($inferensi['kekuatan']);

        $padukuhan = $this->db->select('nama_padukuhan')->get_where('padukuhan', ['id_padukuhan' => $idPadukuhan])->row_array();

        return [
            'id_padukuhan' => $idPadukuhan,
            'nama_padukuhan' => $padukuhan['nama_padukuhan'] ?? 'Padukuhan',
            'tahun' => $tahun,
            'skor_sda' => $mentah['SDA'] ?? 0,
            'skor_sdm' => $mentah['SDM'] ?? 0,
            'skor_kl' => $mentah['KL'] ?? 0,
            'skor_psr' => $mentah['PSR'] ?? 0,
            'skor_normal' => $normal,
            'fuzzifikasi' => $fuzzifikasi,
            'kekuatan' => $inferensi['kekuatan'],
            'aturan_aktif' => $inferensi['aktif'],
            'skor_fuzzy' => $skor,
            'hasil_keputusan' => $this->klasifikasi($skor),
            'potensi_nama' => $potensi['nama_kategori'] ?? 'Belum ada data',
            'potensi_ikon' => $potensi['ikon'] ?? 'fas fa-question-circle',
            'potensi_skor' => (int) ($potensi['skor'] ?? 0),
            'potensi_porsi' => (float) ($potensi['porsi'] ?? 0),
            'potensi_alternatif' => $potensi['alternatif'] ?? '',
        ];
    }

    public function hitungSemua(string $tahun): int
    {
        $jumlah = 0;
        foreach ($this->db->select('id_padukuhan')->get('padukuhan')->result_array() as $padukuhan) {
            $hasil = $this->hitung((int) $padukuhan['id_padukuhan'], $tahun);
            $this->simpan($hasil);
            $jumlah++;
        }

        return $jumlah;
    }

    public function simpan(array $hasil): bool
    {
        $this->db->where('id_padukuhan', $hasil['id_padukuhan']);
        $this->db->where('tahun', $hasil['tahun']);
        $this->db->delete('hasil_perhitungan');

        return $this->db->insert('hasil_perhitungan', [
            'id_padukuhan' => $hasil['id_padukuhan'],
            'tahun' => $hasil['tahun'],
            'skor_sda' => $hasil['skor_sda'],
            'skor_sdm' => $hasil['skor_sdm'],
            'skor_kl' => $hasil['skor_kl'],
            'skor_psr' => $hasil['skor_psr'],
            'skor_fuzzy' => $hasil['skor_fuzzy'],
            'hasil_keputusan' => $hasil['hasil_keputusan'],
            'detail_rule' => json_encode($hasil['aturan_aktif']),
            'date_create' => date('Y-m-d'),
        ]);
    }

    public function hasil(?int $idPadukuhan = null, ?string $tahun = null): array
    {
        $this->db->select('h.*, p.nama_padukuhan')
            ->from('hasil_perhitungan h')
            ->join('padukuhan p', 'p.id_padukuhan = h.id_padukuhan')
            ->order_by('h.skor_fuzzy', 'DESC');

        if ($idPadukuhan !== null) {
            $this->db->where('h.id_padukuhan', $idPadukuhan);
        }
        if ($tahun !== null && $tahun !== '') {
            $this->db->where('h.tahun', $tahun);
        }

        $rows = $this->db->get()->result_array();
        $potensi = $this->potensiPerPadukuhan($idPadukuhan, $tahun);

        foreach ($rows as &$row) {
            $item = $potensi[(int) $row['id_padukuhan']] ?? [];
            $row['potensi_nama'] = $item['nama_kategori'] ?? 'Belum ada data';
            $row['potensi_ikon'] = $item['ikon'] ?? 'fas fa-question-circle';
            $row['potensi_skor'] = (int) ($item['skor'] ?? 0);
            $row['potensi_porsi'] = (float) ($item['porsi'] ?? 0);
            $row['potensi_alternatif'] = $item['alternatif'] ?? '';
        }

        return $rows;
    }

    private function potensiPerPadukuhan(?int $idPadukuhan, ?string $tahun): array
    {
        $this->db->select('p.id_padukuhan, k.nama_kategori, k.ikon, SUM(pt.skor) AS skor')
            ->from('pertanyaan pt')
            ->join('padukuhan p', 'p.id_padukuhan = pt.id_padukuhan')
            ->join('kategori k', 'k.id_kategori = pt.id_kategori')
            ->group_by('p.id_padukuhan, k.id_kategori, k.nama_kategori, k.ikon')
            ->order_by('p.id_padukuhan', 'ASC')
            ->order_by('skor', 'DESC');

        if ($idPadukuhan !== null) {
            $this->db->where('p.id_padukuhan', $idPadukuhan);
        }
        if ($tahun !== null && $tahun !== '') {
            $this->db->where('YEAR(pt.tanggal_survey)', (int) $tahun);
        }

        $pered = [];
        foreach ($this->db->get()->result_array() as $row) {
            $pered[(int) $row['id_padukuhan']][] = $row;
        }

        $result = [];
        foreach ($pered as $id => $items) {
            $total = array_sum(array_column($items, 'skor'));
            $utama = $items[0];
            $result[$id] = [
                'nama_kategori' => $utama['nama_kategori'],
                'ikon' => $utama['ikon'],
                'skor' => (int) $utama['skor'],
                'porsi' => $total > 0 ? round(((int) $utama['skor'] / $total) * 100) : 0,
                'alternatif' => $items[1]['nama_kategori'] ?? '',
            ];
        }

        return $result;
    }

    public function tahunTersedia(): array
    {
        return $this->db->select('tahun')->distinct()->order_by('tahun', 'DESC')->get('hasil_perhitungan')->result_array();
    }

    public function ringkasan(?string $tahun = null): array
    {
        $result = ['Rendah' => 0, 'Sedang' => 0, 'Tinggi' => 0];
        $this->db->select('hasil_keputusan, COUNT(*) AS jumlah')
            ->from('hasil_perhitungan')
            ->group_by('hasil_keputusan');
        if ($tahun !== null && $tahun !== '') {
            $this->db->where('tahun', $tahun);
        }

        foreach ($this->db->get()->result_array() as $row) {
            $result[$row['hasil_keputusan']] = (int) $row['jumlah'];
        }

        return $result;
    }
}
