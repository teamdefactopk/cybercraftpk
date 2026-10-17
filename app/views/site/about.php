<?php $timeline = pairs(block('about_timeline')); $values = pairs(block('about_values')); ?>
<?= view('partials/page-hero', ['crumbs' => ['Company' => null], 'eyebrow' => 'Company', 'heading' => block('about_title'), 'lead' => block('about_intro')]) ?>
<section class="section">
  <div class="wrap company">
    <div class="prose reveal"><?= md(block('about_body')) ?></div>
    <ol class="timeline reveal"><?php foreach ($timeline as [$y, $t]): ?><li><time><?= e($y) ?></time><p><?= e($t) ?></p></li><?php endforeach ?></ol>
  </div>
</section>
<section class="quote" id="ceo" aria-label="Message from the CEO">
  <div class="wrap">
    <div class="who"><div class="av" aria-hidden="true"><?= e(implode('', array_map(fn($w) => mb_substr($w, 0, 1), array_slice(preg_split('/\s+/', block('ceo_name', 'Tauseef Ahmed')) ?: [], 0, 2)))) ?></div><b><?= e(block('ceo_name')) ?></b><span><?= e(block('ceo_role')) ?></span></div>
    <blockquote><p class="big">"<?= e(block('ceo_quote')) ?>"</p><div class="rest"><?= md(block('ceo_message')) ?></div></blockquote>
  </div>
</section>
<section class="section">
  <div class="wrap">
    <div class="vm">
      <div class="reveal"><small>Vision</small><p><?= e(block('about_vision')) ?></p></div>
      <div class="reveal" style="--d:1"><small>Mission</small><p><?= e(block('about_mission')) ?></p></div>
    </div>
    <div class="values-grid">
      <?php foreach ($values as $i => [$v, $t]): ?><div class="reveal" style="--d:<?= $i % 3 ?>"><b><?= e($v) ?></b><p><?= e($t) ?></p></div><?php endforeach ?>
    </div>
  </div>
</section>
<section class="section section-tint" id="offices">
  <div class="wrap">
    <div class="sec-head reveal"><p class="kicker">Global presence</p><h2>Six countries, one 24/7 operations center</h2><p class="lead">Clients in every region work with a local point of contact, backed by our operations, security and engineering center in Lahore.</p></div>
    <?= view('partials/offices', ['offices' => $offices, 'full' => true]) ?>
  </div>
</section>
<section class="section">
  <div class="wrap two-col">
    <div class="reveal"><p class="kicker">Partnerships</p><h2>Joint ventures &amp; partners</h2></div>
    <div class="prose reveal"><?= md(block('about_partners')) ?><p><a class="text-link" href="<?= e(url('contact?service=' . rawurlencode('Partnership / JV'))) ?>">Become a partner <?= icon('arrow', 'ico ico-xs') ?></a></p></div>
  </div>
</section>
<?php if ($reasons): ?>
<section class="section section-tint">
  <div class="wrap">
    <div class="sec-head reveal"><p class="kicker">Why CyberCraft</p><h2><?= e(block('home_why_title')) ?></h2></div>
    <div class="why"><?php foreach ($reasons as $i => $r): ?><div class="reveal" style="--d:<?= $i % 5 ?>"><i><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></i><b><?= e($r['title']) ?></b><p><?= e($r['body']) ?></p></div><?php endforeach ?></div>
  </div>
</section>
<?php endif ?>
<?= view('partials/cta-band') ?>
