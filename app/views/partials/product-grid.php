<div class="prods">
  <?php foreach ($products as $i => $p): ?>
  <article class="prod reveal" id="<?= e($p['slug']) ?>" style="--d:<?= $i ?>">
    <?php if (trim((string)($p['image'] ?? '')) !== ''): ?><img src="<?= e(image_url($p['image'])) ?>" alt="" loading="lazy"><?php endif ?>
    <div class="in">
      <small><?= e($p['label']) ?></small>
      <h3><?= e($p['name']) ?></h3>
      <p><?= e($p['summary']) ?></p>
      <?php if (!empty($full) && trim((string)$p['description']) !== ''): ?><p><?= e($p['description']) ?></p><?php endif ?>
      <?php if (lines((string)$p['items'])): ?><ul class="chips"><?php foreach (lines($p['items']) as $it): ?><li><?= e($it) ?></li><?php endforeach ?></ul><?php endif ?>
      <?php if (!empty($p['external_url'])): ?><a class="more" href="<?= e($p['external_url']) ?>" target="_blank" rel="noopener">Visit <?= e(parse_url($p['external_url'], PHP_URL_HOST) ?: 'site') ?> <?= icon('external', 'ico ico-xs') ?></a><?php endif ?>
    </div>
  </article>
  <?php endforeach ?>
</div>
