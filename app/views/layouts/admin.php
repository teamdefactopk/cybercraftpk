<?php
$sub = trim(substr(current_path(), 5), '/');
$is = fn(string $p) => ($sub === $p || ($p !== '' && str_starts_with($sub, $p . '/'))) ? ' class="active" aria-current="page"' : '';
$cols = Collections::all();
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title><?= e($title ?? 'Dashboard') ?> · CyberCraft admin</title>
<link rel="icon" href="<?= e(url('favicon.svg')) ?>" type="image/svg+xml">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Archivo:wght@700;800&family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap">
<link rel="stylesheet" href="<?= e(asset('css/admin.css')) ?>">
</head>
<body>
<div class="shell">
  <aside class="side" id="side">
    <a class="side-brand" href="<?= e(url('admin')) ?>"><?= logo_mark() ?><span>Cyber<span>Craft</span></span></a>
    <nav aria-label="Admin">
      <p class="side-label">Overview</p>
      <a href="<?= e(url('admin')) ?>"<?= $is('') ?>><?= icon('grid') ?>Dashboard</a>
      <a href="<?= e(url('admin/messages')) ?>"<?= $is('messages') ?>><?= icon('mail') ?>Messages<?php if (!empty($newCount)): ?><span class="badge"><?= (int)$newCount ?></span><?php endif ?></a>
      <p class="side-label">Content</p>
      <a href="<?= e(url('admin/pages')) ?>"<?= $is('pages') ?>><?= icon('file') ?>Page text</a>
      <?php foreach (Collections::NAV as $k): ?>
      <a href="<?= e(url('admin/c/' . $k)) ?>"<?= $is('c/' . $k) ?>><?= icon($cols[$k]['icon'] ?? 'grid') ?><?= e($cols[$k]['title']) ?></a>
      <?php endforeach ?>
      <p class="side-label">System</p>
      <?php if (($user['role'] ?? '') === 'admin'): ?>
      <a href="<?= e(url('admin/settings')) ?>"<?= $is('settings') ?>><?= icon('settings') ?>Settings</a>
      <a href="<?= e(url('admin/users')) ?>"<?= $is('users') ?>><?= icon('users') ?>Users</a>
      <?php endif ?>
      <a href="<?= e(url('admin/activity')) ?>"<?= $is('activity') ?>><?= icon('clock') ?>Activity log</a>
    </nav>
    <div class="side-foot">
      <span class="side-soon" title="Planned: client portal and ticketing"><?= icon('lock') ?>Client portal · coming later</span>
    </div>
  </aside>

  <div class="main">
    <header class="top">
      <button class="icon-btn menu" type="button" data-side aria-label="Toggle menu" aria-controls="side"><?= icon('menu') ?></button>
      <h1><?= e($title ?? 'Dashboard') ?></h1>
      <div class="top-actions">
        <a class="btn btn-ghost btn-sm" href="<?= e(url('/')) ?>" target="_blank" rel="noopener"><?= icon('external') ?><span>View site</span></a>
        <details class="user-menu">
          <summary><span class="avatar"><?= e(mb_strtoupper(mb_substr($user['name'] ?? '?', 0, 1))) ?></span><span class="uname"><?= e($user['name'] ?? '') ?></span></summary>
          <div class="user-pop">
            <p><b><?= e($user['name'] ?? '') ?></b><br><span><?= e($user['email'] ?? '') ?> · <?= e($user['role'] ?? '') ?></span></p>
            <a href="<?= e(url('admin/account')) ?>">My account</a>
            <form method="post" action="<?= e(url('admin/logout')) ?>"><?= csrf_field() ?><button type="submit">Sign out</button></form>
          </div>
        </details>
      </div>
    </header>
    <div class="content">
      <?php foreach (take_flash() as $f): ?>
        <div class="flash flash-<?= e($f['type']) ?>" role="<?= $f['type'] === 'error' ? 'alert' : 'status' ?>"><?= icon($f['type'] === 'error' ? 'close' : 'check') ?><span><?= e($f['msg']) ?></span></div>
      <?php endforeach ?>
      <?= $content ?>
    </div>
  </div>
</div>
<script src="<?= e(asset('js/admin.js')) ?>" defer></script>
</body>
</html>
