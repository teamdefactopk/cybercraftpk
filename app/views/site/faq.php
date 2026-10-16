<?= view('partials/page-hero', ['crumbs' => ['FAQ' => null], 'eyebrow' => 'FAQ', 'heading' => 'Frequently asked questions', 'lead' => 'Quick answers about our pillars, standards and regions. Can\'t find yours? Ask us.']) ?>
<section class="section">
  <div class="wrap narrow">
    <div class="faq">
      <?php foreach ($faqs as $i => $f): ?>
      <details class="reveal"<?= $i === 0 ? ' open' : '' ?>><summary><?= e($f['question']) ?><span class="faq-ico"><?= icon('plus') ?></span></summary><div class="faq-a"><?= md($f['answer']) ?></div></details>
      <?php endforeach ?>
    </div>
  </div>
</section>
<?= view('partials/cta-band') ?>
