<?php return function ($page) {

  //Initialize category
  if (isset($_GET["category"])) {
    $category = $_GET["category"];
    $link = $page->url()."?category=".$category."&filter=";
  } else {
    $category = "";
    $link = $page->url()."?filter=";
  }
  //Initialize filters
  if (isset($_GET["filter"])) {
    $filter = $_GET["filter"];
  } else $filter = "";

  //Split filter string into array
  $currentFilter = explode(";", $filter);
  $properties = ["phb", "stainless", "alcalics", "acids", "waterFlow", "partiallyDetectable", "fullyDetectable"];
  $filterTypes = ["category", "sweeping1", "sweeping2", "sweeping3", "sweeping4", "brushing1", "brushing2", "brushing3", "brushing4", "surface1", "surface2", "surface3", "surface4", "phb", "stainless", "alcalics", "acids", "waterFlow", "partiallyDetectable", "fullyDetectable", "color1", "color2", "color3", "color4", "color5", "color6", "color7", "color8", "color9", "color11", "color12"];
  $newFilter = [];

  foreach ($currentFilter as $filterItem) {
    foreach ($filterTypes as $filterType) {
      if (strpos($filterItem, $filterType."=") !== false) $newFilter[$filterType] = str_replace($filterType."=", "", $filterItem);
    }
  }

  // pass $articles and $pagination to the template
  return [
    "link" => $link,
    "category" => $category,
    "newFilter" => $newFilter,
    "properties" => $properties
  ];
};