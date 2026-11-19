<div class="page-head">
  <div><p class="eyebrow">Akses sistem</p><h1>Rekap Potensi</h1><p>Lihat skor dan kategori potensi setiap padukuhan.</p></div>
</div>

<?= $this->session->flashdata('message'); ?>
<h3 class="mb-3">Sektor potensi</h3>
<?php $this->load->view('partials/kategori_grid', ['kategoriRingkasan' => $kategoriRingkasan ?? []]); ?>

<h3 class="mb-3 mt-4">Sebaran potensi</h3>
<?php $this->load->view('partials/ringkasan', ['ringkasan' => $ringkasan, 'tahun' => date('Y')]); ?>
<div class="mt-4">
  <?php $this->load->view('partials/potensi_utama', ['hasil' => $hasil ?? []]); ?>
</div>
<div class="card-head mt-4"><h3>Daftar padukuhan</h3><a class="btn btn-outline btn-sm" href="<?= base_url('fuzzy/metode'); ?>">Lihat metode</a></div>
<?php $this->load->view('partials/tabel_hasil', ['hasil' => $hasil ?? [], 'showAksi' => false, 'tahun' => date('Y')]); ?>
