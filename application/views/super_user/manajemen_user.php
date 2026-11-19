<?php
$roleOptions = [
  'user' => 'User',
  'admin' => 'Admin',
  'super_user' => 'Super user',
];

$fields = [
  ['name' => 'name', 'label' => 'Nama', 'type' => 'text', 'required' => true],
  ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'required' => true],
  ['name' => 'password', 'label' => 'Kata sandi', 'type' => 'password', 'help' => 'Wajib diisi saat menambah akun.'],
  ['name' => 'role', 'label' => 'Role', 'type' => 'select', 'required' => true, 'options' => $roleOptions],
  ['name' => 'is_active', 'type' => 'checkbox', 'label' => 'Aktif', 'value' => true],
];

$this->load->view('partials/modal_form', [
  'modalId' => 'modal-user',
  'title' => 'Akun',
  'action' => base_url('super_user/tambah_user'),
  'fields' => array_merge([['name' => 'id_user', 'type' => 'hidden']], $fields),
]);

$this->load->view('partials/modal_form', [
  'modalId' => 'modal-reset',
  'title' => 'Reset kata sandi',
  'action' => base_url('super_user/reset_password'),
  'fields' => [
    ['name' => 'id_user', 'type' => 'hidden'],
    ['name' => 'password', 'label' => 'Kata sandi baru', 'type' => 'password', 'required' => true, 'min' => 6],
  ],
]);

$this->load->view('partials/modal_confirm', [
  'modalId' => 'modal-konfirmasi',
  'title' => 'Hapus akun',
  'action' => base_url('super_user/hapus_user'),
  'message' => 'Hapus akun ini?',
]);
?>

<div class="page-head">
  <div><p class="eyebrow">Pengguna</p><h1>Manajemen User</h1><p>Tambah akun, ubah role, dan reset kata sandi.</p></div>
  <button class="btn btn-gold" data-form-open="#modal-user" data-title="Tambah akun" data-form-action="<?= base_url('super_user/tambah_user'); ?>" data-fields="<?= modal_fields(['is_active' => 1]); ?>"><i class="fas fa-plus mr-2"></i> Tambah</button>
</div>

<?= $this->session->flashdata('message'); ?>

<div class="card flush">
  <table class="table mb-0">
    <thead><tr><th>Nama</th><th>Email</th><th>Role</th><th>Status</th><th style="width:260px;">Aksi</th></tr></thead>
    <tbody>
      <?php foreach ($list_user ?? [] as $item): ?>
        <?php
        $nama = htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($item['email'], ENT_QUOTES, 'UTF-8');
        $dataUbah = modal_fields([
          'id_user' => (int) $item['id'],
          'name' => $item['name'],
          'email' => $item['email'],
          'role' => $item['role'],
          'is_active' => (int) $item['is_active'] === 1,
        ]);
        ?>
        <tr>
          <td class="font-weight-bold"><?= $nama; ?></td>
          <td><?= $email; ?></td>
          <td><?= htmlspecialchars(str_replace('_', ' ', $item['role']), ENT_QUOTES, 'UTF-8'); ?></td>
          <td><span class="badge <?= (int) $item['is_active'] === 1 ? 'tinggi' : 'rendah'; ?>"><?= (int) $item['is_active'] === 1 ? 'Aktif' : 'Nonaktif'; ?></span></td>
          <td class="d-flex" style="gap:6px;">
            <button class="btn btn-outline btn-sm" data-form-open="#modal-user" data-title="Ubah akun" data-form-action="<?= base_url('super_user/update_user'); ?>" data-fields="<?= $dataUbah; ?>"><i class="fas fa-edit mr-1"></i> Ubah</button>
            <button class="btn btn-outline btn-sm" data-confirm-open="#modal-reset" data-title="Reset kata sandi" data-message="Reset kata sandi akun &quot;<?= $nama; ?>&quot;?" data-form-action="<?= base_url('super_user/reset_password'); ?>" data-fields="<?= modal_fields(['id_user' => (int) $item['id']]); ?>"><i class="fas fa-key mr-1"></i> Reset</button>
            <button class="btn btn-sm btn-danger-soft" data-confirm-open="#modal-konfirmasi" data-title="Hapus akun" data-message="Hapus akun &quot;<?= $nama; ?>&quot;?" data-form-action="<?= base_url('super_user/hapus_user'); ?>" data-fields="<?= modal_fields(['id_user' => (int) $item['id']]); ?>"><i class="fas fa-trash mr-1"></i> Hapus</button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
