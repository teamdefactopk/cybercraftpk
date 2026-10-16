<div class="tiers">
  <?php foreach ($levels as $i => $l): ?>
  <div class="tier reveal<?= $l['featured'] ? ' featured' : '' ?>" style="--d:<?= $i ?>">
    <?php if ($l['featured']): ?><span class="tier-flag">Most chosen</span><?php endif ?>
    <h3><?= e($l['name']) ?></h3>
    <p class="tier-for"><?= e($l['audience']) ?></p>
    <ul class="ticks"><?php foreach (lines($l['items']) as $it): ?><li><?= icon('check') ?><?= e($it) ?></li><?php endforeach ?></ul>
    <div class="tier-foot"><span class="price"><?= price_html($l) ?></span><a class="btn btn-ghost btn-sm" href="<?= e(url('contact?service=' . rawurlencode('Managed Services Provider'))) ?>">Let's talk</a></div>
  </div>
  <?php endforeach ?>
</div>
