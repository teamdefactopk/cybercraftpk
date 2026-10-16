<form method="post" class="card form narrow-card">
  <?= csrf_field() ?>
  <div class="card-head"><h2>Profile</h2></div>
  <div class="field"><label for="a_name">Name</label><input id="a_name" name="name" value="<?= e($user['name']) ?>" required></div>
  <div class="field"><label>Email</label><input value="<?= e($user['email']) ?>" disabled></div>
  <div class="card-head"><h2>Change password</h2></div>
  <div class="field"><label for="a_cur">Current password</label><input id="a_cur" name="current_password" type="password" autocomplete="current-password"></div>
  <div class="field"><label for="a_new">New password</label><input id="a_new" name="new_password" type="password" minlength="10" autocomplete="new-password"><p class="help">Leave empty to keep your current password.</p></div>
  <div class="field"><label for="a_new2">Repeat new password</label><input id="a_new2" name="new_password2" type="password" minlength="10" autocomplete="new-password"></div>
  <button class="btn btn-primary" type="submit"><?= icon('check') ?>Save</button>
</form>
