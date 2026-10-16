<!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="robots" content="noindex, nofollow">
<title>Sign in · CyberCraft admin</title>
<link rel="icon" href="<?= e(url('favicon.svg')) ?>" type="image/svg+xml">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Archivo:wght@700;800&family=IBM+Plex+Sans:wght@400;500;600&display=swap">
<link rel="stylesheet" href="<?= e(asset('css/admin.css')) ?>">
</head><body class="login-body">
<main class="login-card">
  <a class="side-brand dark" href="<?= e(url('/')) ?>"><?= logo_mark() ?><span>Cyber<span>Craft</span></span></a>
  <h1>Sign in to the dashboard</h1>
  <?php if ($installed): ?><div class="flash flash-success"><?= icon('check') ?><span>Installation complete. Sign in with the administrator account you just created.</span></div><?php endif ?>
  <?php if ($error): ?><div class="flash flash-error" role="alert"><?= icon('close') ?><span><?= e($error) ?></span></div><?php endif ?>
  <form method="post" class="form">
    <?= csrf_field() ?>
    <label for="email">Email</label>
    <input id="email" name="email" type="email" autocomplete="username" required autofocus value="<?= e(post('email')) ?>">
    <label for="password">Password</label>
    <input id="password" name="password" type="password" autocomplete="current-password" required>
    <button class="btn btn-primary btn-block" type="submit">Sign in</button>
  </form>
  <p class="login-foot"><a href="<?= e(url('/')) ?>">← Back to website</a></p>
</main>
</body></html>
