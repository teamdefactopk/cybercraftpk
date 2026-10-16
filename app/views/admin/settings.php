<form method="post" class="form" data-dirty>
  <?= csrf_field() ?>
  <?php foreach ($schema as $group => $items): ?>
  <section class="card">
    <div class="card-head"><h2><?= e($group) ?></h2></div>
    <div class="grid-2">
    <?php foreach ($items as [$k, $label, $type, $help]): ?>
      <div class="<?= in_array($type, ['textarea', 'lines'], true) ? 'span-2' : '' ?>">
      <?= view('admin/_field', ['f' => ['name' => $k, 'label' => $label, 'type' => $type, 'help' => $help, 'required' => false, 'options' => []], 'value' => $values[$k] ?? '']) ?>
      </div>
    <?php endforeach ?>
    </div>
  </section>
  <?php endforeach ?>
  <div class="form-actions sticky"><button class="btn btn-primary" type="submit"><?= icon('check') ?>Save settings</button></div>
</form>
