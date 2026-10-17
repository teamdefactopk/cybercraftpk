<ol class="steps">
  <?php foreach ($steps as $i => $s): ?>
  <li class="step reveal" style="--d:<?= $i ?>"><span class="step-n">Step <?= $i + 1 ?></span><h3><?= e($s['title']) ?></h3><p><?= e($s['body']) ?></p></li>
  <?php endforeach ?>
</ol>
