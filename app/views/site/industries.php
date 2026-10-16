<?= view('partials/page-hero', ['crumbs' => ['Industries' => null], 'eyebrow' => 'Sectors & industries', 'heading' => block('industries_title'), 'lead' => block('industries_intro')]) ?>
<section class="section"><div class="wrap"><?= view('partials/industry-grid', ['industries' => $industries]) ?></div></section>
<section class="section section-tint">
  <div class="wrap">
    <div class="sec-head reveal"><div><p class="kicker">At a glance</p><h2>Each pillar, applied to each sector</h2></div></div>
    <div class="ind-table reveal"><table>
      <thead><tr><th>Industry</th><th>Managed services</th><th>Compliance &amp; audit</th><th>Horizons</th></tr></thead>
      <tbody><?php foreach ($industries as $i): ?><tr><td><a href="<?= e(url('industries/' . $i['slug'])) ?>"><?= e($i['name']) ?></a></td><td><?= e($i['msp']) ?></td><td><?= e($i['audit']) ?></td><td><?= e($i['horizons']) ?></td></tr><?php endforeach ?></tbody>
    </table></div>
  </div>
</section>
<?= view('partials/cta-band') ?>
