<p><a class="back" href="<?= e(url('admin/messages')) ?>">← All messages</a></p>
<div class="cols-msg">
  <section class="card">
    <div class="card-head"><h2><?= e($msg['name']) ?></h2><span class="pill <?= e($msg['status']) ?>"><?= e($msg['status']) ?></span></div>
    <div class="msg-body"><?= nl2br(e($msg['body'])) ?></div>
  </section>
  <aside class="card">
    <dl class="meta">
      <div><dt>Email</dt><dd><a href="mailto:<?= e($msg['email']) ?>?subject=<?= rawurlencode('Re: your enquiry to CyberCraft') ?>"><?= e($msg['email']) ?></a></dd></div>
      <div><dt>Company</dt><dd><?= e($msg['company'] ?: '—') ?></dd></div>
      <div><dt>Phone</dt><dd><?= e($msg['phone'] ?: '—') ?></dd></div>
      <div><dt>Country</dt><dd><?= e($msg['country'] ?: '—') ?></dd></div>
      <div><dt>Interested in</dt><dd><?= e($msg['service'] ?: '—') ?></dd></div>
      <div><dt>Routed to</dt><dd><?= e($msg['route_to'] ?: '—') ?></dd></div>
      <div><dt>Received</dt><dd><?= e(date('j M Y, H:i', strtotime($msg['created_at']))) ?></dd></div>
      <div><dt>IP address</dt><dd><?= e($msg['ip']) ?></dd></div>
    </dl>
    <div class="actions">
      <a class="btn btn-primary btn-block" href="mailto:<?= e($msg['email']) ?>?subject=<?= rawurlencode('Re: your enquiry to CyberCraft') ?>"><?= icon('mail') ?>Reply by email</a>
      <form method="post"><?= csrf_field() ?>
        <?php if ($msg['status'] !== 'archived'): ?><button class="btn btn-ghost btn-block" name="action" value="archived">Archive</button><?php endif ?>
        <?php if ($msg['status'] !== 'new'): ?><button class="btn btn-ghost btn-block" name="action" value="new">Mark as unread</button><?php endif ?>
        <button class="btn btn-danger btn-block" name="action" value="delete" data-confirm="Delete this message permanently?"><?= icon('trash') ?>Delete</button>
      </form>
    </div>
  </aside>
</div>
