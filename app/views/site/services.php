<?= view('partials/page-hero', ['crumbs' => ['Services' => null], 'eyebrow' => block('home_tagline', 'Run. Secure. Innovate.'), 'heading' => block('services_title'), 'lead' => block('services_intro'), 'image' => 'photos/hero-connectivity.jpg']) ?>
<nav class="practice-tabs wrap" aria-label="Service groups">
  <?php foreach ($nav as $p): if (!$p['services']) continue; ?><a href="#<?= e($p['slug']) ?>" style="--c:<?= accent_var($p['accent']) ?>"><?= practice_icon((string)$p['accent'], 'ico') ?><?= e($p['short_name'] ?: $p['name']) ?></a><?php endforeach ?>
</nav>
<?php $k = 0; foreach ($nav as $p): if (!$p['services']) continue; ?>
<section class="section<?= $k++ % 2 ? ' section-tint' : '' ?>" id="<?= e($p['slug']) ?>">
  <div class="wrap">
    <div class="sec-head reveal">
      <p class="kicker"><?= e($p['short_name'] ?: $p['name']) ?></p>
      <h2><?= e($p['name']) ?></h2>
      <p class="lead"><?= e($p['promise']) ?> <a class="text-link" href="<?= e(url('what-we-do/' . $p['slug'])) ?>">Overview <?= icon('arrow', 'ico ico-xs') ?></a></p>
    </div>
    <?= view('partials/service-areas', ['areas' => $p['services']]) ?>
  </div>
</section>
<?php endforeach ?>
<?= view('partials/cta-band') ?>
