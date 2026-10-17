<div class="cat">
  <?php foreach ($areas as $i => $s): ?>
  <a class="area reveal" style="--d:<?= $i % 4 ?>" href="<?= e(url('services/' . $s['slug'])) ?>">
    <?php if (trim((string)($s['image'] ?? '')) !== ''): ?><img src="<?= e(image_url($s['image'])) ?>" alt="" loading="lazy"><?php endif ?>
    <div class="in">
      <?php if ($s['tag']): ?><small><?= e($s['tag']) ?></small><?php endif ?>
      <h3><?= e($s['name']) ?></h3>
      <ul class="dots"><?php foreach (array_slice(lines((string)$s['do_items']), 0, 6) as $it): ?><li><?= e($it) ?></li><?php endforeach ?></ul>
    </div>
  </a>
  <?php endforeach ?>
</div>
