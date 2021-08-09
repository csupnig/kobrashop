<section class="products">
  <?php $products = $site->index()->filterBy("intendedTemplate", "product")->listed();
  foreach ($products as $product) {
    //Determine random product color
    $productColors = [];
    foreach ($product->colors() as $productColor) {
      $productColors [] = $productColor;
    }
    $productColor = array_rand($productColors, 1); 

    //Determine product background
    $productBackground = "";
    $sweepingUsages = [];
    foreach ($product->sweeping() as $sweepingUsage) {
      $sweepingUsages [] = $sweepingUsage;
    }
    $brushingUsages = [];
    foreach ($product->brushing() as $brushingUsage) {
      $brushingUsages [] = $brushingUsage;
    }
    if ($product->usage() == "special") $productBackground = "special";
    else if ($product->usage() == "liquids") $productbackground = "liquids";
    else if ($product->usage() == "sweeping") $productBackground = $sweepingUsages[0];
    else if ($product->usage() == "brushing") $productBackground = $brushingUsages[0]; ?>
    <div class="product floatLeft relative <?= $productColor ?> <?= $productBackground ?> <?= $product->displaySize() ?>">
      <h4 class="floatLeft"><?= $product->name() ?></h4>
      <h5 class="floatLeft"><?= $product->articleId() ?></h5>
      <span class="price floatRight"><?= formatPrice($product->price()->toFloat()) ?></span>
      <?php if ($cover = $product->cover()->toFile()) { ?>
        <img class="width100 cover" src="<?= $cover->url() ?>"/>
      <?php } ?>
      <div class="width100 absolute">
        <div class="dimensions">
          <?php if ($product->dimensions() == "yes") { ?>
            <div class="body floatLeft">
              <span class="veryLarge"><?= $product->length()->html() ?> x <?= $product->width()->html() ?></span><span>mm</span>
            </div>
          <?php } ?>
          <?php if ($product->bristles() == "yes") { ?>
            <div class="bristles floatLeft">
              <span class="veryLarge"><strong><?= $product->bristleType()->html() ?></strong> <?= $product->bristleLength()->html() ?> x <?= $product->bristleWidth()->html() ?></span><span>mm</span>
            </div>
          <?php } ?>
        </div>
        <div class="details">
          <div class="usage">
            <?php snippet("usage", ["product" => $product]); ?>
          </div>
          <div class="properties">
            <?php $properties = [];
            foreach ($product->properties() as $property) {
              $properties [] = $property;
            }
            if (in_array("phb", $properties)) { ?> <div class="icon phb floatLeft relative"><div class="tooltip black absolute"><?= t("phb") ?></div></div> <?php }
            if (in_array("stainless", $properties)) { ?> <div class="icon stainless floatLeft relative"><div class="tooltip black absolute"><?= t("stainless") ?></div></div> <?php }
            if (in_array("alcalics", $properties)) { ?> <div class="icon alcalics floatLeft relative"><div class="tooltip black absolute"><?= t("alcalics") ?></div></div> <?php }
            if (in_array("acids", $properties)) { ?> <div class="icon acids floatLeft relative"><div class="tooltip black absolute"><?= t("acids") ?></div></div> <?php }
            if (in_array("waterFlow", $properties)) { ?> <div class="icon waterFlow floatLeft relative"><div class="tooltip black absolute"><?= t("waterFlow") ?></div></div> <?php }
            if (in_array("partiallyDetectable", $properties)) { ?> <div class="icon partiallyDetectable floatLeft relative"><div class="tooltip black absolute"><?= t("partiallyDetectable") ?></div></div> <?php }
            if (in_array("fullyDetectable", $properties)) { ?> <div class="icon fullyDetectable floatLeft relative"><div class="tooltip black absolute"><?= t("fullyDetectable") ?></div></div> <?php } ?>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
</section>

<?php /*
<form action="<?= url('add') ?>" method="post">
  <h3><?= $item->title() ?></h3>
  Price: <?= formatPrice($item->price()->toFloat()) ?><br>
  Tax: <?= formatPrice(calculateTax($item->price()->toFloat(), $item->tax()->toFloat())) ?><br>
  <input type="hidden" name="id" value="<?= $item->id() ?>">
  <input type="number" name="quantity" value="1" min="1">
  <button>add to cart</button>
</form> */ ?>