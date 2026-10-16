<div class="cols-2 wide-left">
  <section class="card flush">
    <div class="table-wrap"><table>
      <thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Last sign-in</th><th></th></tr></thead>
      <tbody>
      <?php foreach ($rows as $u): ?>
        <tr><td><b><?= e($u['name']) ?></b><?= (int)$u['id'] === (int)$user['id'] ? ' <span class="muted">(you)</span>' : '' ?></td><td><?= e($u['email']) ?></td><td><span class="pill <?= $u['role'] === 'admin' ? 'on' : '' ?>"><?= e($u['role']) ?></span></td><td class="nowrap"><?= $u['last_login_at'] ? e(date('j M Y, H:i', strtotime($u['last_login_at']))) : '<span class="muted">Never</span>' ?></td>
        <td class="right"><?php if ((int)$u['id'] !== (int)$user['id']): ?><form method="post" class="inline"><?= csrf_field() ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= (int)$u['id'] ?>"><button class="icon-btn sm danger" type="submit" aria-label="Remove user" data-confirm="Remove <?= e($u['email']) ?>?"><?= icon('trash') ?></button></form><?php endif ?></td></tr>
      <?php endforeach ?>
      </tbody>
    </table></div>
  </section>
  <form method="post" class="card form">
    <?= csrf_field() ?><input type="hidden" name="action" value="create">
    <div class="card-head"><h2>Add a user</h2></div>
    <div class="field"><label for="u_name">Name</label><input id="u_name" name="name" required></div>
    <div class="field"><label for="u_email">Email</label><input id="u_email" name="email" type="email" required></div>
    <div class="field"><label for="u_pw">Password</label><input id="u_pw" name="password" type="password" minlength="10" required autocomplete="new-password"><p class="help">At least 10 characters. Share it securely.</p></div>
    <div class="field"><label for="u_role">Role</label><select id="u_role" name="role"><option value="editor">Editor: edits content and reads messages</option><option value="admin">Administrator: also settings and users</option></select></div>
    <button class="btn btn-primary" type="submit"><?= icon('plus') ?>Add user</button>
  </form>
</div>
