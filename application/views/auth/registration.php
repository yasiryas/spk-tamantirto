<p class="eyebrow">Akses survei</p>
<h2>Buat akun baru</h2>
<p>Akun baru aktif setelah disetujui admin.</p>

<?= $this->session->flashdata('message'); ?>

<form method="post" action="<?= base_url('auth/registration'); ?>">
  <label class="form-label" for="full_name">Nama lengkap</label>
  <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Nama Anda" value="<?= set_value('full_name'); ?>">
  <?= form_error('full_name', '<small class="invalid-feedback d-block">', '</small>'); ?>

  <label class="form-label" for="email">Alamat email</label>
  <input type="email" class="form-control" id="email" name="email" placeholder="nama@email.com" value="<?= set_value('email'); ?>">
  <?= form_error('email', '<small class="invalid-feedback d-block">', '</small>'); ?>

  <div class="grid-2" style="gap:12px;">
    <div>
      <label class="form-label" for="password">Kata sandi</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Minimal 6 karakter">
      <?= form_error('password', '<small class="invalid-feedback d-block">', '</small>'); ?>
    </div>
    <div>
      <label class="form-label" for="repeat_password">Ulangi kata sandi</label>
      <input type="password" class="form-control" id="repeat_password" name="repeat_password" placeholder="Sama seperti di atas">
      <?= form_error('repeat_password', '<small class="invalid-feedback d-block">', '</small>'); ?>
    </div>
  </div>

  <button type="submit" class="btn btn-gold btn-block mt-2">Daftar <i class="fas fa-arrow-right ml-1"></i></button>
</form>

<hr class="my-4">
<div class="d-flex justify-content-between" style="font-size:12px;">
  <a href="<?= base_url(); ?>">Kembali ke beranda</a>
  <a href="<?= base_url('auth'); ?>">Sudah punya akun? Masuk</a>
</div>
