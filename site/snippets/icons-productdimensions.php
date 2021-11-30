<?php if ($product->dimensions() == "true") { ?>
  <div class="icon body inlineBlock verySmallHMargin">
    <span class="veryLarge"><?= $product->length()->html() ?> x <?= $product->width()->html() ?></span><span> mm</span>
  </div>
<?php } ?>
<?php if ($product->bristles() == "true") { ?>
  <div class="icon bristles inlineBlock verySmallHMargin">
    <span class="veryLarge"><strong><?= $product->bristleType()->html() ?></strong> <?= $product->bristleLength()->html() ?> x <?= $product->bristleWidth()->html() ?></span><span> mm</span>
  </div>
<?php } ?>
<?php if ($temperature == true) { ?>
  <div class="icon temperature inlineBlock verySmallHMargin">
    <span class="veryLarge"><?= $product->maxTemperature()->html() ?></span><span> °C</span>
  </div>
<?php } ?>