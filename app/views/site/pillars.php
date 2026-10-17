<?php $words = array_values(array_filter(array_map('trim', explode('.', block('home_tagline', 'Run. Secure. Innovate.'))))); ?>
<?= view('partials/page-hero', ['crumbs' => ['What we do' => null], 'eyebrow' => block('home_tagline', 'Run. Secure. Innovate.'), 'heading' => block('pillars_title'), 'lead' => block('pillars_intro'), 'image' => 'photos/hero-managed-it.jpg']) ?>
<section class="section">
  <div class="wrap">
    <div class="core">
      <?php foreach (core_pillars() as $i => $p): ?>
      <a class="svc reveal" style="--d:<?= $i ?>" href="<?= e(url('what-we-do/' . $p['slug'])) ?>">
        <?php if (trim((string)($p['image'] ?? '')) !== ''): ?><img src="<?= e(image_url($p['image'])) ?>" alt="" loading="lazy"><?php endif ?>
        <div class="in">
          <?php if (isset($words[$i])): ?><p class="word"><?= e($words[$i]) ?></p><?php endif ?>
          <p class="label"><?= e($p['name']) ?></p>
          <h3><?= e($p['promise']) ?></h3>
          <ul class="ticks"><?php foreach ($p['services'] as $s): ?><li><?= icon('check') ?><?= e($s['name']) ?></li><?php endforeach ?></ul>
          <span class="more">Explore <?= icon('arrow', 'ico ico-xs') ?></span>
        </div>
      </a>
      <?php endforeach ?>
    </div>
  </div>
</section>
<?php foreach (array_filter($nav, fn($p) => !$p['is_core']) as $p): if (!$p['services']) continue; ?>
<section class="section section-tint">
  <div class="wrap">
    <div class="sec-head reveal"><p class="kicker"><?= e($p['name']) ?></p><h2><?= e($p['promise']) ?></h2><p class="lead"><?= e($p['intro']) ?></p></div>
    <?= view('partials/service-areas', ['areas' => $p['services']]) ?>
  </div>
</section>
<?php endforeach ?>
<?php if ($steps): ?>
<section class="section">
  <div class="wrap">
    <div class="sec-head reveal"><p class="kicker">How we work</p><h2>Start with one service, or combine several</h2><p class="lead">Most clients start with one service. Many combine several under one agreement.</p></div>
    <?= view('partials/steps', ['steps' => $steps]) ?>
  </div>
</section>
<?php endif ?>
<?= view('partials/cta-band') ?>
