<?php
/** @var array $f  name,label,type,help,options,required  @var mixed $value @var string $error @var string $prefix */
$n = ($prefix ?? '') . $f['name'];
$id = 'f_' . preg_replace('/[^a-z0-9_]/i', '_', $n);
$v = (string)($value ?? '');
$err = $error ?? '';
?>
<div class="field<?= $err ? ' has-error' : '' ?><?= $f['type'] === 'checkbox' ? ' field-check' : '' ?>">
<?php if ($f['type'] === 'checkbox'): ?>
  <label class="switch" for="<?= e($id) ?>"><input id="<?= e($id) ?>" type="checkbox" name="<?= e($n) ?>" value="1"<?= $v === '1' || $v === 'on' ? ' checked' : '' ?>><span class="track" aria-hidden="true"></span><span><?= e($f['label']) ?></span></label>
<?php else: ?>
  <label for="<?= e($id) ?>"><?= e($f['label']) ?><?= !empty($f['required']) ? ' <span class="req" aria-hidden="true">*</span>' : '' ?></label>
  <?php if (in_array($f['type'], ['textarea', 'lines', 'markdown'], true)): ?>
    <textarea id="<?= e($id) ?>" name="<?= e($n) ?>" rows="<?= $f['type'] === 'markdown' ? 14 : ($f['type'] === 'lines' ? 6 : 4) ?>" data-autosize<?= $f['type'] === 'markdown' ? ' class="mono"' : '' ?>><?= e($v) ?></textarea>
  <?php elseif ($f['type'] === 'image'): ?>
    <div class="img-field">
      <?php if ($v !== ''): ?><img src="<?= e(image_url($v)) ?>" alt="" class="img-preview"><?php endif ?>
      <div class="img-inputs">
        <input id="<?= e($id) ?>" name="<?= e($n) ?>_file" type="file" accept="image/jpeg,image/png,image/webp">
        <input name="<?= e($n) ?>" value="<?= e($v) ?>" type="text" aria-label="<?= e($f['label']) ?> path or address" placeholder="Or a path / https:// address">
        <?php if ($v !== ''): ?><label class="switch"><input type="checkbox" name="<?= e($n) ?>_remove" value="1"><span class="track" aria-hidden="true"></span><span>Remove photo</span></label><?php endif ?>
      </div>
    </div>
  <?php elseif ($f['type'] === 'select' || $f['type'] === 'selectstr'): ?>
    <select id="<?= e($id) ?>" name="<?= e($n) ?>"><?php if ($f['type'] === 'selectstr'): ?><option value="">—</option><?php endif ?><?php foreach ($f['options'] as $ok => $ol): ?><option value="<?= e($ok) ?>"<?= (string)$ok === $v ? ' selected' : '' ?>><?= e($ol) ?></option><?php endforeach ?></select>
  <?php else: ?>
    <input id="<?= e($id) ?>" name="<?= e($n) ?>" value="<?= e($v) ?>" type="<?= ['number' => 'number', 'url' => 'url', 'email' => 'email'][$f['type']] ?? 'text' ?>"<?= !empty($f['required']) ? ' required' : '' ?><?= $f['type'] === 'slug' ? ' pattern="[a-z0-9-]*" spellcheck="false"' : '' ?>>
  <?php endif ?>
<?php endif ?>
<?php if ($err): ?><p class="err"><?= e($err) ?></p><?php elseif (!empty($f['help']) || $f['type'] === 'markdown' || $f['type'] === 'lines'): ?>
  <p class="help"><?= e($f['help'] ?: ($f['type'] === 'markdown' ? 'Formatting: blank line = new paragraph, ## Heading, - list item, **bold**, [link text](https://…).' : 'One item per line.')) ?></p>
<?php endif ?>
</div>
