<?php
$surveyorOptions = [];
foreach ($surveyor ?? [] as $item) {
  $surveyorOptions[(int) $item['id']] = $item['name'];
}

$pertanyaanOptions = [];
foreach ($pertanyaan ?? [] as $item) {
  $pertanyaanOptions[(int) $item['id_pertanyaan']] = mb_strimwidth($item['pertanyaan'], 0, 70, '…');
}

$fields = [
  ['name' => 'id_user', 'label' => 'Surveyor', 'type' => 'select', 'required' => true, 'options' => $surveyorOptions],
  ['name' => 'id_pertanyaan', 'label' => 'Pertanyaan', 'type' => 'select', 'required' => true, 'options' => $pertanyaanOptions],
  ['name' => 'tanggal_survey', 'label' => 'Tanggal survey', 'type' => 'date', 'required' => true, 'value' => date('Y-m-d')],
];

$this->load->view('partials/modal_form', [
  'modalId' => 'modal-survey',
  'title' => 'Survey',
  'action' => base_url('manajemen_data/tambah_survey'),
  'fields' => array_merge([['name' => 'id_survey', 'type' => 'hidden']], $fields),
]);

$this->load->view('partials/modal_confirm', [
  'modalId' => 'modal-konfirmasi',
  'title' => 'Hapus survey',
  'action' => base_url('manajemen_data/hapus_survey'),
  'message' => 'Hapus survey ini?',
]);
?>

<div class="page-head">
  <div><p class="eyebrow">Data master</p><h1>Data Survey</h1><p>Catatan survey yang dilakukan oleh pengguna terhadap pertanyaan.</p></div>
  <button class="btn btn-gold" data-form-open="#modal-survey" data-title="Tambah survey" data-form-action="<?= base_url('manajemen_data/tambah_survey'); ?>" data-fields="<?= modal_fields([]); ?>"><i class="fas fa-plus mr-2"></i> Tambah</button>
</div>

<?= $this->session->flashdata('message'); ?>

<div class="card flush">
  <table class="table mb-0">
    <thead><tr><th>Tanggal</th><th>Surveyor</th><th>Pertanyaan</th><th style="width:170px;">Aksi</th></tr></thead>
    <tbody>
      <?php foreach ($data_survey ?? [] as $item): ?>
        <?php
        $surveyor = htmlspecialchars($item['surveyor'], ENT_QUOTES, 'UTF-8');
        $dataUbah = modal_fields([
          'id_survey' => (int) $item['id_survey'],
          'id_user' => (int) $item['id_user'],
          'id_pertanyaan' => (int) $item['id_pertanyaan'],
          'tanggal_survey' => $item['tanggal_survey'],
        ]);
        ?>
        <tr>
          <td><?= htmlspecialchars($item['tanggal_survey'], ENT_QUOTES, 'UTF-8'); ?></td>
          <td class="font-weight-bold"><?= $surveyor; ?></td>
          <td><?= htmlspecialchars(mb_strimwidth($item['pertanyaan'], 0, 80, '…'), ENT_QUOTES, 'UTF-8'); ?></td>
          <td class="d-flex" style="gap:6px;">
            <button class="btn btn-outline btn-sm" data-form-open="#modal-survey" data-title="Ubah survey" data-form-action="<?= base_url('manajemen_data/update_survey'); ?>" data-fields="<?= $dataUbah; ?>"><i class="fas fa-edit mr-1"></i> Ubah</button>
            <button class="btn btn-sm btn-danger-soft" data-confirm-open="#modal-konfirmasi" data-title="Hapus survey" data-message="Hapus survey oleh &quot;<?= $surveyor; ?>&quot;?" data-form-action="<?= base_url('manajemen_data/hapus_survey'); ?>" data-fields="<?= modal_fields(['id_survey' => (int) $item['id_survey']]); ?>"><i class="fas fa-trash mr-1"></i> Hapus</button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
