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
        <h2><?= t("filterProductsBy"); ?></h2>
        <div>
          <h3><?= t("dirtAndSurface"); ?></h3>
        </div>
        <div>
          <h3><?= t("properties"); ?></h3>
        </div>
        <div>
          <h3><?= t("color"); ?></h3>
            <?php for ($buttonNumber = 1; $buttonNumber <= 12; $buttonNumber++) {
              if ($buttonNumber != 10) { ?>
                <button class="circle backgroundColor<?= $buttonNumber ?> floatLeft microRightPadding microBottomPadding"><?= $buttonNumber ?></button>
              <?php }
            } ?>
        </div>
      </div>
    </nav>
</header>
