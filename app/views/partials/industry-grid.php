<div class="inds">
  <?php foreach ($industries as $i => $ind): ?>
  <a class="ind reveal" style="--d:<?= $i % 4 ?>" href="<?= e(url('industries/' . $ind['slug'])) ?>">
    <?php if (trim((string)($ind['image'] ?? '')) !== ''): ?><img src="<?= e(image_url($ind['image'])) ?>" alt="" loading="lazy"><?php else: ?><span class="noimg"><?= icon($ind['icon'] ?: 'grid') ?></span><?php endif ?>
    <span class="in"><h3><?= e($ind['name']) ?></h3><p><?= e($ind['summary']) ?></p></span>
  </a>
  <?php endforeach ?>
</div>
