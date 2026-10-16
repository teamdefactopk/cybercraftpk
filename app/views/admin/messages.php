<div class="toolbar">
  <nav class="tabs" aria-label="Filter">
    <?php foreach (['' => 'All', 'new' => 'New', 'read' => 'Read', 'archived' => 'Archived'] as $k => $l): ?>
      <a href="<?= e(url('admin/messages' . ($k ? '?status=' . $k : ''))) ?>"<?= $status === $k ? ' class="active"' : '' ?>><?= $l ?></a>
    <?php endforeach ?>
  </nav>
  <form class="search" method="get"><?php if ($status): ?><input type="hidden" name="status" value="<?= e($status) ?>"><?php endif ?><label class="sr" for="mq">Search messages</label><input id="mq" name="q" value="<?= e($q) ?>" placeholder="Search name, email, text"><button class="btn btn-ghost btn-sm" type="submit"><?= icon('search') ?></button></form>
  <a class="btn btn-ghost btn-sm" href="<?= e(url('admin/messages/export')) ?>"><?= icon('download') ?>Export CSV</a>
</div>
<section class="card flush">
  <?php if (!$rows): ?>
    <p class="empty">No messages<?= $q || $status ? ' match this filter' : ' yet' ?>.</p>
  <?php else: ?>
  <div class="table-wrap"><table>
    <thead><tr><th></th><th>From</th><th>Interested in</th><th>Country</th><th>Message</th><th>Received</th></tr></thead>
    <tbody>
    <?php foreach ($rows as $m): ?>
      <tr class="<?= $m['status'] === 'new' ? 'unread' : '' ?>" data-href="<?= e(url('admin/messages/' . $m['id'])) ?>">
        <td><span class="dot <?= e($m['status']) ?>" title="<?= e($m['status']) ?>"></span></td>
        <td><a href="<?= e(url('admin/messages/' . $m['id'])) ?>"><b><?= e($m['name']) ?></b></a><br><span class="muted"><?= e($m['email']) ?></span></td>
        <td><?= e($m['service'] ?: '—') ?></td><td><?= e($m['country'] ?: '—') ?></td>
        <td class="clip"><?= e(mb_strimwidth($m['body'], 0, 90, '…')) ?></td>
        <td class="nowrap"><?= e(date('j M Y, H:i', strtotime($m['created_at']))) ?></td>
      </tr>
    <?php endforeach ?>
    </tbody>
  </table></div>
  <?php endif ?>
</section>
<?php if ($pages > 1): ?>
<nav class="pager" aria-label="Pages">
  <?php for ($i = 1; $i <= $pages; $i++): ?><a href="<?= e(url('admin/messages?' . http_build_query(array_filter(['status' => $status, 'q' => $q, 'p' => $i])))) ?>"<?= $i === $page ? ' class="active" aria-current="page"' : '' ?>><?= $i ?></a><?php endfor ?>
</nav>
<?php endif ?>
