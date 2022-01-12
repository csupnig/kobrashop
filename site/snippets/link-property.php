<?php //Check filter status and change in link
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

<a href="<?= $link ?>"><div class="icon property <?= $property ?> inlineBlock tinyLeftMargin relative clickable <?php if ($propertyStatus !== false) echo 'active'; ?>"><div class="image"></div><div class="tooltip rightArrow black absolute"><?= t($property) ?></div></div></a>