<nav class="tabs" aria-label="Pages">
  <?php foreach ($pages as $p): ?><a href="<?= e(url('admin/pages?page=' . rawurlencode($p))) ?>"<?= $p === $current ? ' class="active" aria-current="page"' : '' ?>><?= e($p) ?></a><?php endforeach ?>
</nav>
<form method="post" class="card form" data-dirty>
  <?= csrf_field() ?>
  <div class="card-head"><h2><?= e($current) ?></h2><span class="muted">Changes appear on the website as soon as you save.</span></div>
  <?php foreach ($blocks as $b): ?>
    <?= view('admin/_field', ['f' => ['name' => $b['k'], 'label' => $b['label'], 'type' => $b['type'] === 'text' ? 'text' : $b['type'], 'help' => $b['type'] === 'lines' && str_contains($b['label'], '|') ? 'One per line, title and text separated by |' : '', 'required' => false, 'options' => []], 'value' => $b['v'], 'prefix' => 'b_']) ?>
  <?php endforeach ?>
  <div class="form-actions sticky"><button class="btn btn-primary" type="submit"><?= icon('check') ?>Save <?= e($current) ?> text</button></div>
</form>
