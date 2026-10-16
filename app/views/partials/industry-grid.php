<div class="inds">
  <?php foreach ($industries as $i => $ind): ?>
  <a class="ind reveal" style="--d:<?= $i % 4 ?>" href="<?= e(url('industries/' . $ind['slug'])) ?>">
    <?= icon($ind['icon'] ?: 'grid', 'ico ind-ico') ?>
    <h3><?= e($ind['name']) ?></h3>
    <p><?= e($ind['summary']) ?></p>
    <span class="more">Explore <?= icon('arrow', 'ico ico-xs') ?></span>
  </a>
  <?php endforeach ?>
</div>
