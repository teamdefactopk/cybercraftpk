<div class="prods">
  <?php foreach ($products as $i => $p): ?>
  <article class="prod reveal" id="<?= e($p['slug']) ?>" style="--c:<?= accent_var($p['accent']) ?>;--d:<?= $i ?>">
    <span class="bar"></span>
    <small><?= e($p['label']) ?></small>
    <h3><?= e($p['name']) ?></h3>
    <p><?= e($p['summary']) ?></p>
    <?php if (!empty($full) && trim((string)$p['description']) !== ''): ?><p><?= e($p['description']) ?></p><?php endif ?>
    <ul><?php foreach (lines($p['items']) as $it): ?><li><?= e($it) ?></li><?php endforeach ?></ul>
    <?php if (!empty($p['external_url'])): ?><a class="more" href="<?= e($p['external_url']) ?>" target="_blank" rel="noopener">Visit <?= e(parse_url($p['external_url'], PHP_URL_HOST) ?: 'site') ?> <?= icon('external', 'ico ico-xs') ?></a><?php endif ?>
  </article>
  <?php endforeach ?>
</div>
