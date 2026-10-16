<ol class="steps">
  <?php foreach ($steps as $i => $s): ?>
  <li class="step reveal" style="--d:<?= $i ?>"><span class="step-n"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?></span><h3><?= e($s['title']) ?></h3><p><?= e($s['body']) ?></p></li>
  <?php endforeach ?>
</ol>
