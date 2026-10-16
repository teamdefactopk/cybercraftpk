<?php $all = array_merge(...array_map(fn($s) => lines($s['items']), $standards ?: [['items' => '']])); if ($all): ?>
<section class="badges" aria-label="Standards we prepare clients for">
  <div class="wrap">
    <span class="label">Standards we prepare clients for</span>
    <div class="marquee"><div class="track"><?php for ($i = 0; $i < 2; $i++): ?><?php foreach ($all as $b): ?><span<?= $i ? ' aria-hidden="true"' : '' ?>><?= e($b) ?></span><?php endforeach ?><?php endfor ?></div></div>
  </div>
</section>
<?php endif ?>
