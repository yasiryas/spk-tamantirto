<div class="page-head">
  <div><p class="eyebrow">Dasar perhitungan</p><h1>Metode Fuzzy Mamdani</h1><p>Fungsi keanggotaan, basis aturan, dan batas klasifikasi yang digunakan sistem.</p></div>
</div>

<div class="card">
  <div class="card-head"><h3>Fungsi keanggotaan input</h3><p>Nilai sudah dinormalisasi ke rentang 0–100</p></div>
  <table class="table mb-0">
    <thead><tr><th>Variabel</th><th>Rendah</th><th>Sedang</th><th>Tinggi</th></tr></thead>
    <tbody>
      <?php foreach ($variabel as $kode => $parameter): ?>
        <tr>
          <td class="font-weight-bold"><?= $kode; ?></td>
          <td><?= implode(', ', $parameter['R']); ?></td>
          <td><?= implode(', ', $parameter['S']); ?></td>
          <td><?= implode(', ', $parameter['T']); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<div class="grid-2">
  <div class="card">
    <div class="card-head"><h3>Fungsi keanggotaan output</h3></div>
    <table class="table mb-0">
      <thead><tr><th>Kelas</th><th>Parameter</th></tr></thead>
      <tbody>
        <?php foreach ($keluaran as $kode => $parameter): ?>
          <tr><td class="font-weight-bold"><?= $label[$kode]; ?></td><td><?= implode(', ', $parameter); ?></td></tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div class="card">
    <div class="card-head"><h3>Klasifikasi akhir</h3></div>
    <div class="rule-list">
      <div class="rule-item"><span>Rendah</span><strong>skor &lt; 74</strong></div>
      <div class="rule-item"><span>Sedang</span><strong>74 ≤ skor &lt; 148</strong></div>
      <div class="rule-item"><span>Tinggi</span><strong>skor ≥ 148</strong></div>
    </div>
    <p class="text-muted mb-0 mt-3" style="font-size:12px;">Skor akhir berasal dari defuzzifikasi centroid pada domain 0–222.</p>
  </div>
</div>

<div class="card">
  <div class="card-head"><h3>Basis aturan</h3><span class="badge"><?= count($aturan); ?> aturan</span></div>
  <table class="table mb-0">
    <thead><tr><th>No</th><th>KL</th><th>SDA</th><th>PSR</th><th>SDM</th><th>Hasil</th></tr></thead>
    <tbody>
      <?php foreach ($aturan as $item): ?>
        <tr>
          <td class="num"><?= (int) $item['nomor']; ?></td>
          <td><?= $label[$item['KL']]; ?></td><td><?= $label[$item['SDA']]; ?></td>
          <td><?= $label[$item['PSR']]; ?></td><td><?= $label[$item['SDM']]; ?></td>
          <td><span class="badge <?= strtolower($label[$item['TD']]); ?>"><?= $label[$item['TD']]; ?></span></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
