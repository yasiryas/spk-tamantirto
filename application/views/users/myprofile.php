<div class="page-head">
  <div><p class="eyebrow">Akun</p><h1>Profil Saya</h1><p>Informasi akun yang digunakan untuk mengakses sistem.</p></div>
</div>

<div class="grid-2">
  <div class="card">
    <div class="card-head"><h3>Data akun</h3></div>
    <?php if (!empty($user)): ?>
      <div class="bar-row"><span>Nama</span><div><strong><?= htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'); ?></strong></div><span></span></div>
      <div class="bar-row"><span>Email</span><div><strong><?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?></strong></div><span></span></div>
      <div class="bar-row"><span>Role</span><div><strong><?= htmlspecialchars(str_replace('_', ' ', $user['role']), ENT_QUOTES, 'UTF-8'); ?></strong></div><span></span></div>
      <div class="bar-row"><span>Status</span><div><span class="badge tinggi">Aktif</span></div><span></span></div>
    <?php endif; ?>
  </div>
  <div class="card">
    <div class="card-head"><h3>Akses cepat</h3></div>
    <div class="rule-list">
      <a class="rule-item" href="<?= base_url('user/hasil_keputusan'); ?>"><span>Lihat rekap potensi padukuhan</span><i class="fas fa-arrow-right"></i></a>
      <a class="rule-item" href="<?= base_url('fuzzy/metode'); ?>"><span>Pelajari metode perhitungan</span><i class="fas fa-arrow-right"></i></a>
      <a class="rule-item" href="<?= base_url('auth/logout'); ?>"><span>Keluar dari akun</span><i class="fas fa-arrow-right"></i></a>
    </div>
  </div>
</div>
