<header class="landing-nav">
  <a class="sidebar-brand" href="<?= base_url(); ?>" style="color:var(--ink);">
    <span class="brand-mark">T</span>
    <span>
      <span class="brand-name d-block">Tamantirto</span>
      <span class="brand-sub d-block">POTENSI DESA</span>
    </span>
  </a>
  <nav class="nav-links">
    <a href="#potensi">Potensi</a>
    <a href="#metode">Metode</a>
    <a href="#rekap">Rekap</a>
    <a href="<?= base_url('fuzzy/metode'); ?>">Detail Fuzzy</a>
    <a class="btn btn-gold btn-sm ml-3" href="<?= base_url('auth'); ?>">Masuk <i class="fas fa-arrow-right ml-1"></i></a>
  </nav>
</header>

<section class="landing-hero">
  <div>
    <p class="eyebrow">Inferensi Fuzzy Mamdani</p>
    <h1>Potensi desa, terbaca dari data.</h1>
    <p class="lead">Sistem ini memetakan kekuatan setiap padukuhan di Kalurahan Tamantirto dari sembilan sektor potensi dan empat anasir: SDA, SDM, kelembagaan, serta sarana dan prasarana.</p>
    <div class="mt-4">
      <a class="btn btn-gold" href="#rekap">Lihat rekap potensi</a>
      <a class="btn btn-outline ml-2" href="<?= base_url('fuzzy/metode'); ?>">Pelajari metodenya</a>
    </div>
    <div class="d-flex mt-5" style="gap:34px;">
      <div><div class="stat-value"><?= (int) ($jumlahPadukuhan ?? 0); ?></div><div class="stat-note">Padukuhan terpetakan</div></div>
      <div><div class="stat-value">81</div><div class="stat-note">Aturan fuzzy aktif</div></div>
      <div><div class="stat-value">4</div><div class="stat-note">Anasir penilaian</div></div>
      <div><div class="stat-value"><?= (int) ($jumlahKategori ?? 0); ?></div><div class="stat-note">Sektor potensi</div></div>
    </div>
  </div>

  <div class="card" style="margin:0;">
    <div class="card-head">
      <div><h3>Potensi tertinggi</h3><p>Hasil perhitungan terbaru</p></div>
      <span class="badge tinggi">Tinggi</span>
    </div>
    <?php if (!empty($hasil)): $teratas = $hasil[0]; ?>
      <div class="score-hero">
        <div>
          <div class="eyebrow"><?= htmlspecialchars($teratas['nama_padukuhan'], ENT_QUOTES, 'UTF-8'); ?></div>
          <div class="score-number"><?= number_format((float) $teratas['skor_fuzzy'], 2, ',', '.'); ?><span class="score-unit">/ 222</span></div>
          <p class="text-muted mb-0" style="font-size:12px;">Skor fuzzy hasil defuzzifikasi centroid</p>
        </div>
        <div>
          <?php foreach (['skor_sda' => 'SDA', 'skor_sdm' => 'SDM', 'skor_kl' => 'KL', 'skor_psr' => 'PSR'] as $kunci => $label): ?>
            <?php $maks = ['skor_sda' => 80, 'skor_sdm' => 52, 'skor_kl' => 28, 'skor_psr' => 62][$kunci]; ?>
            <div class="bar-row">
              <span><?= $label; ?></span>
              <div class="bar-track"><div class="bar-fill" style="width:<?= min(100, round(((float) $teratas[$kunci] / $maks) * 100)); ?>%;"></div></div>
              <span><?= (int) $teratas[$kunci]; ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php else: ?>
      <div class="empty"><i class="fas fa-chart-bar"></i>Belum ada hasil perhitungan.</div>
    <?php endif; ?>
  </div>
</section>

<section class="landing-section" id="potensi">
  <div class="landing-inner">
    <p class="eyebrow">Sektor potensi</p>
    <h2>Ruang lingkup potensi desa.</h2>
    <p class="lead">Persawahan, perladangan, peternakan, perkebunan, pertambangan, kerajinan, industri, perikanan, dan jasa perdagangan.</p>
    <?php $this->load->view('partials/kategori_grid', ['kategoriRingkasan' => $kategoriRingkasan ?? []]); ?>
  </div>
</section>

<section class="landing-section" id="metode">
  <div class="landing-inner">
    <p class="eyebrow">Alur sistem</p>
    <h2>Empat langkah, satu rekomendasi.</h2>
    <div class="grid-3 mt-4">
      <div class="feature"><i class="fas fa-table-list"></i><h3>Data survei</h3><p>Skor persuban dari 40 pertanyaan yang tersebar di empat indikator.</p></div>
      <div class="feature"><i class="fas fa-bezier-curve"></i><h3>Fuzzifikasi</h3><p>Nilai dinormalisasi lalu diubah ke derajat keanggotaan rendah, sedang, tinggi.</p></div>
      <div class="feature"><i class="fas fa-project-diagram"></i><h3>Inferensi</h3><p>81 aturan Mamdani dijalankan dengan operator minimum, digabung dengan maksimum.</p></div>
    </div>
  </div>
</section>

<section class="landing-section" id="rekap">
  <div class="landing-inner">
    <div class="d-flex justify-content-between align-items-end flex-wrap" style="gap:12px;">
      <div><p class="eyebrow">Rekap padukuhan</p><h2>Sebaran potensi</h2></div>
      <a class="btn btn-outline btn-sm" href="<?= base_url('auth'); ?>">Lihat dashboard lengkap</a>
    </div>
    <div class="stat-grid mt-4">
      <div class="stat"><div class="stat-label">Rendah</div><div class="stat-value" style="color:var(--rendah);"><?= (int) ($ringkasan['Rendah'] ?? 0); ?></div></div>
      <div class="stat"><div class="stat-label">Sedang</div><div class="stat-value" style="color:var(--sedang);"><?= (int) ($ringkasan['Sedang'] ?? 0); ?></div></div>
      <div class="stat"><div class="stat-label">Tinggi</div><div class="stat-value" style="color:var(--tinggi);"><?= (int) ($ringkasan['Tinggi'] ?? 0); ?></div></div>
      <div class="stat"><div class="stat-label">Total padukuhan</div><div class="stat-value"><?= array_sum($ringkasan ?? []); ?></div></div>
    </div>
    <div class="card flush">
      <table class="table mb-0">
        <thead><tr><th>Padukuhan</th><th>SDA</th><th>SDM</th><th>KL</th><th>PSR</th><th class="num">Skor</th><th>Keputusan</th></tr></thead>
        <tbody>
          <?php foreach (array_slice($hasil ?? [], 0, 5) as $row): ?>
            <tr>
              <td class="font-weight-bold"><?= htmlspecialchars($row['nama_padukuhan'], ENT_QUOTES, 'UTF-8'); ?></td>
              <td><?= (int) $row['skor_sda']; ?></td><td><?= (int) $row['skor_sdm']; ?></td>
              <td><?= (int) $row['skor_kl']; ?></td><td><?= (int) $row['skor_psr']; ?></td>
              <td class="num font-weight-bold"><?= number_format((float) $row['skor_fuzzy'], 2, ',', '.'); ?></td>
              <td><span class="badge <?= strtolower($row['hasil_keputusan']); ?>"><?= htmlspecialchars($row['hasil_keputusan'], ENT_QUOTES, 'UTF-8'); ?></span></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<footer class="footer">
  <div class="footer-inner"><span>Kalurahan Tamantirto &middot; Kasihan &middot; Bantul</span><span>Sistem Pendukung Keputusan &middot; Fuzzy Mamdani</span></div>
</footer>
