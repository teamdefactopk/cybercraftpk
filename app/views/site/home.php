<?php
$pillars = core_pillars();
$stats = pairs(setting('stats'));
$words = array_values(array_filter(array_map('trim', explode('.', block('home_tagline', 'Run. Secure. Innovate.')))));
$showSample = setting('show_sample_badges', '1') === '1' && array_filter($clients, fn($c) => $c['is_sample']);
$auditPhoto = 'photos/audit-compliance.jpg';
foreach ($areas as $a) {
    if ($a['slug'] === 'audit-compliance' && trim((string)$a['image']) !== '') $auditPhoto = $a['image'];
}
?>
<section class="hero" aria-roledescription="carousel" aria-label="What CyberCraft does" data-carousel>
  <div class="slides">
    <?php foreach ($slides as $i => $s): ?>
    <div class="slide<?= $i === 0 ? ' on' : '' ?>" role="group" aria-roledescription="slide" aria-label="<?= $i + 1 ?> of <?= count($slides) ?>: <?= e($s['title']) ?>">
      <?php if (trim((string)$s['image']) !== ''): ?><img src="<?= e(image_url($s['image'])) ?>" alt=""<?= $i === 0 ? ' fetchpriority="high"' : ' loading="lazy"' ?>><?php endif ?>
    </div>
    <?php endforeach ?>
  </div>
  <div class="wrap">
    <div class="copy">
      <?php if ($words): ?><p class="tagline"><?php foreach ($words as $w): ?><span><?= e($w) ?>.</span><?php endforeach ?></p><?php endif ?>
      <p class="label"><?= e(block('home_label')) ?></p>
      <h1><?= e(block('home_headline')) ?></h1>
      <p class="sub"><?= e(block('home_sub')) ?></p>
      <div class="hero-ctas">
        <a class="btn btn-white" href="<?= e(url('contact')) ?>"><?= e(block('home_cta_primary', 'Get a free consultation')) ?> <?= icon('arrow') ?></a>
        <a class="btn btn-line" href="#all-services"><?= e(block('home_cta_secondary', 'See all services')) ?></a>
      </div>
    </div>
    <?php if (count($slides) > 1): ?>
    <div class="slide-tabs" role="group" aria-label="Choose a line of work" style="--n:<?= count($slides) ?>">
      <?php foreach ($slides as $i => $s): ?>
      <button class="slide-tab" type="button" aria-pressed="<?= $i === 0 ? 'true' : 'false' ?>" data-slide="<?= $i ?>"><b><?= e($s['title']) ?></b><?php if ($s['subtitle']): ?><span><?= e($s['subtitle']) ?></span><?php endif ?></button>
      <?php endforeach ?>
    </div>
    <?php endif ?>
  </div>
</section>

<?php if ($stats): ?>
<section class="stats" aria-label="CyberCraft in numbers">
  <div class="wrap" style="--n:<?= count($stats) ?>"><?php foreach ($stats as [$n, $l]): ?><div><b><?= e($n) ?></b><span><?= e($l) ?></span></div><?php endforeach ?></div>
</section>
<?php endif ?>

<section class="section section-tint" id="industries">
  <div class="wrap">
    <div class="sec-head reveal">
      <p class="kicker">Industries we serve</p>
      <h2><?= e(block('home_industries_title')) ?></h2>
      <p class="lead"><?= e(block('home_industries_intro')) ?></p>
    </div>
    <?= view('partials/industry-grid', ['industries' => $industries]) ?>
  </div>
</section>

<section class="section" id="services">
  <div class="wrap">
    <div class="sec-head reveal">
      <p class="kicker">What we do</p>
      <h2><?= e(block('home_pillars_title')) ?></h2>
      <p class="lead"><?= e(block('home_pillars_intro')) ?></p>
    </div>
    <div class="core">
      <?php foreach ($pillars as $i => $p): ?>
      <a class="svc reveal" style="--d:<?= $i ?>" href="<?= e(url('what-we-do/' . $p['slug'])) ?>">
        <?php if (trim((string)$p['image']) !== ''): ?><img src="<?= e(image_url($p['image'])) ?>" alt="" loading="lazy"><?php endif ?>
        <div class="in">
          <?php if (isset($words[$i])): ?><p class="word"><?= e($words[$i]) ?></p><?php endif ?>
          <p class="label"><?= e($p['name']) ?></p>
          <h3><?= e($p['promise']) ?></h3>
          <?php $hl = lines((string)$p['highlights']); if ($hl): ?>
          <ul class="ticks"><?php foreach ($hl as $h): ?><li><?= icon('check') ?><?= e($h) ?></li><?php endforeach ?></ul>
          <?php endif ?>
          <span class="more"><?= e($p['short_name'] ?: $p['name']) ?> <?= icon('arrow', 'ico ico-xs') ?></span>
        </div>
      </a>
      <?php endforeach ?>
    </div>
  </div>
</section>

<?php if ($areas): ?>
<section class="section section-tint" id="all-services">
  <div class="wrap">
    <div class="sec-head reveal">
      <p class="kicker">All services</p>
      <h2><?= e(block('home_areas_title')) ?></h2>
      <p class="lead"><?= e(block('home_areas_intro')) ?></p>
    </div>
    <?= view('partials/service-areas', ['areas' => $areas]) ?>
    <div class="help reveal"><p>Not sure which service you need? Describe the problem and we'll recommend the right one.</p><a class="btn btn-primary" href="<?= e(url('contact')) ?>">Ask an expert <?= icon('arrow') ?></a></div>
  </div>
</section>
<?php endif ?>

<?php if ($levels): ?>
<section class="section" id="plans">
  <div class="wrap">
    <div class="sec-head reveal">
      <p class="kicker">Managed IT service plans</p>
      <h2><?= e(block('home_plans_title')) ?></h2>
      <p class="lead"><?= e(block('home_plans_intro')) ?></p>
    </div>
    <?= view('partials/levels', ['levels' => $levels]) ?>
  </div>
</section>
<?php endif ?>

<?php if ($standards): ?>
<section class="section section-tint" id="compliance">
  <div class="wrap split">
    <div class="reveal">
      <p class="kicker">Compliance &amp; audit</p>
      <h2><?= e(block('home_compliance_title')) ?></h2>
      <p class="lead"><?= e(block('home_compliance_intro')) ?></p>
      <div class="regions">
        <?php foreach ($standards as $st): ?><div class="region"><b><?= e($st['region']) ?></b><ul class="chips"><?php foreach (lines($st['items']) as $it): ?><li><?= e($it) ?></li><?php endforeach ?></ul></div><?php endforeach ?>
      </div>
    </div>
    <figure class="reveal" style="--d:1"><img src="<?= e(image_url($auditPhoto)) ?>" alt="Consultants reviewing audit findings in a meeting" loading="lazy"></figure>
  </div>
</section>
<?php endif ?>

<?php if ($steps): ?>
<section class="section" id="how">
  <div class="wrap">
    <div class="sec-head reveal"><p class="kicker">How we work</p><h2>From first call to running service in <?= count($steps) ?> steps.</h2></div>
    <?= view('partials/steps', ['steps' => $steps]) ?>
  </div>
</section>
<?php endif ?>

<?php if ($products): ?>
<section class="section section-tint" id="products">
  <div class="wrap">
    <div class="sec-head reveal"><p class="kicker">Our products</p><h2><?= e(block('home_products_title')) ?></h2></div>
    <?= view('partials/product-grid', ['products' => $products]) ?>
  </div>
</section>
<?php endif ?>

<?php if ($clients): ?>
<section class="section" id="clients">
  <div class="wrap">
    <div class="sec-head reveal">
      <p class="kicker">Clients</p>
      <h2><?= e(block('home_clients_title')) ?><?= $showSample ? ' <span class="sample">Sample</span>' : '' ?></h2>
      <p class="lead"><?= $showSample ? 'These names are placeholders until real client logos are added in the dashboard.' : e(block('clients_intro')) ?></p>
    </div>
    <?= view('partials/client-wall', ['clients' => array_slice($clients, 0, 12)]) ?>
    <p class="reveal" style="margin-top:24px"><a class="text-link" href="<?= e(url('clients')) ?>">All clients and case studies <?= icon('arrow', 'ico ico-xs') ?></a></p>
  </div>
</section>
<?php endif ?>

<section class="quote" aria-label="Message from the CEO">
  <div class="wrap">
    <div class="who"><div class="av" aria-hidden="true"><?= e(implode('', array_map(fn($w) => mb_substr($w, 0, 1), array_slice(preg_split('/\s+/', block('ceo_name', 'Tauseef Ahmed')) ?: [], 0, 2)))) ?></div><b><?= e(block('ceo_name')) ?></b><span><?= e(block('ceo_role')) ?></span></div>
    <blockquote>
      <p class="big">"<?= e(block('ceo_quote')) ?>"</p>
      <a class="text-link" href="<?= e(url('about#ceo')) ?>">Read the full message <?= icon('arrow', 'ico ico-xs') ?></a>
    </blockquote>
  </div>
</section>

<?php if ($offices): ?>
<section class="section" id="company">
  <div class="wrap">
    <div class="sec-head reveal">
      <p class="kicker">Where we are</p>
      <h2>Headquartered in Lahore, with a presence in <?= count($offices) ?> countries.</h2>
      <p class="lead">Our Lahore delivery center runs the 24/7 NOC and SOC. Local teams and JV partners support clients in the Gulf, Europe and North America.</p>
    </div>
    <?= view('partials/offices', ['offices' => $offices]) ?>
  </div>
</section>
<?php endif ?>

<?= view('partials/cta-band') ?>
