<?= view('partials/page-hero', ['crumbs' => ['Industries' => 'industries', $ind['name'] => null], 'eyebrow' => 'Industry', 'heading' => $ind['name'], 'lead' => trim((string)$ind['intro']) !== '' ? $ind['intro'] : $ind['summary']]) ?>
<section class="section">
  <div class="wrap">
    <div class="sec-head reveal"><div><p class="kicker">How we help</p><h2>Three pillars for <?= e(mb_strtolower($ind['name'])) ?></h2></div></div>
    <div class="ind-pillars">
      <?php foreach (core_pillars() as $i => $p): $col = ['msp' => 'msp', 'audit' => 'audit', 'horizons' => 'horizons'][$p['accent']] ?? 'msp'; ?>
      <a class="ind-pillar reveal" style="--c:<?= accent_var($p['accent']) ?>;--d:<?= $i ?>" href="<?= e(url('what-we-do/' . $p['slug'])) ?>">
        <span class="ip-ico"><?= practice_icon((string)$p['accent']) ?></span>
        <small><?= e($p['short_name']) ?></small>
        <h3><?= e($ind[$col] ?: $p['summary']) ?></h3>
        <p><?= e($p['promise']) ?></p>
        <span class="more">Explore <?= icon('arrow', 'ico ico-xs') ?></span>
      </a>
      <?php endforeach ?>
    </div>
  </div>
</section>
<?php if ($clients): ?>
<section class="section section-tint">
  <div class="wrap">
    <div class="sec-head reveal"><div><p class="kicker">Clients in <?= e(mb_strtolower($ind['name'])) ?></p><h2>Who we work with<?= array_filter($clients, fn($c) => $c['is_sample']) && setting('show_sample_badges', '1') === '1' ? ' <span class="sample">Sample</span>' : '' ?></h2></div></div>
    <?= view('partials/client-wall', ['clients' => $clients]) ?>
  </div>
</section>
<?php endif ?>
<section class="section">
  <div class="wrap">
    <div class="sec-head reveal"><div><p class="kicker">Other industries</p><h2>Explore more sectors</h2></div></div>
    <div class="chips links reveal"><?php foreach ($others as $o): if ($o['id'] === $ind['id']) continue; ?><a href="<?= e(url('industries/' . $o['slug'])) ?>"><?= e($o['name']) ?></a><?php endforeach ?></div>
  </div>
</section>
<?= view('partials/cta-band', ['topic' => 'Something else']) ?>
