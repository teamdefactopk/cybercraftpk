<div class="cases">
  <?php foreach ($cases as $i => $c):
    $acc = stripos((string)$c['pillar'], 'managed') !== false ? 'msp' : (stripos((string)$c['pillar'], 'compliance') !== false ? 'audit' : (stripos((string)$c['pillar'], 'horizons') !== false ? 'horizons' : 'support')); ?>
  <article class="case reveal" style="--c:<?= accent_var($acc) ?>;--d:<?= $i % 4 ?>">
    <small><?= e($c['pillar']) ?><?= $c['country'] ? ' · ' . e($c['country']) : '' ?></small>
    <h3><?= e($c['client']) ?><?= sample_badge($c) ?></h3>
    <p class="case-title"><?= e($c['title']) ?></p>
    <?php if (!empty($full)): ?>
      <dl><dt>Challenge</dt><dd><?= e($c['challenge']) ?></dd><dt>Solution</dt><dd><?= e($c['solution']) ?></dd></dl>
    <?php else: ?>
      <p><?= e($c['challenge']) ?> <?= e($c['solution']) ?></p>
    <?php endif ?>
    <p class="res"><?= e($c['result']) ?></p>
  </article>
  <?php endforeach ?>
</div>
