<p class="eyebrow">Selamat datang kembali</p>
<h2>Masuk ke sistem</h2>
<p>Gunakan akun yang telah diberikan admin untuk mengelola data survei.</p>

<?= $this->session->flashdata('message'); ?>

<form method="post" action="<?= base_url('auth'); ?>">
  <label class="form-label" for="email">Alamat email</label>
  <input type="email" class="form-control" id="email" name="email" placeholder="nama@email.com" value="<?= set_value('email'); ?>" autocomplete="username">
  <?= form_error('email', '<small class="invalid-feedback d-block">', '</small>'); ?>

  <label class="form-label" for="password">Kata sandi</label>
  <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" autocomplete="current-password">
  <?= form_error('password', '<small class="invalid-feedback d-block">', '</small>'); ?>

  <button type="submit" class="btn btn-gold btn-block mt-2">Masuk <i class="fas fa-arrow-right ml-1"></i></button>
</form>

<hr class="my-4">
<div class="d-flex justify-content-between" style="font-size:12px;">
  <a href="<?= base_url(); ?>">Kembali ke beranda</a>
  <a href="<?= base_url('auth/registration'); ?>">Buat akun baru</a>
</div>
