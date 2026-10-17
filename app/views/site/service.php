<?= view('partials/page-hero', ['crumbs' => ['What we do' => 'what-we-do', $svc['practice_name'] => 'what-we-do/' . $svc['practice_slug'], $svc['name'] => null], 'eyebrow' => $svc['practice_name'] . ($svc['tag'] ? ' · ' . $svc['tag'] : ''), 'heading' => $svc['name'], 'lead' => $svc['description'], 'accent' => $svc['practice_accent'], 'image' => $svc['image'] ?? '']) ?>
<section class="section">
  <div class="wrap svc-detail">
    <div class="svc-detail-main">
      <div class="detail-lists">
        <div class="detail-card reveal"><h2>What we do</h2><ul class="ticks"><?php foreach (lines($svc['do_items']) as $it): ?><li><?= icon('check') ?><?= e($it) ?></li><?php endforeach ?></ul></div>
        <div class="detail-card reveal" style="--d:1"><h2>What you get</h2><ul class="ticks"><?php foreach (lines($svc['get_items']) as $it): ?><li><?= icon('check') ?><?= e($it) ?></li><?php endforeach ?></ul></div>
      </div>
      <?php if ($svc['ideal']): ?><div class="ideal-box reveal"><h2>Ideal for</h2><p><?= e($svc['ideal']) ?></p></div><?php endif ?>
    </div>
    <aside class="price-card reveal" aria-label="Get started">
      <p class="kicker">Get started</p>
      <?php if (trim((string)$svc['price_amount']) !== ''): ?><p class="price price-xl"><?= price_html($svc) ?></p><?php else: ?><p class="price-cta">Tell us what you need and we'll send a proposal.</p><?php endif ?>
      <a class="btn btn-primary btn-block" href="<?= e(url('contact?service=' . rawurlencode($svc['name']))) ?>">Talk to us <?= icon('arrow') ?></a>
      <?php if (!empty($svc['external_url'])): ?><a class="btn btn-ghost btn-block" href="<?= e($svc['external_url']) ?>" target="_blank" rel="noopener">Learn more <?= icon('external') ?></a><?php endif ?>
      <ul class="mini-points"><li><?= icon('check') ?>Discovery call first</li><li><?= icon('check') ?>Written proposal and scope</li><li><?= icon('check') ?>Reply within one business day</li></ul>
    </aside>
  </div>
</section>
<?php if ($related): ?>
<section class="section section-tint">
  <div class="wrap">
    <div class="sec-head reveal"><p class="kicker">Related</p><h2>More in <?= e($svc['practice_name']) ?></h2></div>
    <?= view('partials/service-areas', ['areas' => $related]) ?>
  </div>
</section>
<?php endif ?>
<?= view('partials/cta-band', ['topic' => $svc['name']]) ?>
