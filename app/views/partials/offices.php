<div class="world">
  <?php foreach ($offices as $i => $o): ?>
  <div class="city reveal<?= $o['is_hq'] ? ' hq' : '' ?>" style="--d:<?= $i ?>">
    <small><?= e($o['code']) ?><?= $o['is_hq'] ? ' · HQ' : '' ?></small>
    <h3><?= e($o['city'] ?: $o['country']) ?></h3>
    <p class="city-country"><?= e($o['country']) ?> · <?= e($o['region']) ?></p>
    <?php if (!empty($full)): ?>
      <p><?= e($o['description']) ?></p>
      <p class="addr"><?= icon('pin', 'ico ico-xs') ?><?= trim((string)$o['address']) !== '' ? nl2br(e($o['address'])) : '<em>Address coming soon</em>' ?></p>
      <?php if (trim((string)$o['phone']) !== ''): ?><p class="addr"><?= icon('phone', 'ico ico-xs') ?><?= e($o['phone']) ?></p><?php endif ?>
      <?php if (trim((string)$o['email']) !== ''): ?><p class="addr"><?= icon('mail', 'ico ico-xs') ?><a href="mailto:<?= e($o['email']) ?>"><?= e($o['email']) ?></a></p><?php endif ?>
    <?php else: ?>
      <p><?= e($o['description']) ?></p>
    <?php endif ?>
  </div>
  <?php endforeach ?>
</div>
