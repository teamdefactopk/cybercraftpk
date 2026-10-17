<?php $bg = trim((string)($image ?? '')); ?>
<section class="page-hero<?= $bg !== '' ? ' has-bg' : '' ?>"<?= !empty($accent) ? ' style="--c:' . accent_var($accent) . '"' : '' ?>>
  <?php if ($bg !== ''): ?><img class="bg" src="<?= e(image_url($bg)) ?>" alt="" fetchpriority="high"><?php endif ?>
  <div class="wrap">
    <?php if (!empty($crumbs)): ?>
    <nav class="crumbs" aria-label="Breadcrumb"><a href="<?= e(url('/')) ?>">Home</a><?php foreach ($crumbs as $label => $href): ?><span aria-hidden="true">/</span><?php if ($href): ?><a href="<?= e(url($href)) ?>"><?= e($label) ?></a><?php else: ?><span aria-current="page"><?= e($label) ?></span><?php endif ?><?php endforeach ?></nav>
    <?php endif ?>
    <?php if (!empty($eyebrow)): ?><p class="kicker"><?= e($eyebrow) ?></p><?php endif ?>
    <h1><?= e($heading) ?></h1>
    <?php if (!empty($promise)): ?><p class="hero-promise"><?= e($promise) ?></p><?php endif ?>
    <?php if (!empty($motto)): ?><p class="hero-motto"><?= e($motto) ?></p><?php endif ?>
    <?php if (!empty($lead)): ?><p class="lead"><?= e($lead) ?></p><?php endif ?>
    <?php if (!empty($cta)): ?><div class="hero-ctas"><a class="btn btn-white" href="<?= e(url($cta[1])) ?>"><?= e($cta[0]) ?> <?= icon('arrow') ?></a></div><?php endif ?>
  </div>
</section>
