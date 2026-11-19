<?php
$fields = [
  ['name' => 'nama_kategori', 'label' => 'Nama kategori', 'type' => 'text', 'required' => true],
  ['name' => 'ikon', 'label' => 'Kelas ikon', 'type' => 'text', 'required' => true, 'list' => 'daftar-ikon', 'placeholder' => 'fas fa-leaf', 'value' => 'fas fa-seedling'],
];

$this->load->view('partials/modal_form', [
  'modalId' => 'modal-kategori',
  'title' => 'Kategori',
  'action' => base_url('manajemen_data/tambah_kategori'),
  'fields' => array_merge([['name' => 'id_kategori', 'type' => 'hidden']], $fields),
]);

$this->load->view('partials/modal_confirm', [
  'modalId' => 'modal-konfirmasi',
  'title' => 'Hapus kategori',
  'action' => base_url('manajemen_data/hapus_kategori'),
  'message' => 'Hapus kategori ini?',
]);
?>

<datalist id="daftar-ikon">
  <?php foreach (kategori_pilihan_ikon() as $kelas => $label): ?>
    <option value="<?= $kelas; ?>"><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?></option>
  <?php endforeach; ?>
</datalist>

<div class="page-head">
  <div><p class="eyebrow">Data master</p><h1>Data Kategori</h1><p>Kategori potensi yang menjadi ruang lingkup pertanyaan survei.</p></div>
  <button class="btn btn-gold" data-form-open="#modal-kategori" data-title="Tambah kategori" data-form-action="<?= base_url('manajemen_data/tambah_kategori'); ?>" data-fields="<?= modal_fields([]); ?>"><i class="fas fa-plus mr-2"></i> Tambah</button>
</div>

<?= $this->session->flashdata('message'); ?>

<div class="card flush">
  <table class="table mb-0">
    <thead><tr><th style="width:64px;">Ikon</th><th>Nama kategori</th><th style="width:170px;">Aksi</th></tr></thead>
    <tbody>
      <?php foreach ($data_kategori ?? [] as $item): ?>
        <?php
        $nama = htmlspecialchars($item['nama_kategori'], ENT_QUOTES, 'UTF-8');
        $ikon = kategori_icon($item['nama_kategori'], $item['ikon'] ?? null);
        $dataUbah = modal_fields([
          'id_kategori' => (int) $item['id_kategori'],
          'nama_kategori' => $item['nama_kategori'],
          'ikon' => $item['ikon'] ?? 'fas fa-seedling',
        ]);
        ?>
        <tr>
          <td><i class="<?= htmlspecialchars($ikon, ENT_QUOTES, 'UTF-8'); ?>" style="color:var(--primary);font-size:18px;"></i></td>
          <td class="font-weight-bold"><?= $nama; ?></td>
          <td class="d-flex" style="gap:6px;">
            <button class="btn btn-outline btn-sm" data-form-open="#modal-kategori" data-title="Ubah kategori" data-form-action="<?= base_url('manajemen_data/update_kategori'); ?>" data-fields="<?= $dataUbah; ?>"><i class="fas fa-edit mr-1"></i> Ubah</button>
            <button class="btn btn-sm btn-danger-soft" data-confirm-open="#modal-konfirmasi" data-title="Hapus kategori" data-message="Hapus kategori &quot;<?= $nama; ?>&quot;?" data-form-action="<?= base_url('manajemen_data/hapus_kategori'); ?>" data-fields="<?= modal_fields(['id_kategori' => (int) $item['id_kategori']]); ?>"><i class="fas fa-trash mr-1"></i> Hapus</button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
