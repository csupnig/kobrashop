<?php snippet("head");

//Determine available product colors
$productColors = [];
for($colorNumber = 1; $colorNumber <= 12; $colorNumber++) {
  $pictureName = "pictureColor".$colorNumber;
  if ($page->{$pictureName}()->toFile()) {
    $productColors [] = "color".$colorNumber;
  }
}

if (isset($_GET["productColor"])) {
  //Determine product color
  $productColor = $_GET["productColor"];
} else {
  //Determine random product color if not set
  $productColor = $productColors[array_rand($productColors, 1)];
} 
$productPicture = "picture".$productColor;

//Determine product background
$productBackground = "";
$sweepingUsages = [];
foreach ($page->sweeping()->split() as $sweepingUsage) {
  $sweepingUsages [] = $sweepingUsage;
}
$brushingUsages = [];
foreach ($page->brushing()->split() as $brushingUsage) {
  $brushingUsages [] = $brushingUsage;
}
if ($page->usage() == "special") $productBackground = "special";
else if ($page->usage() == "liquids") $productBackground = "liquids";
else if ($page->usage() == "sweeping") $productBackground = $sweepingUsages[0];
else if ($page->usage() == "brushing") $productBackground = $brushingUsages[0]; ?>

<body class="product <?= $productColor ?>">
  <?php snippet("header"); ?>
  <section class="product inlineBlock width100 smallPadding">
    <div class="width100 floatLeft">
      <div class="product width75 floatLeft <?= $productBackground ?>">
        <h1 class="productName"><?= $page->name() ?></h1>
        <h2 class="productId"><?= $page->articleId() ?></h2>
        <?php if ($cover = $page->{$productPicture}()->toFile()) { ?>
          <img class="width100 cover" src="<?= $cover->url() ?>"/>
        <?php } ?>
      </div>
      <div class="usage width25 floatLeft smallLeftPadding">
        <h3 class="smallBottomMargin"><?= t("fieldOfApplication") ?></h3>
        <?php snippet("productusage", ["product" => $page]); ?>
      </div>
    </div>
    <div class="width100 floatLeft">
      <div class="width75 floatLeft centeredText">
        <?php snippet("productdimensions", ["product" => $page, "temperature" => true]); ?>
      </div>
      <div class="properties width25 floatLeft smallLeftPadding verySmallTopPadding centeredText">
        <?php snippet("productproperties", ["product" => $page]); ?>
      </div>
    </div>
    <div class="controls flex width100 floatLeft topMargin">
      <div class="filler flexGrow height100 floatLeft border <?= $productColor; ?> <?= $productBackground ?>"></div>
      <div class="buttons height100 floatLeft tinyLeftMargin">
        <button class="addToCart black <?= $productColor; ?> floatRight tinyLeftMargin">
        </button>
        <div class="quantity floatRight tinyLeftMargin border <?= $productColor; ?>">
          <div class="floatLeft tinyLeftPadding tinyTopPadding centeredText">
            <button class="quantity increase large"><span class="<?= $productColor; ?>">+</span></button><br/>
            <button class="quantity decrease large"><span class="<?= $productColor; ?>">-</span></button>
          </div>
          <form class="floatLeft smallLeftMargin" action="">
            <input class="quantity <?= $productColor; ?> rightText" type="quantity" name="q" value="1">
          </form>
          <span class="pcs veryLarge <?= $productColor; ?> floatLeft bold tinyLeftMargin"><?= t("pcs.") ?></span>
          <span class="price huge <?= $productColor; ?> floatLeft bold rightText verySmallRightPadding"><?= $page->price()->html() ?>€</span>
        </div>
        <?php foreach ($productColors as $productColor) { ?>
          <button class="colorSelector floatRight height100 <?= $productColor; ?>"></button>
        <?php } ?>
      </div>
    </div>
  </section>
  <?php /*snippet("products", ["product" => $page]);*/ ?>
  <?php snippet("footer"); ?>
</body>







<?php /*<h1><?= $page->title() ?></h1>
<form action="<?= url('add') ?>" method="post">
  Price: <?= formatPrice($page->price()->toFloat()) ?><br>
  Tax: <?= formatPrice(calculateTax($page->price()->toFloat(), $page->tax()->toFloat())) ?><br>
  <input type="hidden" name="id" value="<?= $page->id() ?>">
  <input type="number" name="quantity" value="1" min="1">
  <button>add to cart</button>
</form>*/ ?>
