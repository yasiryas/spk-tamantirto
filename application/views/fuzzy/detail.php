<?php
$detail = $detail ?? [];
$label = ['R' => 'Rendah', 'S' => 'Sedang', 'T' => 'Tinggi'];
$maksimal = ['SDA' => 80, 'SDM' => 52, 'KL' => 28, 'PSR' => 62];
?>

<div class="page-head">
  <div><p class="eyebrow">Detail perhitungan</p><h1><?= htmlspecialchars($detail['nama_padukuhan'] ?? 'Padukuhan', ENT_QUOTES, 'UTF-8'); ?></h1><p>Tahun <?= htmlspecialchars($tahun, ENT_QUOTES, 'UTF-8'); ?> &middot; seluruh tahapan inferensi fuzzy.</p></div>
  <a class="btn btn-outline" href="<?= base_url('fuzzy/hasil?tahun=' . rawurlencode($tahun)); ?>"><i class="fas fa-arrow-left mr-2"></i> Kembali</a>
</div>

<div class="grid-2">
  <div class="card">
    <div class="score-hero">
      <div>
        <div class="eyebrow">Potensi utama</div>
        <div class="potensi-detail">
          <i class="<?= htmlspecialchars(kategori_icon($detail['potensi_nama'] ?? '', $detail['potensi_ikon'] ?? null), ENT_QUOTES, 'UTF-8'); ?>"></i>
          <strong><?= htmlspecialchars($detail['potensi_nama'] ?? 'Belum ada data', ENT_QUOTES, 'UTF-8'); ?></strong>
        </div>
        <p class="potensi-alasan">Skor kategori <?= (int) ($detail['potensi_skor'] ?? 0); ?> &middot; <?= (float) ($detail['potensi_porsi'] ?? 0); ?>% dari total penilaian</p>
        <div class="mt-3">
          <div class="eyebrow">Skor akhir</div>
          <div class="score-number"><?= number_format((float) ($detail['skor_fuzzy'] ?? 0), 2, ',', '.'); ?><span class="score-unit">/ 222</span></div>
          <span class="badge <?= strtolower($detail['hasil_keputusan'] ?? ''); ?>"><?= htmlspecialchars($detail['hasil_keputusan'] ?? '', ENT_QUOTES, 'UTF-8'); ?></span>
        </div>
      </div>
      <div class="score-spectrum">
        <div class="spectrum-item <?= ($detail['hasil_keputusan'] ?? '') === 'Rendah' ? 'active' : ''; ?>">Rendah &lt; 74</div>
        <div class="spectrum-item <?= ($detail['hasil_keputusan'] ?? '') === 'Sedang' ? 'active' : ''; ?>">Sedang 74–148</div>
        <div class="spectrum-item <?= ($detail['hasil_keputusan'] ?? '') === 'Tinggi' ? 'active' : ''; ?>">Tinggi &gt; 148</div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-head"><h3>Skor anasir</h3></div>
    <?php foreach (['SDA', 'SDM', 'KL', 'PSR'] as $kode): ?>
      <div class="bar-row">
        <span><?= $kode; ?></span>
        <div class="bar-track"><div class="bar-fill" style="width:<?= min(100, round(((float) ($detail['skor_' . strtolower($kode)] ?? 0) / $maksimal[$kode]) * 100)); ?>%;"></div></div>
        <span><?= (int) ($detail['skor_' . strtolower($kode)] ?? 0); ?> / <?= $maksimal[$kode]; ?></span>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<div class="card">
  <div class="card-head"><h3>Derajat keanggotaan</h3><p>Setelah normalisasi ke skala 0–100</p></div>
  <?php foreach (['SDA', 'SDM', 'KL', 'PSR'] as $kode): ?>
    <div class="bar-row">
      <span><strong><?= $kode; ?></strong></span>
      <div class="membership-row">
        <?php foreach (['R', 'S', 'T'] as $himpunan): ?>
          <div class="membership-cell"><span><?= $label[$himpunan]; ?></span><strong><?= number_format((float) ($detail['fuzzifikasi'][$kode][$himpunan] ?? 0), 3, ',', '.'); ?></strong></div>
        <?php endforeach; ?>
      </div>
      <span><?= number_format((float) ($detail['skor_normal'][$kode] ?? 0), 1, ',', '.'); ?></span>
    </div>
  <?php endforeach; ?>
</div>

<div class="card">
  <div class="card-head"><h3>Aturan paling aktif</h3><p>Diurutkan dari nilai alpha tertinggi</p></div>
  <div class="rule-list">
    <?php foreach ($detail['aturan_aktif'] ?? [] as $aturan): ?>
      <div class="rule-item"><span><?= htmlspecialchars($aturan['label'], ENT_QUOTES, 'UTF-8'); ?></span><strong>&alpha; = <?= htmlspecialchars($aturan['alpha'], ENT_QUOTES, 'UTF-8'); ?></strong></div>
    <?php endforeach; ?>
  </div>
</div>
