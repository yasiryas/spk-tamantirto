<?php
$colspan = !empty($showAksi) ? 6 : 5;
$penjelasan = [
  'Rendah' => 'Perlu pendampingan',
  'Sedang' => 'Cukup berpotensi',
  'Tinggi' => 'Sangat berpotensi',
];
?>

<div class="card flush">
  <table class="table mb-0">
    <thead>
      <tr><th>Padukuhan</th><th>Potensi utama</th><th class="num">Skor potensi</th><th>Klasifikasi</th><?= !empty($showAksi) ? '<th></th>' : ''; ?></tr>
    </thead>
    <tbody>
      <?php if (empty($hasil)): ?>
        <tr><td colspan="<?= $colspan; ?>" class="empty">Belum ada hasil perhitungan untuk tahun ini.</td></tr>
      <?php endif; ?>
      <?php foreach ($hasil ?? [] as $row): ?>
        <?php
        $namaKategori = $row['potensi_nama'] ?? 'Belum ada data';
        $ikonKategori = kategori_icon($namaKategori, $row['potensi_ikon'] ?? null);
        $keputusan = $row['hasil_keputusan'] ?? '';
        ?>
        <tr>
          <td class="font-weight-bold"><?= htmlspecialchars($row['nama_padukuhan'], ENT_QUOTES, 'UTF-8'); ?></td>
          <td>
            <div class="potensi-inline">
              <i class="<?= htmlspecialchars($ikonKategori, ENT_QUOTES, 'UTF-8'); ?>"></i>
              <span>
                <strong><?= htmlspecialchars($namaKategori, ENT_QUOTES, 'UTF-8'); ?></strong>
                <small>
                  <?php if ((int) ($row['potensi_skor'] ?? 0) > 0): ?>
                    Skor kategori <?= (int) $row['potensi_skor']; ?> &middot; <?= (float) $row['potensi_porsi']; ?>% dari total
                    <?php if (!empty($row['potensi_alternatif'])): ?>&middot; cadangan: <?= htmlspecialchars($row['potensi_alternatif'], ENT_QUOTES, 'UTF-8'); ?><?php endif; ?>
                  <?php else: ?>
                    Belum ada penilaian kategori
                  <?php endif; ?>
                </small>
              </span>
            </div>
          </td>
          <td class="num font-weight-bold"><?= number_format((float) $row['skor_fuzzy'], 2, ',', '.'); ?><small>/ 222</small></td>
          <td>
            <span class="badge <?= strtolower($keputusan); ?>"><?= htmlspecialchars($keputusan, ENT_QUOTES, 'UTF-8'); ?></span>
            <small class="klasifikasi-note"><?= htmlspecialchars($penjelasan[$keputusan] ?? '', ENT_QUOTES, 'UTF-8'); ?></small>
          </td>
          <?php if (!empty($showAksi)): ?>
            <td class="text-right"><a class="btn btn-outline btn-sm" href="<?= base_url('fuzzy/detail/' . (int) $row['id_padukuhan'] . '?tahun=' . rawurlencode($tahun ?? date('Y'))); ?>">Rincian</a></td>
          <?php endif; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
