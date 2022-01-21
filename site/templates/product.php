<?php snippet("head"); ?>
<body class="product backgroundColor<?= $productColor ?>" data-color="<?= $productColor ?>">
<script>
  var productVariants = '<?=json_encode($variantMap) ?>';
</script>
  <?php snippet("header", ['productColor' => $productColor]); ?>
  <section class="product inlineBlock width100 smallPadding">
    <div class="width100 floatLeft">
      <div class="product width75 floatLeft <?= $productBackground ?>">
        <h1 class="productName"><?= $page->name() ?></h1>
        <h2 class="productId"><?= $page->articleId() ?></h2>
        <?php foreach ($productColors as $pictureColor) {
          $productPicture = $page->find($pictureColor)->picture();
          if ($picture = $productPicture->toFile()) { ?>
            <img class="productPicture width100 cover color<?= $pictureColor ?>" src="<?= $picture->url() ?>"/>
          <?php }
        } ?>
      </div>
      <div class="usage width25 floatLeft smallLeftPadding">
        <h3 class="smallBottomMargin verySmallRightPadding centeredText"><?= t("fieldOfApplication") ?></h3>
        <?php snippet("icons-productusage", ["product" => $page]); ?>
      </div>
    </div>
    <div class="width100 floatLeft">
      <div class="width75 floatLeft centeredText">
        <?php snippet("icons-productdimensions", ["product" => $page, "temperature" => true]); ?>
      </div>
      <div class="properties width25 floatLeft smallLeftPadding verySmallTopPadding centeredText">
        <?php snippet("icons-productproperties", ["product" => $page]); ?>
      </div>
    </div>
    <div class="width75 floatLeft smallVPadding">
      <span class="large"><?= $page->description()->kirbyText() ?></span>
    </div>
    <div class="controls width100 flex floatLeft backgroundColor<?= $productColor ?>">

        <div class="filler flexGrow height100 floatLeft border color<?= $productColor; ?> <?= $productBackground ?>"></div>
        <div class="buttons height100 floatLeft tinyLeftMargin">
          <form id="productform" class="productToCart floatRight height100" action="<?= url('add') ?>" method="post">
            <input type="hidden" name="url" value="<?= $page->url() ?>">
            <input type="hidden" name="color" value="<?= $productColor ?>">
            <input type="hidden" name="name" value="<?= $page->name() ?>">
            <input type="hidden" name="articleid" value="<?= $page->articleId() ?>">
            <button class="addToCart black color<?= $productColor; ?> floatRight tinyLeftMargin">
            </button>
            <div class="quantity floatRight tinyLeftMargin border color<?= $productColor; ?>">
              <div class="floatLeft tinyLeftPadding tinyTopPadding centeredText">
                <button class="quantity increase large"><span class="<?= $productColor; ?>">+</span></button><br/>
                <button class="quantity decrease large"><span class="<?= $productColor; ?>">-</span></button>
              </div>
              <div class="floatLeft smallLeftMargin">
                <input class="quantity <?= $productColor; ?> rightText" type="number" name="quantity" value="1" min="1">
              </div>
              <span class="pcs veryLarge <?= $productColor; ?> floatLeft bold tinyLeftMargin"><?= t("pcs.") ?></span>
              <span class="price huge <?= $productColor; ?> floatLeft bold rightText verySmallRightPadding"><?= $page->price()->html() ?>€</span>
            </div>
          </form>
          <?php foreach ($productColors as $productColor) { ?>
            <button class="colorSelector floatRight height100 color<?= $productColor; ?>" data-color="<?= $productColor; ?>"></button>
          <?php } ?>
        </div>

    </div>
  </section>
  <?php /*snippet("products", ["product" => $page]);*/ ?>
  <?php snippet("footer"); ?>
  <?php snippet("overlayaccount"); ?>
  <?php snippet("overlaycart"); ?>
</body>

