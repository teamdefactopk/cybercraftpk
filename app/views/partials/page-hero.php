<section class="page-hero"<?= !empty($accent) ? ' style="--c:' . accent_var($accent) . '"' : '' ?>>
  <canvas class="net" aria-hidden="true"></canvas>
  <div class="wrap">
    <?php if (!empty($crumbs)): ?>
    <nav class="crumbs" aria-label="Breadcrumb"><a href="<?= e(url('/')) ?>">Home</a><?php foreach ($crumbs as $label => $href): ?><span aria-hidden="true">/</span><?php if ($href): ?><a href="<?= e(url($href)) ?>"><?= e($label) ?></a><?php else: ?><span aria-current="page"><?= e($label) ?></span><?php endif ?><?php endforeach ?></nav>
    <?php endif ?>
    <?php if (!empty($eyebrow)): ?><p class="kicker"><?= e($eyebrow) ?></p><?php endif ?>
    <h1 class="rise"><?= e($heading) ?></h1>
    <?php if (!empty($promise)): ?><p class="hero-promise rise d1"><?= e($promise) ?></p><?php endif ?>
    <?php if (!empty($motto)): ?><p class="hero-motto rise d1"><?= e($motto) ?></p><?php endif ?>
    <?php if (!empty($lead)): ?><p class="lead rise d2"><?= e($lead) ?></p><?php endif ?>
    <?php if (!empty($cta)): ?><div class="hero-ctas rise d3"><a class="btn btn-light" href="<?= e(url($cta[1])) ?>"><?= e($cta[0]) ?> <?= icon('arrow') ?></a></div><?php endif ?>
  </div>
</section>
