<div class="app-main">
  <header class="topbar">
    <div>
      <div class="topbar-title"><?= htmlspecialchars($title ?? '', ENT_QUOTES, 'UTF-8'); ?></div>
      <div class="topbar-sub">Kalurahan Tamantirto, Kecamatan Kasihan, Bantul</div>
    </div>
    <div class="topbar-user">
      <div class="avatar text-uppercase"><?= htmlspecialchars(substr($user['name'] ?? 'U', 0, 1), ENT_QUOTES, 'UTF-8'); ?></div>
      <div>
        <div class="font-weight-bold" style="line-height:1.2;"><?= htmlspecialchars($user['name'] ?? 'User', ENT_QUOTES, 'UTF-8'); ?></div>
        <div class="text-muted" style="font-size:11px;"><?= htmlspecialchars(str_replace('_', ' ', $user['role'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></div>
      </div>
    </div>
  </header>
  <main class="content">
