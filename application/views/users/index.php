<div class="page-head">
  <div><p class="eyebrow">Ringkasan desa</p><h1>Dashboard</h1><p>Data survei dan potensi Kalurahan Tamantirto dalam satu tampilan.</p></div>
</div>

<?= $this->session->flashdata('message'); ?>

<div class="stat-grid">
  <div class="stat"><div class="stat-label">Padukuhan</div><div class="stat-value"><?= (int) ($padukuhan ?? 0); ?></div></div>
  <div class="stat"><div class="stat-label">Indikator</div><div class="stat-value"><?= (int) ($indikator ?? 0); ?></div></div>
  <div class="stat"><div class="stat-label">Pertanyaan survei</div><div class="stat-value"><?= (int) ($pertanyaan ?? 0); ?></div></div>
  <div class="stat"><div class="stat-label">Survey tercatat</div><div class="stat-value"><?= (int) ($survey ?? 0); ?></div></div>
</div>

<h3 class="mb-3">Sektor potensi</h3>
<?php $this->load->view('partials/kategori_grid', ['kategoriRingkasan' => $kategoriRingkasan ?? []]); ?>

<h3 class="mb-3 mt-4">Sebaran potensi</h3>
<?php $this->load->view('partials/ringkasan', ['ringkasan' => $ringkasan, 'tahun' => date('Y')]); ?>

<div class="mt-4">
  <?php $this->load->view('partials/potensi_utama', ['hasil' => $hasil ?? []]); ?>
</div>

<div class="card-head mt-4"><h3>Hasil perhitungan</h3><a class="btn btn-outline btn-sm" href="<?= base_url('user/hasil_keputusan'); ?>">Lihat rekap</a></div>
<?php $this->load->view('partials/tabel_hasil', ['hasil' => array_slice($hasil ?? [], 0, 5), 'showAksi' => false, 'tahun' => date('Y')]); ?>
