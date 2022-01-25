<?php
require_once __DIR__."/../shop/ProductFunctions.php";
require_once __DIR__."/../shop/AccountFunctions.php";
?>
<section class="products inlineBlock width100">
  <?php //Fetch all products
  if ($category == "") $products = $site->index()->filterBy("intendedTemplate", "product")->listed();
  else $products = $site->index()->filterBy("intendedTemplate", "productcategory")->find($category)->index()->filterBy("intendedTemplate", "product")->listed();

  $isCompanyCustomer = AccountFunctions::isCompanyCustomer();

  //Filter products
  $filterCount = count($filterArray);
  if ($filterCount > 0) {
    $products = $products->filter(function($child) use ($filterArray, $filterCount) {

      //Get available colors
      $productVariants = $child->children()->filterBy("intendedTemplate", "productvariant")->listed();
      $productColors = [];
      foreach ($productVariants as $productVariant) {
        $colorNumber = $productVariant->title()->html();
        if (!in_array($colorNumber, $productColors)) $productColors [] = "color".$colorNumber;
      }

      //Assemble usages, properties and colors
      $productProperties = array_merge($child->sweeping()->split(), $child->brushing()->split(), $child->surfaces()->split(), $child->properties()->split(), $productColors);

      $showProduct = true;
      if ($filterArray[count($filterArray)-1] == "") array_pop($filterArray);
      //Cycle through all properties in filter
      foreach ($filterArray as $filterItem) {
        $propertyFound = false;
        //Cycle through all properties in product
        foreach ($productProperties as $property) {
          if ($property == $filterItem ) {
            //If property has been found in product, display product
            $propertyFound = true;
          } 
        }
        if ($propertyFound == false) $showProduct = false;
      }
      if ($showProduct == true) return $child;
    });
  }
  
  foreach ($products as $product) {
    //Fetch available product variants
    $productVariants = $product->children()->filterBy("intendedTemplate", "productvariant")->listed();

    //Remove multiple entries for identical colors
    $productColors = [];
    $displayPrice = 0;
    foreach ($productVariants as $productVariant) {
      $colorNumber = $productVariant->title()->html();
      $displayPrice = $isCompanyCustomer ? ProductFunctions::getNetPrice($productVariant) : ProductFunctions::getGrossPrice($productVariant);
      if (!in_array($colorNumber, $productColors)) $productColors [] = $colorNumber;
    }

    //Determine product color
    $productColor = $productColors[array_rand($productColors, 1)];
    $productPicture = $product->find($productColor)->picture();

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
    
    <a href="<?= $product->url() ?>?productColor=<?= $productColor ?>">
    <div class="product black floatLeft relative verySmallPadding backgroundColor<?= $productColor ?> <?= $productBackground ?> <?= $product->displaySize() ?>">
      <div class="absolute">
        <h4 class="productName"><?= $product->name() ?></h4>
        <h5 class="productId tinyTopMargin"><?= $product->articleId() ?></h5>
      </div>
      <span class="price floatRight"><?= formatPrice($displayPrice) ?></span>
      <?php if ($cover = $productPicture->toFile()) { ?>
        <img class="width100 cover" src="<?= $cover->url() ?>"/>
      <?php } ?>
      <div class="overlay width100 absolute left bottom centeredText verySmallPadding backgroundColor<?= $productColor ?>">
        <div class="dimensions">
          <?php snippet("icons-productdimensions", ["product" => $product, "temperature" => false]); ?>
        </div>
        <div class="details <?= $productBackground ?>">
          <div class="usage">
            <?php snippet("icons-productusage", ["product" => $product]); ?>
          </div>
          <div class="properties absolute bottom right verySmallPadding">
            <?php snippet("icons-productproperties", ["product" => $product]); ?>
          </div>
        </div>
      </div>
    </div>
  </a>
  <?php } ?>
</section>