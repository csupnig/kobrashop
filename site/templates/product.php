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
      <div class="width75 floatLeft">
        <h1 class="productName"><?= $page->name() ?></h1>
        <h2 class="productId"><?= $page->articleId() ?></h2>
        <?php if ($cover = $page->{$productPicture}()->toFile()) { ?>
          <img class="width100 cover" src="<?= $cover->url() ?>"/>
        <?php } ?>
      </div>
      <div class="usage width25 floatLeft">
        <h3><?= t("fieldOfApplication") ?></h3>
        <?php snippet("productusage", ["product" => $page]); ?>
      </div>
    </div>
    <div class="width100 floatLeft">
      <div class="width75 floatLeft">
        <?php snippet("productdimensions", ["product" => $page, "temperature" => true]); ?>
      </div>
      <div class="properties width25 floatLeft">
        <?php snippet("productproperties", ["product" => $page]); ?>
      </div>
    </div>
    <div class="controls width100">
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
