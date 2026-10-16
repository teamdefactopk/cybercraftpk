<?= view('partials/page-hero', ['crumbs' => ['Careers' => null], 'eyebrow' => 'Careers', 'heading' => block('careers_title'), 'lead' => block('careers_intro'), 'cta' => ['Apply now', 'contact?service=Careers']]) ?>
<section class="section"><div class="wrap narrow prose reveal"><?= md(block('careers_body')) ?></div></section>
<?= view('partials/cta-band', ['topic' => 'Careers']) ?>
