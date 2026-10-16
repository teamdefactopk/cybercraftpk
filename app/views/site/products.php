<?= view('partials/page-hero', ['crumbs' => ['Products' => null], 'eyebrow' => 'Products & platforms', 'heading' => block('products_title'), 'lead' => block('products_intro')]) ?>
<section class="section"><div class="wrap"><?= view('partials/product-grid', ['products' => $products, 'full' => true]) ?></div></section>
<?= view('partials/cta-band', ['topic' => 'Products (CyberERP, b2cloud.io)']) ?>
