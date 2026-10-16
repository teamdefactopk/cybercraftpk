<?= view('partials/page-hero', ['crumbs' => ['What we do' => null], 'eyebrow' => 'What we do', 'heading' => block('pillars_title'), 'lead' => block('pillars_intro')]) ?>
<section class="section">
  <div class="wrap">
    <div class="panels">
      <?php foreach (core_pillars() as $i => $p): ?>
      <a class="panel reveal" style="--d:<?= $i ?>" href="<?= e(url('what-we-do/' . $p['slug'])) ?>">
        <?= pillar_art((string)$p['accent']) ?>
        <span class="no"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?> · <?= e($p['short_name']) ?></span>
        <h3><?= e($p['name']) ?></h3>
        <p class="promise"><?= e($p['promise']) ?></p>
        <?php if ($p['motto']): ?><p class="motto"><?= e($p['motto']) ?></p><?php endif ?>
        <span class="go">Explore</span>
      </a>
      <?php endforeach ?>
    </div>
  </div>
</section>
<?php if ($steps): ?>
<section class="section section-tint">
  <div class="wrap">
    <div class="sec-head reveal"><div><p class="kicker">How we engage</p><h2>Start with one service, or combine all three</h2></div><p class="lead">Most clients start with one service. Many combine all three under one agreement.</p></div>
    <?= view('partials/steps', ['steps' => $steps]) ?>
  </div>
</section>
<?php endif ?>
<?php foreach (array_filter($nav, fn($p) => !$p['is_core']) as $p): ?>
<section class="section">
  <div class="wrap">
    <div class="sec-head reveal"><div><p class="kicker"><?= e($p['name']) ?></p><h2><?= e($p['promise']) ?></h2></div><p class="lead"><?= e($p['intro']) ?></p></div>
    <div class="support"><?php foreach ($p['services'] as $s): ?><a href="<?= e(url('services/' . $s['slug'])) ?>"><h4><?= e($s['name']) ?></h4><p><?= e($s['summary']) ?></p></a><?php endforeach ?></div>
  </div>
</section>
<?php endforeach ?>
<?= view('partials/cta-band') ?>
