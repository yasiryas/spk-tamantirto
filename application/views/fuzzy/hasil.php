<?php
$this->load->view('partials/modal_confirm', [
  'modalId' => 'modal-hitung',
  'title' => 'Hitung ulang',
  'action' => base_url('fuzzy/hitung'),
  'message' => 'Perhitungan ulang akan menimpa hasil pada tahun yang sama. Lanjutkan?',
]);
?>

<div class="page-head">
  <div><p class="eyebrow">Inferensi fuzzy</p><h1>Hasil Perhitungan</h1><p>Rekap skor dan keputusan potensi setiap padukuhan.</p></div>
  <div class="d-flex" style="gap:8px;">
    <form class="d-flex" method="get" action="<?= base_url('fuzzy/hasil'); ?>">
      <select class="custom-select" name="tahun">
        <?php foreach ($tahunTersedia ?? [] as $item): ?>
          <option value="<?= htmlspecialchars($item['tahun'], ENT_QUOTES, 'UTF-8'); ?>" <?= (string) $item['tahun'] === (string) $tahun ? 'selected' : ''; ?>><?= htmlspecialchars($item['tahun'], ENT_QUOTES, 'UTF-8'); ?></option>
        <?php endforeach; ?>
        <?php if (empty($tahunTersedia)): ?><option value="<?= htmlspecialchars($tahun, ENT_QUOTES, 'UTF-8'); ?>"><?= htmlspecialchars($tahun, ENT_QUOTES, 'UTF-8'); ?></option><?php endif; ?>
      </select>
      <button class="btn btn-outline">Filter</button>
    </form>
    <button class="btn btn-gold" data-confirm-open="#modal-hitung" data-title="Hitung ulang" data-message="Perhitungan ulang akan menimpa hasil pada tahun yang sama. Lanjutkan?" data-form-action="<?= base_url('fuzzy/hitung'); ?>" data-fields="<?= modal_fields([]); ?>"><i class="fas fa-rotate mr-2"></i> Hitung ulang</button>
  </div>
</div>

<?= $this->session->flashdata('message'); ?>
<?php $this->load->view('partials/ringkasan', ['ringkasan' => $ringkasan, 'tahun' => $tahun]); ?>
<div class="mt-4">
  <?php $this->load->view('partials/potensi_utama', ['hasil' => $hasil]); ?>
</div>
<h3 class="mb-3 mt-4">Potensi per padukuhan</h3>
<?php $this->load->view('partials/tabel_hasil', ['hasil' => $hasil, 'showAksi' => true, 'tahun' => $tahun]); ?>
