<?php $showSample = setting('show_sample_badges', '0') === '1' && (array_filter($clients, fn($c) => $c['is_sample']) || array_filter($cases, fn($c) => $c['is_sample'])); ?>
<?= view('partials/page-hero', ['crumbs' => ['Clients' => null], 'eyebrow' => 'Clients', 'heading' => block('clients_title'), 'lead' => block('clients_intro')]) ?>
<section class="section">
  <div class="wrap">
    <?php if ($showSample): ?><p class="note reveal"><span class="sample">Sample</span> Names and logos marked as samples are placeholders. Replace them in the dashboard under Clients and Case studies, with each client's permission.</p><?php endif ?>
    <?php foreach (COUNTRY_NAMES as $code => $country): $list = array_values(array_filter($clients, fn($c) => $c['country'] === $code)); if (!$list) continue; ?>
    <div class="country-block reveal"><h2><span><?= e($code) ?></span><?= e($country) ?></h2><?= view('partials/client-wall', ['clients' => $list]) ?></div>
    <?php endforeach ?>
    <?php $rest = array_values(array_filter($clients, fn($c) => !isset(COUNTRY_NAMES[$c['country']]))); if ($rest): ?><div class="country-block reveal"><h2>International</h2><?= view('partials/client-wall', ['clients' => $rest]) ?></div><?php endif ?>
  </div>
</section>
<?php if ($cases): ?>
<section class="section section-tint">
  <div class="wrap">
    <div class="sec-head reveal"><p class="kicker">Case studies</p><h2>Results for our clients</h2></div>
    <?= view('partials/case-cards', ['cases' => $cases, 'full' => true]) ?>
  </div>
</section>
<?php endif ?>
<?= view('partials/cta-band') ?>
