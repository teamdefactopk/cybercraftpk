<?= view('partials/page-hero', ['crumbs' => ['Services' => null], 'eyebrow' => 'Services', 'heading' => block('services_title'), 'lead' => block('services_intro')]) ?>
<nav class="practice-tabs wrap" aria-label="Pillars">
  <?php foreach ($nav as $p): ?><a href="#<?= e($p['slug']) ?>" style="--c:<?= accent_var($p['accent']) ?>"><?= practice_icon((string)$p['accent'], 'ico') ?><?= e($p['short_name'] ?: $p['name']) ?></a><?php endforeach ?>
</nav>
<?php foreach ($nav as $i => $p): ?>
<section class="section<?= $i % 2 ? ' section-tint' : '' ?>" id="<?= e($p['slug']) ?>" style="--c:<?= accent_var($p['accent']) ?>">
  <div class="wrap">
    <div class="sec-head reveal">
      <div><p class="kicker" style="color:var(--c)"><?= e($p['short_name']) ?></p><h2><?= e($p['name']) ?></h2></div>
      <p class="lead"><?= e($p['promise']) ?> <a class="text-link" href="<?= e(url('what-we-do/' . $p['slug'])) ?>">Pillar overview <?= icon('arrow', 'ico ico-xs') ?></a></p>
    </div>
    <div class="svc-cards">
      <?php foreach ($p['services'] as $s): ?>
      <a class="svc-card reveal" href="<?= e(url('services/' . $s['slug'])) ?>">
        <span class="svc-tag"><?= e($s['tag']) ?></span>
        <h3><?= e($s['name']) ?></h3>
        <p><?= e($s['summary']) ?></p>
        <span class="go"><?= icon('arrow') ?></span>
      </a>
      <?php endforeach ?>
    </div>
  </div>
</section>
<?php endforeach ?>
<?= view('partials/cta-band') ?>
