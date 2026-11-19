<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= htmlspecialchars($title ?? 'Masuk', ENT_QUOTES, 'UTF-8'); ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/css/app.css'); ?>" rel="stylesheet">
</head>
<body>
  <div class="auth-shell">
    <aside class="auth-aside">
      <a class="sidebar-brand" href="<?= base_url(); ?>">
        <span class="brand-mark">T</span>
        <span>
          <span class="brand-name d-block">Tamantirto</span>
          <span class="brand-sub d-block">POTENSI DESA</span>
        </span>
      </a>
      <div>
        <p class="eyebrow" style="color:#e0b45c;">Inferensi Fuzzy Mamdani</p>
        <h1>Peta potensi desa, dari data yang tersebar.</h1>
        <p>Satu tempat untuk mengelola survei, menghitung skor, dan melihat rekomendasi potensi setiap padukuhan.</p>
      </div>
      <div style="font-size:11px;color:#a9c4b2;">Kalurahan Tamantirto &middot; Kasihan &middot; Bantul</div>
    </aside>
    <main class="auth-main">
      <div class="auth-card">
