<?= view('partials/page-hero', ['crumbs' => ['Contact' => null], 'eyebrow' => 'Contact', 'heading' => block('contact_title', "Let's talk"), 'lead' => block('contact_intro')]) ?>

<section class="section">
  <div class="wrap contact-grid">
    <div class="form-card reveal">
      <?php if ($sent): ?>
        <div class="success-box" role="status">
          <span class="success-ico"><?= icon('check') ?></span>
          <h2>Message sent</h2>
          <p><?= e(block('contact_success')) ?></p>
          <a class="btn btn-ghost" href="<?= e(url('/')) ?>">Back to homepage</a>
        </div>
      <?php else: ?>
        <h2>Send us a message</h2>
        <?php if (!empty($errors['form'])): ?><p class="alert" role="alert"><?= e($errors['form']) ?></p><?php endif ?>
        <form method="post" action="<?= e(url('contact')) ?>" novalidate data-validate>
          <?= csrf_field() ?>
          <input type="hidden" name="_t" value="<?= time() ?>">
          <div class="hp" aria-hidden="true"><label for="website">Website</label><input id="website" name="website" tabindex="-1" autocomplete="off"></div>
          <div class="field-row">
            <div class="field<?= isset($errors['name']) ? ' has-error' : '' ?>">
              <label for="name">Your name <span aria-hidden="true">*</span></label>
              <input id="name" name="name" value="<?= e($old['name']) ?>" required autocomplete="name"<?= isset($errors['name']) ? ' aria-invalid="true" aria-describedby="name-err"' : '' ?>>
              <?php if (isset($errors['name'])): ?><p class="err" id="name-err"><?= e($errors['name']) ?></p><?php endif ?>
            </div>
            <div class="field<?= isset($errors['email']) ? ' has-error' : '' ?>">
              <label for="email">Work email <span aria-hidden="true">*</span></label>
              <input id="email" name="email" type="email" value="<?= e($old['email']) ?>" required autocomplete="email"<?= isset($errors['email']) ? ' aria-invalid="true" aria-describedby="email-err"' : '' ?>>
              <?php if (isset($errors['email'])): ?><p class="err" id="email-err"><?= e($errors['email']) ?></p><?php endif ?>
            </div>
          </div>
          <div class="field-row">
            <div class="field"><label for="company">Company</label><input id="company" name="company" value="<?= e($old['company']) ?>" autocomplete="organization"></div>
            <div class="field"><label for="phone">Phone / WhatsApp</label><input id="phone" name="phone" type="tel" value="<?= e($old['phone']) ?>" autocomplete="tel"></div>
          </div>
          <div class="field-row">
            <div class="field">
              <label for="country">Country</label>
              <select id="country" name="country"><option value="">Choose (optional)</option><?php foreach ($countries as $c): ?><option<?= $old['country'] === $c ? ' selected' : '' ?>><?= e($c) ?></option><?php endforeach ?></select>
            </div>
            <div class="field">
              <label for="service">I'm interested in</label>
              <select id="service" name="service">
                <option value="">Choose (optional)</option>
                <?php $opts = $topics; if ($old['service'] !== '' && !in_array($old['service'], $opts, true)) array_unshift($opts, $old['service']); ?>
                <?php foreach ($opts as $n): ?><option<?= $old['service'] === $n ? ' selected' : '' ?>><?= e($n) ?></option><?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="field<?= isset($errors['body']) ? ' has-error' : '' ?>">
            <label for="body">How can we help? <span aria-hidden="true">*</span></label>
            <textarea id="body" name="body" rows="6" required minlength="10"<?= isset($errors['body']) ? ' aria-invalid="true" aria-describedby="body-err"' : '' ?>><?= e($old['body']) ?></textarea>
            <?php if (isset($errors['body'])): ?><p class="err" id="body-err"><?= e($errors['body']) ?></p><?php endif ?>
          </div>
          <div class="field check<?= isset($errors['consent']) ? ' has-error' : '' ?>">
            <label><input type="checkbox" name="consent" value="1"<?= isset($_POST['consent']) ? ' checked' : '' ?> required> I agree that CyberCraft may contact me about this enquiry, as described in the <a href="<?= e(url('privacy')) ?>">privacy policy</a>.</label>
            <?php if (isset($errors['consent'])): ?><p class="err"><?= e($errors['consent']) ?></p><?php endif ?>
          </div>
          <button class="btn btn-primary" type="submit">Send message <?= icon('arrow') ?></button>
        </form>
      <?php endif ?>
    </div>

    <aside class="contact-side">
      <div class="contact-card reveal">
        <h2>Email the right team</h2>
        <dl class="emails">
          <?php foreach (['email_info' => 'General enquiries', 'email_sales' => 'Sales & quotations', 'email_msp' => 'Managed services', 'email_audit' => 'Compliance & audit', 'email_horizons' => 'Horizons lab', 'email_security' => 'Report a security incident', 'email_support' => 'Service desk (clients)', 'email_partners' => 'Partnerships & JV', 'email_careers' => 'Careers'] as $k => $label): if (setting($k) === '') continue; ?>
          <div><dt><?= e($label) ?></dt><dd><a href="mailto:<?= e(setting($k)) ?>"><?= e(setting($k)) ?></a></dd></div>
          <?php endforeach ?>
        </dl>
        <?php $wa = preg_replace('/[^0-9]/', '', setting('whatsapp')); if (setting('phone') !== '' || $wa !== ''): ?>
        <p class="contact-phone"><?php if (setting('phone') !== ''): ?><?= icon('phone', 'ico ico-xs') ?><a href="tel:<?= e(preg_replace('/[^0-9+]/', '', setting('phone'))) ?>"><?= e(setting('phone')) ?></a><?php endif ?><?php if ($wa !== ''): ?> <?= icon('whatsapp', 'ico ico-xs') ?><a href="https://wa.me/<?= e($wa) ?>" target="_blank" rel="noopener">WhatsApp</a><?php endif ?></p>
        <?php endif ?>
      </div>
      <div class="contact-card reveal" style="--d:1">
        <h2>Our offices</h2>
        <ul class="office-list">
          <?php foreach ($offices as $o): ?>
          <li><b><?= e(($o['city'] ? $o['city'] . ', ' : '') . $o['country']) ?><?= $o['is_hq'] ? ' · HQ' : '' ?></b><span class="addr"><?= trim((string)$o['address']) !== '' ? nl2br(e($o['address'])) : '<em>Address coming soon</em>' ?></span><?php if (trim((string)$o['phone']) !== ''): ?><span class="addr"><?= e($o['phone']) ?></span><?php endif ?><?php if (trim((string)$o['email']) !== ''): ?><span class="addr"><a href="mailto:<?= e($o['email']) ?>"><?= e($o['email']) ?></a></span><?php endif ?></li>
          <?php endforeach ?>
        </ul>
      </div>
    </aside>
  </div>
</section>
