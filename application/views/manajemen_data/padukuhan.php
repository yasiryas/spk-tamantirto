<?php
$fields = [
  ['name' => 'nama_padukuhan', 'label' => 'Nama padukuhan', 'type' => 'text', 'required' => true],
];

$this->load->view('partials/modal_form', [
  'modalId' => 'modal-padukuhan',
  'title' => 'Padukuhan',
  'action' => base_url('manajemen_data/tambah_padukuhan'),
  'fields' => array_merge([['name' => 'id_padukuhan', 'type' => 'hidden']], $fields),
]);

$this->load->view('partials/modal_confirm', [
  'modalId' => 'modal-konfirmasi',
  'title' => 'Hapus padukuhan',
  'action' => base_url('manajemen_data/hapus_padukuhan'),
  'message' => 'Hapus padukuhan ini?',
]);
?>

<div class="page-head">
  <div><p class="eyebrow">Data master</p><h1>Data Padukuhan</h1><p>Kelola daftar padukuhan yang dinilai dalam survei.</p></div>
  <button class="btn btn-gold" data-form-open="#modal-padukuhan" data-title="Tambah padukuhan" data-form-action="<?= base_url('manajemen_data/tambah_padukuhan'); ?>" data-fields="<?= modal_fields([]); ?>"><i class="fas fa-plus mr-2"></i> Tambah</button>
</div>

<?= $this->session->flashdata('message'); ?>

<div class="card flush">
  <table class="table mb-0">
    <thead><tr><th>Nama padukuhan</th><th style="width:170px;">Aksi</th></tr></thead>
    <tbody>
      <?php foreach ($data_padukuhan ?? [] as $item): ?>
        <?php
        $nama = htmlspecialchars($item['nama_padukuhan'], ENT_QUOTES, 'UTF-8');
        $dataUbah = modal_fields([
          'id_padukuhan' => (int) $item['id_padukuhan'],
          'nama_padukuhan' => $item['nama_padukuhan'],
        ]);
        ?>
        <tr>
          <td class="font-weight-bold"><?= $nama; ?></td>
          <td class="d-flex" style="gap:6px;">
            <button class="btn btn-outline btn-sm" data-form-open="#modal-padukuhan" data-title="Ubah padukuhan" data-form-action="<?= base_url('manajemen_data/update_padukuhan'); ?>" data-fields="<?= $dataUbah; ?>"><i class="fas fa-edit mr-1"></i> Ubah</button>
            <button class="btn btn-sm btn-danger-soft" data-confirm-open="#modal-konfirmasi" data-title="Hapus padukuhan" data-message="Hapus padukuhan &quot;<?= $nama; ?>&quot;?" data-form-action="<?= base_url('manajemen_data/hapus_padukuhan'); ?>" data-fields="<?= modal_fields(['id_padukuhan' => (int) $item['id_padukuhan']]); ?>"><i class="fas fa-trash mr-1"></i> Hapus</button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
