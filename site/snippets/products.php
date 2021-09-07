<section class="products inlineBlock width100">
  <?php $products = $site->index()->filterBy("intendedTemplate", "product")->listed();
  foreach ($products as $product) {
    //Determine random product color
    $productColors = [];
    for($colorNumber = 1; $colorNumber <= 12; $colorNumber++) {
      if ($colorNumber != 10) {
        $pictureName = "pictureColor".$colorNumber;
        if ($product->{$pictureName}()->toFile()) {
          $productColors [] = "color".$colorNumber;
        }
      }
    }

    //Determine product color
    $productColor = $productColors[array_rand($productColors, 1)];
    $productPicture = "picture".$productColor;

    //Determine product background
    $productBackground = "";
    $sweepingUsages = [];
    foreach ($product->sweeping()->split() as $sweepingUsage) {
      $sweepingUsages [] = $sweepingUsage;
    }
    $brushingUsages = [];
    foreach ($product->brushing()->split() as $brushingUsage) {
      $brushingUsages [] = $brushingUsage;
    }
    if ($product->usage() == "special") $productBackground = "special";
    else if ($product->usage() == "liquids") $productbackground = "liquids";
    else if ($product->usage() == "sweeping") $productBackground = $sweepingUsages[0];
    else if ($product->usage() == "brushing") $productBackground = $brushingUsages[0]; ?>

    <div class="product floatLeft relative verySmallPadding <?= $productColor ?> <?= $productBackground ?> <?= $product->displaySize() ?>">
      <div class="absolute">
        <h4 class="productName"><?= $product->name() ?></h4>
        <h5 class="productId tinyTopMargin"><?= $product->articleId() ?></h5>
      </div>
      <span class="price floatRight"><?= formatPrice($product->price()->toFloat()) ?></span>
      <?php if ($cover = $product->{$productPicture}()->toFile()) { ?>
        <img class="width100 cover" src="<?= $cover->url() ?>"/>
      <?php } ?>
      <div class="overlay width100 absolute left bottom centeredText verySmallPadding">
        <div class="dimensions">
          <?php if ($product->dimensions() == "true") { ?>
            <div class="icon body inlineBlock verySmallHMargin">
              <span class="veryLarge"><?= $product->length()->html() ?> x <?= $product->width()->html() ?></span><span>mm</span>
            </div>
          <?php } ?>
          <?php if ($product->bristles() == "true") { ?>
            <div class="icon bristles inlineBlock verySmallHMargin">
              <span class="veryLarge"><strong><?= $product->bristleType()->html() ?></strong> <?= $product->bristleLength()->html() ?> x <?= $product->bristleWidth()->html() ?></span><span>mm</span>
            </div>
          <?php } ?>
        </div>
        <div class="details <?= $productBackground ?>">
          <div class="usage">
            <?php snippet("usage", ["product" => $product]); ?>
          </div>
          <div class="properties absolute bottom right verySmallPadding">
            <?php $properties = [];
            foreach ($product->properties() as $property) {
              $properties [] = $property;
            }
            if (in_array("phb", $properties)) { ?> <div class="icon phb floatLeft tinyLeftMargin relative"><div class="tooltip leftArrow black absolute"><?= t("phb") ?></div></div> <?php }
            if (in_array("stainless", $properties)) { ?> <div class="icon stainless floatLeft tinyLeftMargin relative"><div class="tooltip leftArrow black absolute"><?= t("stainless") ?></div></div> <?php }
            if (in_array("alcalics", $properties)) { ?> <div class="icon alcalics floatLeft tinyLeftMargin relative"><div class="tooltip leftArrow black absolute"><?= t("alcalics") ?></div></div> <?php }
            if (in_array("acids", $properties)) { ?> <div class="icon acids floatLeft tinyLeftMargin relative"><div class="tooltip leftArrow black absolute"><?= t("acids") ?></div></div> <?php }
            if (in_array("waterFlow", $properties)) { ?> <div class="icon waterFlow floatLeft tinyLeftMargin relative"><div class="tooltip leftArrow black absolute"><?= t("waterFlow") ?></div></div> <?php }
            if (in_array("partiallyDetectable", $properties)) { ?> <div class="icon partiallyDetectable floatLeft tinyLeftMargin relative"><div class="tooltip leftArrow black absolute"><?= t("partiallyDetectable") ?></div></div> <?php }
            if (in_array("fullyDetectable", $properties)) { ?> <div class="icon fullyDetectable floatLeft tinyLeftMargin relative"><div class="tooltip leftArrow black absolute"><?= t("fullyDetectable") ?></div></div> <?php } ?>
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