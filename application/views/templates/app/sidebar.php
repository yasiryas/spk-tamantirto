<?php
$role = $user['role'] ?? 'user';
$segment = $this->uri->segment(1);
$subSegment = $this->uri->segment(2);
$active = static fn (string $value): string => $segment === $value ? ' active' : '';
$activePage = static fn (string $value): string => $subSegment === $value ? ' active' : '';
$masterOpen = $segment === 'manajemen_data';
$analisisOpen = in_array($subSegment, ['hasil', 'hasil_keputusan', 'metode'], true);
?>
<aside class="sidebar">
  <div>
    <a class="sidebar-brand" href="<?= base_url($role); ?>">
      <span class="brand-mark">T</span>
      <span>
        <span class="brand-name d-block">Tamantirto</span>
        <span class="brand-sub d-block">POTENSI DESA</span>
      </span>
    </a>

    <p class="nav-label mt-4">Menu utama</p>
    <ul class="nav-list">
      <li><a class="nav-link<?= $active($role); ?>" href="<?= base_url($role); ?>"><i class="fas fa-tachometer-alt" aria-hidden="true"></i> Dashboard</a></li>

      <?php if ($role === 'super_user'): ?>
        <li><a class="nav-link<?= $activePage('manajemen_user'); ?>" href="<?= base_url('super_user/manajemen_user'); ?>"><i class="fas fa-users-cog" aria-hidden="true"></i> Manajemen User</a></li>
      <?php endif; ?>

      <?php if ($role !== 'user'): ?>
        <li>
          <button class="nav-link nav-toggle" type="button" data-toggle="collapse" data-target="#submenu-master" aria-expanded="<?= $masterOpen ? 'true' : 'false'; ?>" aria-controls="submenu-master"><i class="fas fa-database" aria-hidden="true"></i> Data Master<i class="fas fa-chevron-down nav-caret" aria-hidden="true"></i></button>
          <ul class="nav-sublist collapse<?= $masterOpen ? ' show' : ''; ?>" id="submenu-master">
            <li><a class="nav-sublink<?= $activePage('padukuhan'); ?>" href="<?= base_url('manajemen_data/padukuhan'); ?>"><i class="fas fa-map-marker-alt" aria-hidden="true"></i> Padukuhan</a></li>
            <li><a class="nav-sublink<?= $activePage('kategori'); ?>" href="<?= base_url('manajemen_data/kategori'); ?>"><i class="fas fa-tags" aria-hidden="true"></i> Kategori</a></li>
            <li><a class="nav-sublink<?= $activePage('indikator'); ?>" href="<?= base_url('manajemen_data/indikator'); ?>"><i class="fas fa-list-alt" aria-hidden="true"></i> Indikator</a></li>
            <li><a class="nav-sublink<?= $activePage('survey'); ?>" href="<?= base_url('manajemen_data/survey'); ?>"><i class="fas fa-clipboard-list" aria-hidden="true"></i> Survey</a></li>
            <li><a class="nav-sublink<?= $activePage('pertanyaan'); ?>" href="<?= base_url('manajemen_data/pertanyaan'); ?>"><i class="fas fa-question-circle" aria-hidden="true"></i> Pertanyaan</a></li>
          </ul>
        </li>
      <?php endif; ?>

      <li>
        <button class="nav-link nav-toggle" type="button" data-toggle="collapse" data-target="#submenu-analisis" aria-expanded="<?= $analisisOpen ? 'true' : 'false'; ?>" aria-controls="submenu-analisis"><i class="fas fa-chart-line" aria-hidden="true"></i> Analisis Potensi<i class="fas fa-chevron-down nav-caret" aria-hidden="true"></i></button>
        <ul class="nav-sublist collapse<?= $analisisOpen ? ' show' : ''; ?>" id="submenu-analisis">
          <?php if ($role !== 'user'): ?>
            <li><a class="nav-sublink<?= $activePage('hasil'); ?>" href="<?= base_url('fuzzy/hasil'); ?>"><i class="fas fa-chart-bar" aria-hidden="true"></i> Hasil Fuzzy</a></li>
          <?php endif; ?>
          <li><a class="nav-sublink<?= $activePage('hasil_keputusan'); ?>" href="<?= base_url('user/hasil_keputusan'); ?>"><i class="fas fa-chart-pie" aria-hidden="true"></i> Rekap Potensi</a></li>
          <li><a class="nav-sublink<?= $activePage('metode'); ?>" href="<?= base_url('fuzzy/metode'); ?>"><i class="fas fa-book-open" aria-hidden="true"></i> Metode</a></li>
        </ul>
      </li>
      <li><a class="nav-link<?= $activePage('myprofile'); ?>" href="<?= base_url('user/myprofile'); ?>"><i class="fas fa-user" aria-hidden="true"></i> Profil</a></li>
    </ul>

    <p class="nav-label mt-4">Sistem</p>
    <ul class="nav-list">
      <li><a class="nav-link" href="<?= base_url('auth/logout'); ?>"><i class="fas fa-sign-out-alt" aria-hidden="true"></i> Keluar</a></li>
    </ul>
  </div>

  <div class="sidebar-foot">Fuzzy Mamdani &middot; Tahun <?= date('Y'); ?></div>
</aside>
