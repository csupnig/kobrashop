<?php //Check filter status and change in link
$property = "color".$colorNumber;
$propertyStatus = false;
$propertyStatus = strpos($filter, $property);
if ($propertyStatus !== false) {
  $filter = str_replace($property.";", "", $filter);
  $propertyStatus = true;
} else {
  $filter .= $property.";";
}

//Assemble link
$link = $page->url();
if ($category != "") $link .= "?category=".$category;
if (($category == "") && ($filter != "")) {
  $link .= "?"; } 
else if (($category != "") && ($filter != "")) $link .="&"; 
if ($filter != "") $link .= "filter=".$filter; ?>

<a href="<?= $link ?>"><button class="circle color color<?= $colorNumber ?> floatLeft tinyRightMargin tinyBottomMargin <?php if ($propertyStatus !== false) echo 'active'; ?>"><?= $colorNumber ?></button></a>