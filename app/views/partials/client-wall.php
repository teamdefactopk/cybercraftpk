<div class="cl-grid">
  <?php foreach ($clients as $c): ?>
  <div class="cl">
    <?= client_logo($c) ?>
    <b><?= e($c['name']) ?></b>
    <small><?= e($c['country']) ?><?= $c['industry'] ? ' · ' . e($c['industry']) : '' ?></small>
  </div>
  <?php endforeach ?>
</div>
