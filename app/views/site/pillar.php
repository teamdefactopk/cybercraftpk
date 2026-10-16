<?= view('partials/page-hero', ['crumbs' => ['What we do' => 'what-we-do', $pillar['short_name'] ?: $pillar['name'] => null], 'eyebrow' => $pillar['is_core'] ? 'Pillar · ' . $pillar['short_name'] : 'What we do', 'heading' => $pillar['name'], 'promise' => $pillar['promise'], 'motto' => $pillar['motto'], 'lead' => $pillar['intro'], 'accent' => $pillar['accent'], 'cta' => ['Talk to the ' . mb_strtolower($pillar['short_name'] ?: 'team') . ' team', 'contact?service=' . rawurlencode($pillar['name'])]]) ?>

<?php if ($pillar['accent'] === 'horizons' && $pillar['motto']): ?>
<section class="section section-tint">
  <div class="wrap">
    <div class="aii">
      <div class="reveal"><b>Adapt</b><p>Take proven global technology and fit it to local conditions, budgets, regulations and climates.</p></div>
      <div class="reveal" style="--d:1"><b>Innovate</b><p>Design new products and solutions in our lab, from embedded devices to AI and energy systems.</p></div>
      <div class="reveal" style="--d:2"><b>Improvise</b><p>Solve problems on the ground with what is available: power outages, remote sites, tight budgets and harsh environments.</p></div>
    </div>
  </div>
</section>
<?php endif ?>

<section class="section" style="--c:<?= accent_var($pillar['accent']) ?>">
  <div class="wrap">
    <div class="sec-head reveal"><div><p class="kicker" style="color:var(--c)">Services</p><h2>What we deliver</h2></div><?php if ($pillar['lead_product']): ?><p class="lead">Packaged as <b><?= e($pillar['lead_product']) ?></b>.</p><?php endif ?></div>
    <div class="svc-rows">
      <?php foreach ($pillar['services'] as $s): ?>
      <article class="svc-row reveal">
        <div class="svc-row-main">
          <span class="svc-tag"><?= e($s['tag']) ?></span>
          <h3><a href="<?= e(url('services/' . $s['slug'])) ?>"><?= e($s['name']) ?></a></h3>
          <p><?= e($s['description']) ?></p>
          <?php if ($s['ideal']): ?><p class="ideal"><b>Ideal for:</b> <?= e($s['ideal']) ?></p><?php endif ?>
          <a class="text-link" href="<?= e(url('services/' . $s['slug'])) ?>">Details <?= icon('arrow', 'ico ico-xs') ?></a>
        </div>
        <div class="svc-row-lists">
          <div><h4>What we do</h4><ul class="ticks"><?php foreach (lines($s['do_items']) as $it): ?><li><?= icon('check') ?><?= e($it) ?></li><?php endforeach ?></ul></div>
          <div><h4>What you get</h4><ul class="ticks"><?php foreach (lines($s['get_items']) as $it): ?><li><?= icon('check') ?><?= e($it) ?></li><?php endforeach ?></ul></div>
        </div>
      </article>
      <?php endforeach ?>
    </div>
  </div>
</section>

<?php if ($levels): ?>
<section class="section section-dark">
  <div class="wrap">
    <div class="sec-head reveal"><div><p class="kicker light">CyberCraft Care</p><h2>Choose how much you hand over</h2></div><p class="lead">Four managed-services plans, from a remote service desk to engineers on site full-time.</p></div>
    <?= view('partials/levels', ['levels' => $levels]) ?>
  </div>
</section>
<?php endif ?>

<?php if ($standards): ?>
<section class="section section-tint" id="standards">
  <div class="wrap">
    <div class="sec-head reveal"><div><p class="kicker">Standards &amp; regulations</p><h2>What we prepare you for</h2></div><p class="lead">International standards and the regional frameworks of every country we serve.</p></div>
    <div class="std-rows">
      <?php foreach ($standards as $st): ?><div class="std-row reveal"><b><?= e($st['region']) ?></b><ul class="chips"><?php foreach (lines($st['items']) as $it): ?><li><?= e($it) ?></li><?php endforeach ?></ul></div><?php endforeach ?>
    </div>
    <p class="note reveal">Independence: when CyberCraft both manages and audits a client's systems, the audit is performed by a separate team, and clients can request third-party validation.</p>
  </div>
</section>
<?php endif ?>

<?php if ($pillar['is_core']): ?>
<section class="section">
  <div class="wrap">
    <div class="sec-head reveal"><div><p class="kicker">By industry</p><h2><?= e($pillar['short_name']) ?> for your sector</h2></div></div>
    <div class="ind-table reveal"><table>
      <thead><tr><th>Industry</th><th><?= e($pillar['short_name']) ?></th></tr></thead>
      <tbody><?php $col = ['msp' => 'msp', 'audit' => 'audit', 'horizons' => 'horizons'][$pillar['accent']] ?? 'msp'; foreach ($industries as $ind): ?><tr><td><a href="<?= e(url('industries/' . $ind['slug'])) ?>"><?= e($ind['name']) ?></a></td><td><?= e($ind[$col]) ?></td></tr><?php endforeach ?></tbody>
    </table></div>
  </div>
</section>
<?php endif ?>

<?php if ($cases): ?>
<section class="section section-tint">
  <div class="wrap">
    <div class="sec-head reveal"><div><p class="kicker">Case studies</p><h2>In practice</h2></div></div>
    <?= view('partials/case-cards', ['cases' => $cases, 'full' => true]) ?>
  </div>
</section>
<?php endif ?>

<?= view('partials/cta-band', ['topic' => $pillar['name']]) ?>
