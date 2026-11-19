<?php
$categories = [];
foreach ($hasil ?? [] as $row) {
  $nama = $row['potensi_nama'] ?? '';
  if ($nama === '' || $nama === 'Belum ada data') {
    continue;
  }
  if (!isset($categories[$nama])) {
    $categories[$nama] = ['jumlah' => 0, 'ikon' => $row['potensi_ikon'] ?? null, 'contoh' => $row['nama_padukuhan'] ?? ''];
  }
  $categories[$nama]['jumlah']++;
}

arsort($categories);
$categories = array_slice($categories, 0, 3, true);
?>

<div class="card">
  <div class="card-head"><h3>Potensi yang paling menonjol</h3><p>Kategori dengan skor tertinggi di tiap padukuhan.</p></div>
  <?php if (empty($categories)): ?>
    <p class="empty mb-0">Belum ada penilaian kategori pada hasil tahun ini.</p>
  <?php else: ?>
    <div class="potensi-highlight">
      <?php foreach ($categories as $nama => $item): ?>
        <?php $ikon = kategori_icon($nama, $item['ikon']); ?>
        <div class="potensi-highlight-item">
          <div class="potensi-icon"><i class="<?= htmlspecialchars($ikon, ENT_QUOTES, 'UTF-8'); ?>"></i></div>
          <div class="potensi-highlight-body">
            <strong><?= htmlspecialchars($nama, ENT_QUOTES, 'UTF-8'); ?></strong>
            <span><?= (int) $item['jumlah']; ?> padukuhan &middot; contoh: <?= htmlspecialchars($item['contoh'], ENT_QUOTES, 'UTF-8'); ?></span>
          </div>
          <span class="badge tinggi">Utama</span>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>
