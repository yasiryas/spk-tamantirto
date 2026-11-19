<?php
$surveyorOptions = [];
foreach ($surveyor ?? [] as $item) {
  $surveyorOptions[(int) $item['id']] = $item['name'];
}

$padukuhanOptions = [];
foreach ($padukuhan ?? [] as $item) {
  $padukuhanOptions[(int) $item['id_padukuhan']] = $item['nama_padukuhan'];
}

$kategoriOptions = [];
foreach ($kategori ?? [] as $item) {
  $kategoriOptions[(int) $item['id_kategori']] = $item['nama_kategori'];
}

$indikatorOptions = [];
foreach ($indikator ?? [] as $item) {
  $indikatorOptions[(int) $item['id_indikator']] = $item['kode_indikator'] . ' — ' . $item['nama_indikator'];
}

$fields = [
  ['name' => 'tanggal_survey', 'label' => 'Tanggal', 'type' => 'date', 'required' => true, 'value' => date('Y-m-d')],
  ['name' => 'id_surveyor', 'label' => 'Surveyor', 'type' => 'select', 'required' => true, 'options' => $surveyorOptions],
  ['name' => 'id_padukuhan', 'label' => 'Padukuhan', 'type' => 'select', 'required' => true, 'options' => $padukuhanOptions],
  ['name' => 'pertanyaan', 'label' => 'Pertanyaan', 'type' => 'text', 'required' => true],
  ['name' => 'id_kategori', 'label' => 'Kategori', 'type' => 'select', 'required' => true, 'options' => $kategoriOptions],
  ['name' => 'id_indikator', 'label' => 'Indikator', 'type' => 'select', 'required' => true, 'options' => $indikatorOptions],
  ['name' => 'skor', 'label' => 'Skor', 'type' => 'number', 'required' => true, 'min' => 0],
];

$this->load->view('partials/modal_form', [
  'modalId' => 'modal-pertanyaan',
  'title' => 'Pertanyaan',
  'action' => base_url('manajemen_data/tambah_pertanyaan'),
  'fields' => array_merge([['name' => 'id_pertanyaan', 'type' => 'hidden']], $fields),
  'size' => 'modal-lg',
]);

$this->load->view('partials/modal_confirm', [
  'modalId' => 'modal-konfirmasi',
  'title' => 'Hapus pertanyaan',
  'action' => base_url('manajemen_data/hapus_pertanyaan'),
  'message' => 'Hapus pertanyaan ini?',
]);
?>

<div class="page-head">
  <div><p class="eyebrow">Data master</p><h1>Data Pertanyaan</h1><p>Pertanyaan survei beserta skor hasil penilaian per padukuhan.</p></div>
  <button class="btn btn-gold" data-form-open="#modal-pertanyaan" data-title="Tambah pertanyaan" data-form-action="<?= base_url('manajemen_data/tambah_pertanyaan'); ?>" data-fields="<?= modal_fields([]); ?>"><i class="fas fa-plus mr-2"></i> Tambah</button>
</div>

<?= $this->session->flashdata('message'); ?>

<div class="card flush">
  <table class="table mb-0">
    <thead><tr><th>Pertanyaan</th><th>Padukuhan</th><th>Indikator</th><th>Surveyor</th><th class="num">Skor</th><th style="width:170px;">Aksi</th></tr></thead>
    <tbody>
      <?php foreach ($data_pertanyaan ?? [] as $item): ?>
        <?php
        $pertanyaan = htmlspecialchars(mb_strimwidth($item['pertanyaan'], 0, 65, '…'), ENT_QUOTES, 'UTF-8');
        $dataUbah = modal_fields([
          'id_pertanyaan' => (int) $item['id_pertanyaan'],
          'tanggal_survey' => $item['tanggal_survey'],
          'id_surveyor' => (int) $item['id_surveyor'],
          'id_padukuhan' => (int) $item['id_padukuhan'],
          'pertanyaan' => $item['pertanyaan'],
          'id_kategori' => (int) $item['id_kategori'],
          'id_indikator' => (int) $item['id_indikator'],
          'skor' => (int) $item['skor'],
        ]);
        ?>
        <tr>
          <td><?= $pertanyaan; ?></td>
          <td><?= htmlspecialchars($item['nama_padukuhan'], ENT_QUOTES, 'UTF-8'); ?></td>
          <td><?= htmlspecialchars($item['nama_indikator'], ENT_QUOTES, 'UTF-8'); ?></td>
          <td><?= htmlspecialchars($item['surveyor'], ENT_QUOTES, 'UTF-8'); ?></td>
          <td class="num"><?= (int) $item['skor']; ?></td>
          <td class="d-flex" style="gap:6px;">
            <button class="btn btn-outline btn-sm" data-form-open="#modal-pertanyaan" data-title="Ubah pertanyaan" data-form-action="<?= base_url('manajemen_data/update_pertanyaan'); ?>" data-fields="<?= $dataUbah; ?>"><i class="fas fa-edit mr-1"></i> Ubah</button>
            <button class="btn btn-sm btn-danger-soft" data-confirm-open="#modal-konfirmasi" data-title="Hapus pertanyaan" data-message="Hapus pertanyaan &quot;<?= $pertanyaan; ?>&quot;?" data-form-action="<?= base_url('manajemen_data/hapus_pertanyaan'); ?>" data-fields="<?= modal_fields(['id_pertanyaan' => (int) $item['id_pertanyaan']]); ?>"><i class="fas fa-trash mr-1"></i> Hapus</button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
