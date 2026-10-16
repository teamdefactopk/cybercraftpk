<div class="toolbar">
  <?php if (!empty($def['help'])): ?><p class="muted"><?= e($def['help']) ?></p><?php endif ?>
  <a class="btn btn-primary btn-sm" href="<?= e(url('admin/c/' . $key . '/new')) ?>"><?= icon('plus') ?>Add <?= e($def['singular']) ?></a>
</div>
<section class="card flush">
  <?php if (!$rows): ?>
    <p class="empty">Nothing here yet. <a href="<?= e(url('admin/c/' . $key . '/new')) ?>">Add the first <?= e($def['singular']) ?></a>.</p>
  <?php else: ?>
  <div class="table-wrap"><table>
    <thead><tr><?php foreach ($def['columns'] as $label): ?><th><?= e($label) ?></th><?php endforeach ?><th class="right">Actions</th></tr></thead>
    <tbody>
    <?php foreach ($rows as $r): ?>
      <tr data-href="<?= e(url('admin/c/' . $key . '/' . $r['id'])) ?>">
        <?php $first = true; foreach ($def['columns'] as $col => $label): $val = $r[$col] ?? ''; ?>
          <td<?= $first ? '' : ' class="clip"' ?>>
            <?php if (isset($lookups[$col])): ?><?= e($lookups[$col][$val] ?? '—') ?>
            <?php elseif (in_array($col, ['is_active', 'featured', 'is_sample', 'is_core', 'is_hq'], true)): ?><span class="pill <?= $val ? 'on' : 'off' ?>"><?= $val ? 'Yes' : 'No' ?></span>
            <?php elseif ($col === 'price_amount'): ?><?= $val !== '' ? e($val . ($r['price_unit'] ?? '')) : '<span class="muted">Let\'s talk</span>' ?>
            <?php elseif ($first): ?><a href="<?= e(url('admin/c/' . $key . '/' . $r['id'])) ?>"><b><?= e($val) ?></b></a>
            <?php else: ?><?= trim((string)$val) === '' ? '<span class="muted">—</span>' : e(mb_strimwidth((string)$val, 0, 70, '…')) ?><?php endif ?>
          </td>
        <?php $first = false; endforeach ?>
        <td class="right nowrap">
          <a class="icon-btn sm" href="<?= e(url('admin/c/' . $key . '/' . $r['id'])) ?>" aria-label="Edit"><?= icon('edit') ?></a>
          <?php $pub = admin_public_url($key, $r); if ($pub): ?><a class="icon-btn sm" href="<?= e($pub) ?>" target="_blank" rel="noopener" aria-label="View on site"><?= icon('eye') ?></a><?php endif ?>
          <form method="post" action="<?= e(url('admin/c/' . $key . '/' . $r['id'] . '/delete')) ?>" class="inline"><?= csrf_field() ?><button class="icon-btn sm danger" type="submit" aria-label="Delete" data-confirm="Delete this <?= e($def['singular']) ?>? This cannot be undone."><?= icon('trash') ?></button></form>
        </td>
      </tr>
    <?php endforeach ?>
    </tbody>
  </table></div>
  <?php endif ?>
</section>
