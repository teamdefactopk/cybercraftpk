<section class="cta-band">
  <div class="wrap cta-row">
    <div>
      <p class="kicker light">Let's talk</p>
      <h2><?= e(block('home_cta_band_title', 'Talk to us about your IT and security')) ?></h2>
      <p><?= e(block('home_cta_band_body')) ?></p>
    </div>
    <div class="cta-actions">
      <a class="btn btn-light" href="<?= e(url('contact' . (!empty($topic) ? '?service=' . rawurlencode($topic) : ''))) ?>">Contact us <?= icon('arrow') ?></a>
      <a class="cta-mail" href="mailto:<?= e(setting('email_info')) ?>"><?= icon('mail') ?><?= e(setting('email_info')) ?></a>
    </div>
  </div>
</section>
