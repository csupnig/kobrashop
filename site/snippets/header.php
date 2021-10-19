<header id="header" class="width100 inlineBlock smallHPadding verySmallVPadding black relative">
    <a class="width20 floatLeft noUnderline" href="<?= $site->url() ?>"><img class="logo width100" src="/assets/images/logo-shop-black.png" alt="<?= $site->name()->html() ?>"/></a>
    <nav class="primary floatLeft noUnderline">
      <a class="overlay floatLeft smallLeftMargin" href="<?= $site->url() ?>" data-overlay="products"><?= t("products") ?></a>
      <form class="floatLeft smallLeftMargin" action="<?= $site->children()->findBy("intendedTemplate", "search")->url() ?>">
        <input id="searchInput" class="search black" type="search" name="q" placeholder="<?= t('productSearch') ?>">
      </form>
  	</nav>
    <nav class="secondary floatRight noUnderline">
      <!--USER LOGIN STATUS NEEDS TO BE CHECKED HERE. DISPLAY LOGIN BUTTON (account) IS NOT LOGGED IN, ACCOUNT BUTTON (account.active) IF LOGGED IN-->
      <div class="floatLeft relative"><button class="cart"></button><div class="tooltip rightArrow white absolute"><?= t("cart") ?></div></div>
      <div class="floatLeft relative verySmallLeftMargin"><button class="account"></button><div class="tooltip rightArrow white absolute"><?= t("account") ?></div></div>
      <a class="floatLeft relative verySmallLeftMargin" href="<?= $site->contactPage()->url() ?>"><button class="contact"></button><div class="tooltip rightArrow white absolute">Information</div></a>
      <a class="floatLeft relative verySmallLeftMargin" href="https://www.kobra.at"><button class="website"></button><div class="tooltip rightArrow white absolute">kobra.at</div></a>
    </nav>
    <nav class="overlay width100 left smallPadding absolute backgroundColor<?= $productColor ?>">
      <div class="width50 floatLeft rightBorder">
        <ul class="categories blankList">
          <?php $categories = $site->children()->filterBy("intendedTemplate", "productcategory")->listed();
          foreach ($categories as $category) { ?>
            <li class="hoverUnderline dashedUnderline">
              <a href="" data-category="<?= $category->slug() ?>"><?= $category->name()->html() ?></a>
              <?php $subcategories = $category->children()->filterBy("intendedTemplate", "productcategory")->listed();
              $scCount = $subcategories->count();
              if ($scCount > 0) { 
                $scNumber = 1; ?>
                <ul class="subcategories blankList verySmallLeftPadding microVPadding">
                <?php foreach ($subcategories as $subcategory) { ?>
                  <li class="inlineBlock"><a href="" data-category="<?= $subcategory->slug() ?>"><?= $subcategory->name()->html() ?></a><?php if ($scNumber < $scCount) echo ","; ?></li>
                  <?php $scNumber++;
                } ?>
                </ul>
              <?php } ?>
            </li>
          <?php } ?>
        </ul>
      </div>
      <div class="width50 floatLeft">
        <div class="usage width100">
          <h2><?= t("filterProductsBy"); ?> <?= t("dirtAndSurface"); ?></h2>
          <div class="width50 floatLeft verySmallTopPadding">
            <div class="icon dirt sweeping1 floatLeft relative"><div class="tooltip leftArrow black absolute"><?= t("for")." ".t("dirt")." ".t("sweepingExamples1"); ?></div></div>
            <div class="icon dirt sweeping2 floatLeft relative"><div class="tooltip leftArrow black absolute"><?= t("for")." ".t("dirt")." ".t("sweepingExamples2"); ?></div></div>
            <div class="icon dirt sweeping3 floatLeft relative"><div class="tooltip leftArrow black absolute"><?= t("for")." ".t("dirt")." ".t("sweepingExamples3"); ?></div></div>
            <div class="icon dirt sweeping4 floatLeft relative"><div class="tooltip leftArrow black absolute"><?= t("for")." ".t("dirt")." ".t("sweepingExamples4"); ?></div></div>
            <div class="labels"><span class="small floatLeft"><?= t("sweeping1h") ?></span><span class="small floatRight"><?= t("sweeping4h") ?></span></div>
          </div>
          <div class="width50 floatLeft verySmallTopPadding">
            <div class="icon dirt brushing1 floatLeft relative"><div class="tooltip leftArrow black absolute"><?= t("for")." ".t("dirt")." ".t("brushingExamples1"); ?></div></div>
            <div class="icon dirt brushing2 floatLeft relative"><div class="tooltip leftArrow black absolute"><?= t("for")." ".t("dirt")." ".t("brushingExamples2"); ?></div></div>
            <div class="icon dirt brushing3 floatLeft relative"><div class="tooltip leftArrow black absolute"><?= t("for")." ".t("dirt")." ".t("brushingExamples3"); ?></div></div>
            <div class="icon dirt brushing4 floatLeft relative"><div class="tooltip leftArrow black absolute"><?= t("for")." ".t("dirt")." ".t("brushingExamples4"); ?></div></div>
            <div class="labels"><span class="small floatLeft"><?= t("brushing1h") ?></span><span class="small floatRight"><?= t("brushing4h") ?></span></div>
          </div>
          <div class="width50 floatLeft verySmallTopPadding">
            <div class="icon surface surface1 floatLeft relative"><div class="tooltip rightArrow black absolute"><?= t("for")." ".t("surfaces")." ".t("surfaceExamples1"); ?></div></div>
            <div class="icon surface surface2 floatLeft relative"><div class="tooltip rightArrow black absolute"><?= t("for")." ".t("surfaces")." ".t("surfaceExamples1"); ?></div></div>
            <div class="icon surface surface3 floatLeft relative"><div class="tooltip rightArrow black absolute"><?= t("for")." ".t("surfaces")." ".t("surfaceExamples1"); ?></div></div>
            <div class="icon surface surface4 floatLeft relative"><div class="tooltip rightArrow black absolute"><?= t("for")." ".t("surfaces")." ".t("surfaceExamples1"); ?></div></div>
            <div class="labels"><span class="small floatLeft"><?= t("surface1h") ?></span><span class="small floatRight"><?= t("surface4h") ?></span></div>
          </div>
        </div>
        <div class="width100 floatLeft smallTopPadding">
          <div class="properties width50 floatLeft">
            <h2 class="verySmallBottomPadding"><?= t("properties"); ?></h2>
            <div class="icon phb inlineBlock tinyLeftMargin relative"><div class="tooltip rightArrow black absolute"><?= t("phb") ?></div></div>
            <div class="icon stainless inlineBlock tinyLeftMargin relative"><div class="tooltip rightArrow black absolute"><?= t("stainless") ?></div></div>
            <div class="icon alcalics inlineBlock tinyLeftMargin relative"><div class="tooltip rightArrow black absolute"><?= t("alcalics") ?></div></div>
            <div class="icon acids inlineBlock tinyLeftMargin relative"><div class="tooltip rightArrow black absolute"><?= t("acids") ?></div></div>
            <div class="icon waterFlow inlineBlock tinyLeftMargin relative"><div class="tooltip rightArrow black absolute"><?= t("waterFlow") ?></div></div>
            <div class="icon partiallyDetectable inlineBlock tinyLeftMargin relative"><div class="tooltip rightArrow black absolute"><?= t("partiallyDetectable") ?></div></div>
            <div class="icon fullyDetectable inlineBlock tinyLeftMargin relative"><div class="tooltip rightArrow black absolute"><?= t("fullyDetectable") ?></div></div>
          </div>
          <div class="colors width40 floatLeft">
            <h2><?= t("color"); ?></h2>
            <?php for ($buttonNumber = 1; $buttonNumber <= 12; $buttonNumber++) {
              if ($buttonNumber != 10) { ?>
                <button class="circle color<?= $buttonNumber ?> floatLeft tinyRightMargin tinyBottomMargin"><?= $buttonNumber ?></button>
              <?php }
            } ?>
          </div>
        </div>
      </div>
    </nav>
</header>
