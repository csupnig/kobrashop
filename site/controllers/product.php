<?php return function ($page) {
  //Fetch available product variants
  $productVariants = $page->children()->filterBy("intendedTemplate", "productvariant")->listed();

  //Remove multiple entries for identical colors
  $productColors = [];
  $variantMap = [];
  foreach ($productVariants as $productVariant) {
    $colorNumber = $productVariant->title()->html();
    $variantMap["color".$colorNumber] = $productVariant->id();
    if (!in_array($colorNumber, $productColors)) $productColors [] = $colorNumber;
  }

  //Determine product color
  if (isset($_GET["productColor"])) $productColor = $_GET["productColor"];
  else $productColor = $productColors[array_rand($productColors, 1)];

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
  else if ($page->usage() == "liquids") $productbackground = "liquids";
  else if ($page->usage() == "sweeping") $productBackground = $sweepingUsages[0];
  else if ($page->usage() == "brushing") $productBackground = $brushingUsages[0];

  //Pass variables back to template
  return [
    "productBackground" => $productBackground,
    "productColors" => $productColors,
    "productColor" => $productColor,
    "variantMap" => $variantMap
  ];
}; ?>