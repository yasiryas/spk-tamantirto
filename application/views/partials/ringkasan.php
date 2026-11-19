<div class="stat-grid">
  <div class="stat">
    <div class="stat-label">Potensi rendah</div>
    <div class="stat-value" style="color:var(--rendah);"><?= (int) ($ringkasan['Rendah'] ?? 0); ?></div>
    <div class="stat-note">Skor di bawah 74</div>
  </div>
  <div class="stat">
    <div class="stat-label">Potensi sedang</div>
    <div class="stat-value" style="color:var(--sedang);"><?= (int) ($ringkasan['Sedang'] ?? 0); ?></div>
    <div class="stat-note">Skor 74 sampai 148</div>
  </div>
  <div class="stat">
    <div class="stat-label">Potensi tinggi</div>
    <div class="stat-value" style="color:var(--tinggi);"><?= (int) ($ringkasan['Tinggi'] ?? 0); ?></div>
    <div class="stat-note">Skor di atas 148</div>
  </div>
  <div class="stat">
    <div class="stat-label">Total padukuhan</div>
    <div class="stat-value"><?= array_sum($ringkasan ?? []); ?></div>
    <div class="stat-note">Data tahun <?= htmlspecialchars($tahun ?? date('Y'), ENT_QUOTES, 'UTF-8'); ?></div>
  </div>
</div>
