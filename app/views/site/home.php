<?php
$pillars = core_pillars();
$titleWords = lines(block('home_title', "Run.\nSecure.\nInvent."));
$stats = pairs(setting('stats'));
$showSample = setting('show_sample_badges', '1') === '1' && array_filter($clients, fn($c) => $c['is_sample']);
?>
<section class="hero">
  <canvas class="net" aria-hidden="true"></canvas>
  <div class="wrap">
    <p class="kicker rise"><?= e(block('home_eyebrow')) ?></p>
    <h1 class="rise d1"><?php foreach ($titleWords as $i => $w): ?><span class="w<?= $i % 3 + 1 ?>"><?= e($w) ?></span><?php endforeach ?></h1>
    <p class="lead rise d2"><?= e(block('home_intro')) ?></p>
    <div class="hero-ctas rise d3">
      <a class="btn btn-light" href="<?= e(url('contact')) ?>"><?= e(block('home_cta_primary', 'Talk to us')) ?> <?= icon('arrow') ?></a>
      <a class="btn btn-outline-light" href="<?= e(url('what-we-do')) ?>"><?= e(block('home_cta_secondary', 'Explore what we do')) ?></a>
    </div>
    <ul class="hero-meta rise d4"><?php foreach (lines(block('home_meta')) as $m): ?><li><?= e($m) ?></li><?php endforeach ?></ul>
  </div>
</section>

<?php if ($stats): ?>
<section class="numbers" aria-label="CyberCraft in numbers">
  <div class="wrap"><?php foreach ($stats as [$n, $l]): ?><div class="num"><b><?= e($n) ?></b><span><?= e($l) ?></span></div><?php endforeach ?></div>
</section>
<?php endif ?>

<section class="section" id="pillars">
  <div class="wrap">
    <div class="sec-head reveal">
      <div><p class="kicker">What we do</p><h2><?= e(block('home_pillars_title')) ?></h2></div>
      <p class="lead"><?= e(block('home_pillars_intro')) ?></p>
    </div>
    <div class="panels">
      <?php foreach ($pillars as $i => $p): ?>
      <a class="panel reveal" style="--d:<?= $i ?>" href="<?= e(url('what-we-do/' . $p['slug'])) ?>">
        <?= pillar_art((string)$p['accent']) ?>
        <span class="no"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?> · <?= e($p['short_name']) ?></span>
        <h3><?= e($p['name']) ?></h3>
        <p class="promise"><?= e($p['promise']) ?></p>
        <?php if ($p['motto']): ?><p class="motto"><?= e($p['motto']) ?></p><?php endif ?>
        <span class="go">Explore <?= e(mb_strtolower($p['short_name'])) ?></span>
      </a>
      <?php endforeach ?>
    </div>
  </div>
</section>

<section class="section section-tint" id="industries">
  <div class="wrap">
    <div class="sec-head reveal">
      <div><p class="kicker">Sectors &amp; industries</p><h2><?= e(block('home_industries_title')) ?></h2></div>
      <p class="lead"><?= e(block('home_industries_intro')) ?></p>
    </div>
    <?= view('partials/industry-grid', ['industries' => $industries]) ?>
  </div>
</section>

<section class="section" id="services">
  <div class="wrap">
    <div class="sec-head reveal">
      <div><p class="kicker">Services</p><h2><?= e(block('home_services_title')) ?></h2></div>
      <p class="lead">Choose a pillar to see what we deliver.</p>
    </div>
    <div class="tabs" role="tablist" aria-label="Service pillars">
      <?php foreach ($pillars as $i => $p): ?>
      <button class="tab" type="button" role="tab" id="t-<?= e($p['slug']) ?>" aria-controls="p-<?= e($p['slug']) ?>" aria-selected="<?= $i ? 'false' : 'true' ?>"<?= $i ? ' tabindex="-1"' : '' ?>><?= e($p['short_name']) ?></button>
      <?php endforeach ?>
    </div>
    <?php foreach ($pillars as $i => $p): ?>
    <div class="tabpanel" role="tabpanel" id="p-<?= e($p['slug']) ?>" aria-labelledby="t-<?= e($p['slug']) ?>" style="--c:<?= accent_var($p['accent']) ?>"<?= $i ? ' hidden' : '' ?>>
      <div class="tp-intro">
        <p class="kicker" style="color:var(--c)">Pillar <?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></p>
        <h3><?= e($p['name']) ?></h3>
        <p class="promise"><?= e($p['promise']) ?><?= $p['motto'] ? ' ' . e($p['motto']) . '.' : '' ?></p>
        <p><?= e($p['intro']) ?></p>
        <?php if ($p['lead_product']): ?><div class="badge-prod"><small>Lead product</small><b><?= e($p['lead_product']) ?></b></div><?php endif ?>
        <a class="text-link" href="<?= e(url('what-we-do/' . $p['slug'])) ?>">All about <?= e(mb_strtolower($p['short_name'])) ?> <?= icon('arrow', 'ico ico-xs') ?></a>
      </div>
      <div class="tp-grid">
        <?php foreach ($p['services'] as $s): ?>
        <a href="<?= e(url('services/' . $s['slug'])) ?>"><h4><?= e($s['name']) ?></h4><p><?= e($s['summary']) ?></p></a>
        <?php endforeach ?>
      </div>
    </div>
    <?php endforeach ?>
    <?php $sup = array_values(array_filter($nav, fn($p) => !$p['is_core'])); if ($sup): ?>
    <div class="support reveal">
      <?php foreach ($sup[0]['services'] as $s): ?>
      <a href="<?= e(url('services/' . $s['slug'])) ?>"><h4><?= e($s['name']) ?></h4><p><?= e($s['summary']) ?></p></a>
      <?php endforeach ?>
    </div>
    <?php endif ?>
  </div>
</section>

<section class="section section-tint" id="products">
  <div class="wrap">
    <div class="sec-head reveal">
      <div><p class="kicker">Products &amp; platforms</p><h2><?= e(block('home_products_title')) ?></h2></div>
      <p class="lead"><?= e(block('products_intro')) ?></p>
    </div>
    <?= view('partials/product-grid', ['products' => $products]) ?>
  </div>
</section>

<?= view('partials/standards-marquee', ['standards' => $standards]) ?>

<?php if ($clients || $cases): ?>
<section class="section" id="clients">
  <div class="wrap">
    <div class="sec-head reveal">
      <div><p class="kicker">Clients</p><h2><?= e(block('home_clients_title')) ?><?= $showSample ? ' <span class="sample">Sample</span>' : '' ?></h2></div>
      <p class="lead"><?= $showSample ? 'Every name and logo here is a placeholder, grouped by the countries we serve, until real clients are added in the dashboard.' : e(block('clients_intro')) ?></p>
    </div>
    <?= view('partials/client-wall', ['clients' => $clients]) ?>
    <?= view('partials/case-cards', ['cases' => array_slice($cases, 0, 4)]) ?>
  </div>
</section>
<?php endif ?>

<section class="quote" aria-label="Message from the CEO">
  <div class="wrap">
    <div class="who"><div class="av" aria-hidden="true"><?= e(implode('', array_map(fn($w) => mb_substr($w, 0, 1), array_slice(preg_split('/\s+/', block('ceo_name', 'Tauseef Ahmed')) ?: [], 0, 2)))) ?></div><b><?= e(block('ceo_name')) ?></b><span><?= e(block('ceo_role')) ?></span></div>
    <blockquote>
      <p class="big">"<?= e(block('ceo_quote')) ?>"</p>
      <a class="text-link light" href="<?= e(url('about#ceo')) ?>">Read the full message <?= icon('arrow', 'ico ico-xs') ?></a>
    </blockquote>
  </div>
</section>

<section class="section" id="company">
  <div class="wrap">
    <div class="sec-head reveal">
      <div><p class="kicker">Company</p><h2><?= e(block('about_title')) ?></h2></div>
      <p class="lead"><?= e(block('about_intro')) ?></p>
    </div>
    <?= view('partials/offices', ['offices' => $offices]) ?>
    <p class="reveal" style="margin-top:32px"><a class="text-link" href="<?= e(url('about')) ?>">About CyberCraft <?= icon('arrow', 'ico ico-xs') ?></a></p>
  </div>
</section>

<?php if ($reasons): ?>
<section class="section section-tint" id="why">
  <div class="wrap">
    <div class="sec-head reveal"><div><p class="kicker">Why CyberCraft</p><h2><?= e(block('home_why_title')) ?></h2></div></div>
    <div class="why">
      <?php foreach ($reasons as $i => $r): ?><div class="reveal" style="--d:<?= $i % 5 ?>"><i><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></i><b><?= e($r['title']) ?></b><p><?= e($r['body']) ?></p></div><?php endforeach ?>
    </div>
  </div>
</section>
<?php endif ?>

<section class="careers-band">
  <div class="wrap">
    <div><h2><?= e(block('careers_title')) ?></h2><p><?= e(block('careers_intro')) ?></p></div>
    <a class="btn btn-light" href="<?= e(url('careers')) ?>">Join CyberCraft <?= icon('arrow') ?></a>
  </div>
</section>

<?= view('partials/cta-band') ?>
