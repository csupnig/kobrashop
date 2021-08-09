<?php if ($product->usage() == "special") { ?>
  <div class="specialUsage width100 centeredText">
    <span class="small bold inlineBlock"><?= t("for")." ".t("special") ?></span>
    <span class="inlineBlock"><?= t("usages") ?></span>
  </div>
<?php } else if ($product->usage() == "liquids") { ?>
  <div class="specialUsage width100 centeredText">
    <span class="small bold inlineBlock"><?= t("for")." ".t("special") ?></span>
    <span class="inlineBlock"><?= t("usages") ?></span>
  </div>
<?php } else if ($product->usage() == "sweeping") { 
  $sweepingUsages = [];
  foreach ($product->sweeping() as $sweepingUsage) {
    $sweepingUsages [] = $sweepingUsage;
  } ?>
  <div class="dirt floatLeft centeredText">
    <div class="icon sweeping1 floatLeft relative <?php if (in_array('sweeping1', $sweepingUsages)) echo 'active'; ?>"><div class="tooltip black absolute"><?= t("for")." ".t("sweepingExamples1")." ".t("dirt"); ?></div></div>
    <div class="icon sweeping2 floatLeft relative <?php if (in_array('sweeping2', $sweepingUsages)) echo 'active'; ?>"><div class="tooltip black absolute"><?= t("for")." ".t("sweepingExamples2")." ".t("dirt"); ?></div></div>
    <div class="icon sweeping3 floatLeft relative <?php if (in_array('sweeping3', $sweepingUsages)) echo 'active'; ?>"><div class="tooltip black absolute"><?= t("for")." ".t("sweepingExamples3")." ".t("dirt"); ?></div></div>
    <div class="icon sweeping4 floatLeft relative <?php if (in_array('sweeping4', $sweepingUsages)) echo 'active'; ?>"><div class="tooltip black absolute"><?= t("for")." ".t("sweepingExamples4")." ".t("dirt"); ?></div></div>
    <?php $lowestDirtGrade = $sweepingUsages[0];
    $highestDirtGrade = end($sweepingUsages); ?>
    <span class="small bold">
      <?php echo t("for")." ".t($lowestDirtGrade);
      if($lowestDirtGrade != $highestDirtGrade) {
        echo t("to")." ".t($highestDirtGrade);
      } ?>
    </span>
    <span><?= t("dirt") ?></span>
  </div>              
<?php } else if ($product->usage() == "brushing") { 
  $brushingUsages = [];
  foreach ($product->brushing() as $brushingUsage) {
    $brushingUsages [] = $brushingUsage;
  } ?>
  <div class="dirt floatLeft">
    <div class="icon brushing1 floatLeft relative <?php if (in_array('brushing1', $brushingUsages)) echo 'active'; ?>"><div class="tooltip black absolute"><?= t("for")." ".t("brushingExamples1")." ".t("dirt"); ?></div></div>
    <div class="icon brushing2 floatLeft relative <?php if (in_array('brushing1', $brushingUsages)) echo 'active'; ?>"><div class="tooltip black absolute"><?= t("for")." ".t("brushingExamples2")." ".t("dirt"); ?></div></div>
    <div class="icon brushing3 floatLeft relative <?php if (in_array('brushing1', $brushingUsages)) echo 'active'; ?>"><div class="tooltip black absolute"><?= t("for")." ".t("brushingExamples3")." ".t("dirt"); ?></div></div>
    <div class="icon brushing4 floatLeft relative <?php if (in_array('brushing1', $brushingUsages)) echo 'active'; ?>"><div class="tooltip black absolute"><?= t("for")." ".t("brushingExamples4")." ".t("dirt"); ?></div></div>
    <?php $lowestDirtGrade = $brushingUsages[0];
    $highestDirtGrade =  end($brushingUsages); ?>
    <span class="small bold">
      <?php echo t("for")." ".t($lowestDirtGrade);
      if($lowestDirtGrade != $highestDirtGrade) {
        echo t("to")." ".t($highestDirtGrade);
      } ?>
    </span>
    <span><?= t("dirt") ?></span>
  </div>              
<?php }
$surfaces = [];
foreach ($product->surfaces() as $surface) {
  $surfaces [] = $surface;
} ?>
<div class="surface floatLeft">
  <div class="icon surface1 floatLeft <?php if (in_array('surface1', $surfaces)) echo 'active'; ?>"><div class="tooltip black absolute"><?= t("for")." ".t("surfaceExamples1")." ".t("surfaces"); ?></div></div>
  <div class="icon surface2 floatLeft <?php if (in_array('surface2', $surfaces)) echo 'active'; ?>"><div class="tooltip black absolute"><?= t("for")." ".t("surfaceExamples1")." ".t("surfaces"); ?></div></div>
  <div class="icon surface3 floatLeft <?php if (in_array('surface3', $surfaces)) echo 'active'; ?>"><div class="tooltip black absolute"><?= t("for")." ".t("surfaceExamples1")." ".t("surfaces"); ?></div></div>
  <div class="icon surface4 floatLeft <?php if (in_array('surface4', $surfaces)) echo 'active'; ?>"><div class="tooltip black absolute"><?= t("for")." ".t("surfaceExamples1")." ".t("surfaces"); ?></div></div>
    <?php $lowestSurfaceGrade = $surfaces[0];
    $highestSurfaceGrade = end($surfaces); ?>
    <span class="small bold">
      <?php echo t("for")." ".t($lowestSurfaceGrade);
      if($lowestSurfaceGrade != $highestSurfaceGrade) {
        echo t("to")." ".t($highestSurfaceGrade);
      } ?>
    </span>
    <span><?= t("surfaces") ?></span>    
</div>