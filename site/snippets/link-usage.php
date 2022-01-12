<?php //Check filter status and change in link
$property = $subIcon.$usageNumber;
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

<a href="<?= $link ?>"><div class="icon <?=$icon?> <?=$subIcon?><?=$usageNumber ?> floatLeft relative clickable <?php if ($propertyStatus !== false) echo 'active'; ?>"><div class="image"></div><div class="tooltip leftArrow black absolute"><?= t("for")." ".t($icon)." ".t($subIcon."Examples".$usageNumber); ?></div></div></a>