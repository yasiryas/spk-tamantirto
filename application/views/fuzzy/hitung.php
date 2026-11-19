<div class="page-head">
  <div><p class="eyebrow">Perhitungan</p><h1>Hitung Ulang</h1><p>Jalankan seluruh 81 aturan fuzzy untuk semua padukuhan.</p></div>
</div>

<?= $this->session->flashdata('message'); ?>

<div class="grid-2">
  <div class="card">
    <div class="card-head"><h3>Proses perhitungan</h3></div>
    <form method="post" action="<?= base_url('fuzzy/hitung'); ?>">
      <label class="form-label" for="tahun">Tahun survei</label>
      <input class="form-control" type="text" id="tahun" name="tahun" value="<?= htmlspecialchars($tahun, ENT_QUOTES, 'UTF-8'); ?>" maxlength="4" pattern="[0-9]{4}" required>
      <div class="method-steps mt-4">
        <div class="method-step"><div><h4>Normalisasi skor</h4><p>Setiap anasir dibagi skor maksimalnya, lalu diskalakan ke 0–100.</p></div></div>
        <div class="method-step"><div><h4>Fuzzifikasi</h4><p>Setiap nilai diubah ke derajat keanggotaan rendah, sedang, dan tinggi.</p></div></div>
        <div class="method-step"><div><h4>Inferensi &amp; defuzzifikasi</h4><p>Aturan Mamdani diagregasi, lalu centroid menghasilkan skor akhir 0–222.</p></div></div>
      </div>
      <button class="btn btn-gold btn-block mt-4"><i class="fas fa-play mr-2"></i> Hitung <?= (int) ($jumlahPadukuhan ?? 0); ?> padukuhan</button>
    </form>
  </div>
  <div class="card">
    <div class="card-head"><h3>Catatan</h3></div>
    <p class="text-muted" style="font-size:13px;">Perhitungan akan menimpa hasil dengan tahun yang sama. Pastikan seluruh skor pertanyaan sudah sesuai sebelum menjalankan proses ini.</p>
    <div class="rule-list mt-3">
      <div class="rule-item"><span>Skor maksimal SDA</span><strong>80</strong></div>
      <div class="rule-item"><span>Skor maksimal SDM</span><strong>52</strong></div>
      <div class="rule-item"><span>Skor maksimal KL</span><strong>28</strong></div>
      <div class="rule-item"><span>Skor maksimal PSR</span><strong>62</strong></div>
    </div>
  </div>
</div>
