<?php
$nav = $nav ?? practices_with_services();
$siteName = setting('site_name', 'CyberCraft');
$pageTitle = (current_path() === '' ? $siteName . ' | ' . setting('tagline') : ($title ?? '') . ' | ' . $siteName);
$desc = trim((string)($description ?? '')) ?: setting('meta_description');
$canonical = full_url(current_path());
$path = current_path();
$active = fn(string $p) => ($path === $p || ($p !== '' && str_starts_with($path, $p . '/'))) ? ' aria-current="page"' : '';
$loginUrl = setting('client_login_url');
$socials = ['linkedin' => 'LinkedIn', 'x' => 'X', 'facebook' => 'Facebook', 'instagram' => 'Instagram', 'youtube' => 'YouTube'];
$wa = preg_replace('/[^0-9]/', '', setting('whatsapp'));
$footInds = array_slice(industries(), 0, 6);
?><!doctype html>
<html lang="en" class="<?= setting('animations', '1') === '1' ? 'anim' : 'no-anim' ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title><?= e($pageTitle) ?></title>
<meta name="description" content="<?= e(mb_substr($desc, 0, 300)) ?>">
<link rel="canonical" href="<?= e($canonical) ?>">
<meta name="theme-color" content="#0A1630">
<link rel="icon" href="<?= e(url('favicon.svg')) ?>" type="image/svg+xml">
<meta property="og:type" content="website">
<meta property="og:site_name" content="<?= e($siteName) ?>">
<meta property="og:title" content="<?= e($pageTitle) ?>">
<meta property="og:description" content="<?= e(mb_substr($desc, 0, 300)) ?>">
<meta property="og:url" content="<?= e($canonical) ?>">
<meta property="og:image" content="<?= e(full_url('assets/img/logo-color.svg')) ?>">
<meta name="twitter:card" content="summary">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Archivo:wght@500;700;800;900&family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@500&display=swap">
<link rel="stylesheet" href="<?= e(asset('css/site.css')) ?>">
<script type="application/ld+json"><?= json_encode([
    '@context' => 'https://schema.org', '@type' => 'Organization', 'name' => setting('legal_name', $siteName),
    'url' => setting('site_url', 'https://www.cybercraft.biz'), 'logo' => full_url('assets/img/logo-color.svg'),
    'email' => setting('email_info'), 'slogan' => setting('tagline'), 'foundingDate' => '2007',
    'address' => ['@type' => 'PostalAddress', 'addressLocality' => 'Lahore', 'addressCountry' => 'PK'],
    'contactPoint' => [
        ['@type' => 'ContactPoint', 'contactType' => 'sales', 'email' => setting('email_sales')],
        ['@type' => 'ContactPoint', 'contactType' => 'customer support', 'email' => setting('email_support')],
    ],
], JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) ?></script>
<script>document.documentElement.classList.add('js')</script>
</head>
<body>
<a class="skip" href="#main">Skip to content</a>

<?php if (setting('announcement') !== ''): ?>
<div class="announce"><div class="wrap"><?= e(setting('announcement')) ?></div></div>
<?php endif ?>

<header class="site-header" id="top">
  <div class="wrap header-row">
    <a class="brand" href="<?= e(url('/')) ?>" aria-label="<?= e($siteName) ?> home">
      <img src="<?= e(asset('img/logo-color.svg')) ?>" alt="<?= e($siteName) ?>: <?= e(setting('tagline')) ?>" width="232" height="52">
    </a>

    <nav class="main-nav" id="main-nav" aria-label="Main">
      <div class="nav-item has-menu">
        <a href="<?= e(url('what-we-do')) ?>"<?= $active('what-we-do') ?: $active('services') ?>>What we do <?= icon('chev', 'ico chev') ?></a>
        <div class="mega" role="group" aria-label="What we do">
          <?php foreach ($nav as $p): ?>
          <div class="mega-col" style="--c:<?= accent_var($p['accent']) ?>">
            <a class="mega-head" href="<?= e(url('what-we-do/' . $p['slug'])) ?>"><?= practice_icon((string)$p['accent'], 'ico') ?><span><?= e($p['short_name'] ?: $p['name']) ?></span></a>
            <?php if ($p['promise']): ?><p class="mega-promise"><?= e($p['promise']) ?></p><?php endif ?>
            <?php foreach ($p['services'] as $s): ?>
            <a class="mega-link" href="<?= e(url('services/' . $s['slug'])) ?>"><?= e($s['name']) ?></a>
            <?php endforeach ?>
          </div>
          <?php endforeach ?>
        </div>
      </div>
      <a href="<?= e(url('industries')) ?>"<?= $active('industries') ?>>Industries</a>
      <a href="<?= e(url('products')) ?>"<?= $active('products') ?>>Products</a>
      <a href="<?= e(url('clients')) ?>"<?= $active('clients') ?>>Clients</a>
      <a href="<?= e(url('about')) ?>"<?= $active('about') ?>>Company</a>
      <a href="<?= e(url('careers')) ?>"<?= $active('careers') ?>>Careers</a>
      <a class="mobile-only" href="<?= e(url('contact')) ?>"<?= $active('contact') ?>>Contact us</a>
    </nav>

    <div class="header-actions">
      <button class="icon-btn" type="button" data-search-open aria-label="Search the site" aria-controls="search-panel" aria-expanded="false"><?= icon('search') ?></button>
      <?php if ($loginUrl !== ''): ?>
        <a class="btn btn-ghost btn-sm login-btn" href="<?= e($loginUrl) ?>"><?= icon('user') ?><span>Client login</span></a>
      <?php else: ?>
        <span class="btn btn-ghost btn-sm login-btn is-disabled" role="link" aria-disabled="true" title="Client portal coming soon"><?= icon('user') ?><span>Client login</span></span>
      <?php endif ?>
      <a class="btn btn-primary btn-sm cta-btn" href="<?= e(url('contact')) ?>">Contact us</a>
      <button class="icon-btn menu-btn" type="button" data-menu aria-label="Open menu" aria-controls="main-nav" aria-expanded="false"><?= icon('menu') ?></button>
    </div>
  </div>

  <div class="search-panel" id="search-panel" hidden>
    <form class="wrap search-form" action="<?= e(url('search')) ?>" method="get" role="search">
      <?= icon('search') ?>
      <label class="sr" for="site-search">Search</label>
      <input id="site-search" name="q" type="search" placeholder="Search services, industries, standards…" autocomplete="off" required minlength="2">
      <button class="btn btn-primary btn-sm" type="submit">Search</button>
      <button class="icon-btn" type="button" data-search-close aria-label="Close search"><?= icon('close') ?></button>
    </form>
  </div>
</header>

<main id="main">
<?= $content ?>
</main>

<footer class="site-footer">
  <div class="wrap footer-grid">
    <div class="footer-brand">
      <a class="footer-logo" href="<?= e(url('/')) ?>"><img src="<?= e(asset('img/logo-color.svg')) ?>" alt="<?= e($siteName) ?>" width="200" height="45" loading="lazy"></a>
      <p><?= e(setting('footer_text')) ?></p>
      <div class="socials" aria-label="Social media">
        <?php foreach ($socials as $k => $label): $u = setting('social_' . $k); ?>
          <?php if ($u !== ''): ?>
            <a href="<?= e($u) ?>" target="_blank" rel="noopener" aria-label="<?= e($label) ?>"><?= icon($k) ?></a>
          <?php else: ?>
            <span class="is-disabled" role="link" aria-disabled="true" aria-label="<?= e($label) ?> (coming soon)" title="<?= e($label) ?>: coming soon"><?= icon($k) ?></span>
          <?php endif ?>
        <?php endforeach ?>
        <?php if ($wa !== ''): ?>
          <a href="https://wa.me/<?= e($wa) ?>" target="_blank" rel="noopener" aria-label="WhatsApp"><?= icon('whatsapp') ?></a>
        <?php else: ?>
          <span class="is-disabled" role="link" aria-disabled="true" aria-label="WhatsApp (coming soon)" title="WhatsApp: coming soon"><?= icon('whatsapp') ?></span>
        <?php endif ?>
      </div>
    </div>
    <div class="footer-col">
      <h3>What we do</h3>
      <?php foreach ($nav as $p): ?><a href="<?= e(url('what-we-do/' . $p['slug'])) ?>"><?= e($p['short_name'] ?: $p['name']) ?></a><?php endforeach ?>
      <a href="<?= e(url('services')) ?>">All services</a>
    </div>
    <div class="footer-col">
      <h3>Industries</h3>
      <?php foreach ($footInds as $i): ?><a href="<?= e(url('industries/' . $i['slug'])) ?>"><?= e($i['name']) ?></a><?php endforeach ?>
      <a href="<?= e(url('industries')) ?>">All industries</a>
    </div>
    <div class="footer-col">
      <h3>Company</h3>
      <a href="<?= e(url('about')) ?>">About us</a>
      <a href="<?= e(url('products')) ?>">Products</a>
      <a href="<?= e(url('clients')) ?>">Clients</a>
      <a href="<?= e(url('careers')) ?>">Careers</a>
      <a href="<?= e(url('faq')) ?>">FAQ</a>
      <a href="<?= e(setting('b2cloud_url', 'https://b2cloud.io')) ?>" target="_blank" rel="noopener">b2cloud.io <?= icon('external', 'ico ico-xs') ?></a>
    </div>
    <div class="footer-col">
      <h3>Get in touch</h3>
      <a href="mailto:<?= e(setting('email_info')) ?>"><?= e(setting('email_info')) ?></a>
      <a href="mailto:<?= e(setting('email_sales')) ?>"><?= e(setting('email_sales')) ?></a>
      <a href="mailto:<?= e(setting('email_security')) ?>"><?= e(setting('email_security')) ?></a>
      <?php if (setting('phone') !== ''): ?><a href="tel:<?= e(preg_replace('/[^0-9+]/', '', setting('phone'))) ?>"><?= e(setting('phone')) ?></a><?php endif ?>
      <a href="<?= e(url('contact')) ?>">Contact form</a>
    </div>
  </div>
  <div class="wrap footer-bottom">
    <span>© <?= date('Y') ?> <?= e(setting('legal_name', $siteName)) ?>. All rights reserved. · <?= e(setting('tagline')) ?></span>
    <nav aria-label="Legal"><a href="<?= e(url('privacy')) ?>">Privacy</a><a href="<?= e(url('terms')) ?>">Terms</a><a href="<?= e(url('sitemap.xml')) ?>">Sitemap</a></nav>
  </div>
</footer>

<div class="cookie" id="cookie" hidden>
  <p>We use only essential cookies to keep this site secure and our forms working. <a href="<?= e(url('privacy')) ?>">Privacy policy</a></p>
  <button class="btn btn-primary btn-sm" type="button" data-cookie-ok>OK</button>
</div>
<a class="to-top" href="#top" aria-label="Back to top"><?= icon('up') ?></a>
<div class="toast" id="toast" role="status" aria-live="polite"></div>

<script src="<?= e(asset('js/site.js')) ?>" defer></script>
</body>
</html>
