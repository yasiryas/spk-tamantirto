<?php
$fields = [
  ['name' => 'nama_indikator', 'label' => 'Nama indikator', 'type' => 'text', 'required' => true],
  ['name' => 'kode_indikator', 'label' => 'Kode', 'type' => 'text', 'required' => true, 'placeholder' => 'SDA'],
  ['name' => 'skor_maksimal', 'label' => 'Skor maksimal', 'type' => 'number', 'required' => true, 'min' => 1],
];

$this->load->view('partials/modal_form', [
  'modalId' => 'modal-indikator',
  'title' => 'Indikator',
  'action' => base_url('manajemen_data/tambah_indikator'),
  'fields' => array_merge([['name' => 'id_indikator', 'type' => 'hidden']], $fields),
]);

$this->load->view('partials/modal_confirm', [
  'modalId' => 'modal-konfirmasi',
  'title' => 'Hapus indikator',
  'action' => base_url('manajemen_data/hapus_indikator'),
  'message' => 'Hapus indikator ini?',
]);
?>

<div class="page-head">
  <div><p class="eyebrow">Data master</p><h1>Data Indikator</h1><p>Indikator beserta skor maksimal yang dipakai saat normalisasi.</p></div>
  <button class="btn btn-gold" data-form-open="#modal-indikator" data-title="Tambah indikator" data-form-action="<?= base_url('manajemen_data/tambah_indikator'); ?>" data-fields="<?= modal_fields([]); ?>"><i class="fas fa-plus mr-2"></i> Tambah</button>
</div>

<?= $this->session->flashdata('message'); ?>

<div class="card flush">
  <table class="table mb-0">
    <thead><tr><th>Kode</th><th>Nama indikator</th><th class="num">Skor maksimal</th><th style="width:170px;">Aksi</th></tr></thead>
    <tbody>
      <?php foreach ($data_indikator ?? [] as $item): ?>
        <?php
        $nama = htmlspecialchars($item['nama_indikator'], ENT_QUOTES, 'UTF-8');
        $dataUbah = modal_fields([
          'id_indikator' => (int) $item['id_indikator'],
          'nama_indikator' => $item['nama_indikator'],
          'kode_indikator' => $item['kode_indikator'],
          'skor_maksimal' => (int) $item['skor_maksimal'],
        ]);
        ?>
        <tr>
          <td class="font-weight-bold"><?= htmlspecialchars($item['kode_indikator'], ENT_QUOTES, 'UTF-8'); ?></td>
          <td><?= $nama; ?></td>
          <td class="num"><?= (int) $item['skor_maksimal']; ?></td>
          <td class="d-flex" style="gap:6px;">
            <button class="btn btn-outline btn-sm" data-form-open="#modal-indikator" data-title="Ubah indikator" data-form-action="<?= base_url('manajemen_data/update_indikator'); ?>" data-fields="<?= $dataUbah; ?>"><i class="fas fa-edit mr-1"></i> Ubah</button>
            <button class="btn btn-sm btn-danger-soft" data-confirm-open="#modal-konfirmasi" data-title="Hapus indikator" data-message="Hapus indikator &quot;<?= $nama; ?>&quot;?" data-form-action="<?= base_url('manajemen_data/hapus_indikator'); ?>" data-fields="<?= modal_fields(['id_indikator' => (int) $item['id_indikator']]); ?>"><i class="fas fa-trash mr-1"></i> Hapus</button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
