<?= view('partials/page-hero', ['crumbs' => ['Search' => null], 'eyebrow' => 'Search', 'heading' => $q !== '' ? 'Results for "' . $q . '"' : 'Search the site']) ?>
<section class="section">
  <div class="wrap narrow">
    <form class="inline-search light" action="<?= e(url('search')) ?>" method="get" role="search"><label class="sr" for="q2">Search</label><input id="q2" name="q" type="search" value="<?= e($q) ?>" placeholder="Search services, industries, standards…" minlength="2" required><button class="btn btn-primary" type="submit">Search</button></form>
    <?php if ($q !== '' && mb_strlen($q) < 2): ?>
      <p class="muted">Enter at least two characters.</p>
    <?php elseif ($q !== ''): ?>
      <p class="muted"><?= count($results) ?> result<?= count($results) === 1 ? '' : 's' ?></p>
      <?php if (!$results): ?>
        <div class="empty"><h2>No matches</h2><p>Try a broader term such as "audit", "managed" or "solar", or <a href="<?= e(url('contact')) ?>">ask our team</a>.</p></div>
      <?php endif ?>
      <ul class="results"><?php foreach ($results as $r): ?>
        <li><a href="<?= e($r['url']) ?>"><span class="svc-tag"><?= e($r['type']) ?></span><h2><?= e($r['title']) ?></h2><?php if ($r['text']): ?><p><?= e(mb_strimwidth(strip_tags((string)$r['text']), 0, 200, '…')) ?></p><?php endif ?></a></li>
      <?php endforeach ?></ul>
    <?php endif ?>
  </div>
</section>
