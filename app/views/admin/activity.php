<section class="card flush">
  <?php if (!$rows): ?><p class="empty">No activity recorded yet.</p><?php else: ?>
  <div class="table-wrap"><table>
    <thead><tr><th>When</th><th>Who</th><th>Action</th><th>Details</th></tr></thead>
    <tbody><?php foreach ($rows as $a): ?><tr><td class="nowrap"><?= e(date('j M Y, H:i', strtotime($a['created_at']))) ?></td><td><?= e($a['user_name'] ?: '—') ?></td><td><b><?= e($a['action']) ?></b></td><td class="clip"><?= e($a['details'] ?: '') ?></td></tr><?php endforeach ?></tbody>
  </table></div>
  <?php endif ?>
</section>
