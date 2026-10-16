<?php
$days = [];
for ($i = 13; $i >= 0; $i--) { $days[date('Y-m-d', strtotime("-$i days"))] = 0; }
foreach ($week as $w) { if (isset($days[$w['d']])) $days[$w['d']] = (int)$w['n']; }
$max = max(1, max($days));
?>
<div class="stats">
  <a class="stat" href="<?= e(url('admin/messages?status=new')) ?>"><span class="stat-ico accent"><?= icon('inbox') ?></span><span><b><?= $stats['new'] ?></b>New messages</span></a>
  <a class="stat" href="<?= e(url('admin/messages')) ?>"><span class="stat-ico"><?= icon('mail') ?></span><span><b><?= $stats['messages'] ?></b>Total messages</span></a>
  <a class="stat" href="<?= e(url('admin/c/services')) ?>"><span class="stat-ico"><?= icon('grid') ?></span><span><b><?= $stats['services'] ?></b>Live services</span></a>
  <a class="stat" href="<?= e(url('admin/c/clients')) ?>"><span class="stat-ico<?= $stats['samples'] ? ' accent' : '' ?>"><?= icon('users') ?></span><span><b><?= $stats['samples'] ?></b>Sample clients &amp; cases to replace</span></a>
</div>

<div class="cols-2">
  <section class="card">
    <div class="card-head"><h2>Enquiries, last 14 days</h2></div>
    <div class="bars" role="img" aria-label="Messages per day over the last 14 days">
      <?php foreach ($days as $d => $n): ?>
        <div class="bar-col" title="<?= e(date('D j M', strtotime($d))) ?>: <?= $n ?>"><span class="bar-val"><?= $n ?: '' ?></span><span class="bar" style="height:<?= max(3, round($n / $max * 100)) ?>%"></span><span class="bar-label"><?= e(date('j', strtotime($d))) ?></span></div>
      <?php endforeach ?>
    </div>
  </section>
  <section class="card">
    <div class="card-head"><h2>Quick actions</h2></div>
    <div class="quick">
      <a href="<?= e(url('admin/pages?page=Home')) ?>"><?= icon('file') ?>Edit homepage text</a>
      <a href="<?= e(url('admin/c/services')) ?>"><?= icon('grid') ?>Edit services</a>
      <a href="<?= e(url('admin/c/clients')) ?>"><?= icon('users') ?>Replace sample clients</a>
      <a href="<?= e(url('admin/c/cases')) ?>"><?= icon('file') ?>Add real case studies</a>
      <a href="<?= e(url('admin/c/offices')) ?>"><?= icon('pin') ?>Add office addresses</a>
      <?php if (($user['role'] ?? '') === 'admin'): ?><a href="<?= e(url('admin/settings')) ?>"><?= icon('settings') ?>Emails, social links &amp; notifications</a><?php endif ?>
      <a href="<?= e(url('admin/messages/export')) ?>"><?= icon('download') ?>Export messages (CSV)</a>
    </div>
  </section>
</div>

<div class="cols-2">
  <section class="card">
    <div class="card-head"><h2>Latest messages</h2><a href="<?= e(url('admin/messages')) ?>">View all</a></div>
    <?php if (!$recent): ?>
      <p class="empty">No messages yet. Enquiries from the contact form will appear here.</p>
    <?php else: ?>
      <ul class="list">
        <?php foreach ($recent as $m): ?>
        <li><a href="<?= e(url('admin/messages/' . $m['id'])) ?>"><span class="dot <?= e($m['status']) ?>"></span><span class="list-main"><b><?= e($m['name']) ?></b><span><?= e($m['service'] ?: mb_strimwidth($m['body'], 0, 60, '…')) ?></span></span><time><?= e(date('j M, H:i', strtotime($m['created_at']))) ?></time></a></li>
        <?php endforeach ?>
      </ul>
    <?php endif ?>
  </section>
  <section class="card">
    <div class="card-head"><h2>Recent activity</h2><a href="<?= e(url('admin/activity')) ?>">View all</a></div>
    <?php if (!$activity): ?><p class="empty">No activity yet.</p><?php else: ?>
    <ul class="list">
      <?php foreach ($activity as $a): ?>
      <li><span class="list-row"><span class="list-main"><b><?= e($a['action']) ?></b><span><?= e(trim(($a['user_name'] ?? '') . ($a['details'] ? ' · ' . $a['details'] : ''))) ?></span></span><time><?= e(date('j M, H:i', strtotime($a['created_at']))) ?></time></span></li>
      <?php endforeach ?>
    </ul>
    <?php endif ?>
  </section>
</div>
