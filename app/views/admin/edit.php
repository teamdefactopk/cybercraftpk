<p><a class="back" href="<?= e(url('admin/c/' . $key)) ?>">← <?= e($def['title']) ?></a></p>
<form method="post" class="card form" enctype="multipart/form-data" data-dirty>
  <?= csrf_field() ?>
  <?php if ($errors): ?><div class="flash flash-error" role="alert"><?= icon('close') ?><span>Please fix the highlighted fields.</span></div><?php endif ?>
  <div class="grid-2">
  <?php foreach ($fields as $f): ?>
    <div class="<?= in_array($f['type'], ['textarea', 'lines', 'markdown'], true) || in_array($f['name'], ['summary', 'ideal', 'external_url', 'promise', 'msp', 'audit', 'horizons', 'result', 'logo_url', 'image'], true) ? 'span-2' : '' ?>">
      <?= view('admin/_field', ['f' => $f, 'value' => $row[$f['name']] ?? ($f['type'] === 'select' ? '' : ''), 'error' => $errors[$f['name']] ?? '']) ?>
    </div>
  <?php endforeach ?>
  </div>
  <div class="form-actions sticky">
    <button class="btn btn-primary" type="submit"><?= icon('check') ?><?= $id ? 'Save changes' : 'Add ' . e($def['singular']) ?></button>
    <a class="btn btn-ghost" href="<?= e(url('admin/c/' . $key)) ?>">Cancel</a>
    <?php $pub = $id ? admin_public_url($key, $row) : ''; if ($pub): ?><a class="btn btn-ghost" href="<?= e($pub) ?>" target="_blank" rel="noopener"><?= icon('eye') ?>View page</a><?php endif ?>
  </div>
</form>
<?php if ($id): ?>
<form method="post" action="<?= e(url('admin/c/' . $key . '/' . $id . '/delete')) ?>" class="danger-zone"><?= csrf_field() ?><button class="btn btn-danger btn-sm" type="submit" data-confirm="Delete this <?= e($def['singular']) ?>? This cannot be undone."><?= icon('trash') ?>Delete <?= e($def['singular']) ?></button></form>
<?php endif ?>
