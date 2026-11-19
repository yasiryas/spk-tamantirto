<div class="kategori-grid">
  <?php foreach ($kategoriRingkasan ?? [] as $item): ?>
    <?php $jumlah = (int) ($item['jumlah_pertanyaan'] ?? 0); ?>
    <div class="kategori-card">
      <span class="kategori-icon"><i class="<?= htmlspecialchars(kategori_icon($item['nama_kategori'], $item['ikon'] ?? null), ENT_QUOTES, 'UTF-8'); ?>"></i></span>
      <h3><?= htmlspecialchars($item['nama_kategori'], ENT_QUOTES, 'UTF-8'); ?></h3>
      <p><?= $jumlah > 0 ? $jumlah . ' penilaian &middot; skor ' . (int) $item['total_skor'] : 'Belum ada penilaian'; ?></p>
    </div>
  <?php endforeach; ?>
</div>
