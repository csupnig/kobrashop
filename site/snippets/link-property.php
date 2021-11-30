<?php
$linkItem = $property;
$linkItemFound = false;
$filterItems = array_keys($newFilter);
foreach ($filterItems as $filterItem) {
  //Check if filter item corresponds to link item & add filter to link
  if ($filterItem == $linkItem) {
    //Set link item as found
    $linkItemFound = true;
    //Switch link item value
    if ($newFilter[$filterItem] == "true") {
      //$link .= $filterItem."=false;";
    } else $link .= $filterItem."=true;";
  } else $link .= $filterItem."=".$newFilter[$filterItem].";";
}
//If link item hasn't been found in current link, add item to link
if ($linkItemFound == false) {
  $link .= $linkItem."=true";
} ?>
<a href="<?= $link ?>"><div class="icon property <?= $linkItem ?> inlineBlock tinyLeftMargin relative clickable <?php if (array_key_exists($linkItem, $newFilter)) { if ($newFilter[$linkItem] == "true") echo 'active'; } ?>"><div class="image"></div><div class="tooltip rightArrow black absolute"><?= t($property) ?></div></div></a>