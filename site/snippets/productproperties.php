<?php $properties = [];
foreach ($product->properties() as $property) {
  $properties [] = $property;
}
if (in_array("phb", $properties)) { ?> <div class="icon phb floatLeft tinyLeftMargin relative"><div class="tooltip rightArrow black absolute"><?= t("phb") ?></div></div> <?php }
if (in_array("stainless", $properties)) { ?> <div class="icon stainless floatLeft tinyLeftMargin relative"><div class="tooltip rightArrow black absolute"><?= t("stainless") ?></div></div> <?php }
if (in_array("alcalics", $properties)) { ?> <div class="icon alcalics floatLeft tinyLeftMargin relative"><div class="tooltip rightArrow black absolute"><?= t("alcalics") ?></div></div> <?php }
if (in_array("acids", $properties)) { ?> <div class="icon acids floatLeft tinyLeftMargin relative"><div class="tooltip rightArrow black absolute"><?= t("acids") ?></div></div> <?php }
if (in_array("waterFlow", $properties)) { ?> <div class="icon waterFlow floatLeft tinyLeftMargin relative"><div class="tooltip rightArrow black absolute"><?= t("waterFlow") ?></div></div> <?php }
if (in_array("partiallyDetectable", $properties)) { ?> <div class="icon partiallyDetectable floatLeft tinyLeftMargin relative"><div class="tooltip rightArrow black absolute"><?= t("partiallyDetectable") ?></div></div> <?php }
if (in_array("fullyDetectable", $properties)) { ?> <div class="icon fullyDetectable floatLeft tinyLeftMargin relative"><div class="tooltip rightArrow black absolute"><?= t("fullyDetectable") ?></div></div> <?php } ?>