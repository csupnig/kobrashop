<?php return function ($page) {

  if (isset($_GET["category"])) {
    //Get category from URL
    $category = $_GET["category"];
  } else $category = "";

  //Initialize filters

  if (isset($_GET["filter"])) {
    //Get filter from URL
    $filter = $_GET["filter"];
    //Split filter string into array
    $filterArray = explode(";", $filter);
  } else {
    $filter = "";
    $filterArray =[];
  }

  //Initialize filter categories
  $properties = ["phb", "stainless", "alcalics", "acids", "waterFlow", "resin", "partiallyDetectable", "fullyDetectable"];
  $filterTypes = ["category", "sweeping1", "sweeping2", "sweeping3", "sweeping4", "brushing1", "brushing2", "brushing3", "brushing4", "surface1", "surface2", "surface3", "surface4", "phb", "stainless", "alcalics", "acids", "waterFlow", "resin", "partiallyDetectable", "fullyDetectable", "color1", "color2", "color3", "color4", "color5", "color6", "color7", "color8", "color9", "color11", "color12"];

  //Pass variables back to template
  return [
    "category" => $category,
    "filter" => $filter,
    "filterArray" => $filterArray,
    "properties" => $properties
  ];
};