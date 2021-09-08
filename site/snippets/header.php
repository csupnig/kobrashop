<header id="header" class="width100 inlineBlock smallHPadding verySmallVPadding black whitebackground relative">
    <a class="width20 floatLeft noUnderline" href="<?= $site->url() ?>"><img class="logo width100" src="/assets/images/logo-shop-black.png" alt="<?= $site->name()->html() ?>"/></a>
    <nav class="primary floatLeft noUnderline">
      <a class="overlay floatLeft smallLeftMargin" href="<?= $site->url() ?>" data-overlay="products"><?= t("products") ?></a>
      <form class="floatLeft smallLeftMargin" action="<?= $site->children()->findBy("intendedTemplate", "search")->url() ?>">
        <input id="searchInput" class="search black" type="search" name="q" placeholder="<?= t('productSearch') ?>">
      </form>
  	</nav>
    <nav class="secondary floatRight noUnderline">
      <!--USER LOGIN STATUS NEEDS TO BE CHECKED HERE. DISPLAY LOGIN BUTTON (account) IS NOT LOGGED IN, ACCOUNT BUTTON (account.active) IF LOGGED IN-->
      <a class="overlay relative"><button class="account"></button><div class="tooltip absolute"><?= t("account") ?></div><a>
      <a class="relative" href="<?= $site->contactPage()->url() ?>"><button class="contact"></button><div class="tooltip white absolute">Information</div></a>
      <a class="relative" href="https://www.kobra.at"><button class="website"></button><div class="tooltip white absolute">kobra.at</div></a>
    </nav>
    <nav class="overlay products smallPadding absolute">
      <div class="width25 floatLeft">
        <ul class="categories">
          <?php $categories = $site->children()->filterBy("intendedTemplate", "category")->listed();
          foreach ($categories as $category) { ?>
            <li data-subCategory="<?= $category->slug() ?>"><?= $category->name()->html() ?><li>
          <?php } ?>
        </ul>
      </div>
      <div class="width25 floatLeft">
        <?php $currentCategory = "";
        foreach ($categories as $category) {
          if ($currentCategory != $category) {
            if ($currentCategory == "") { ?>
              <ul class="<?= $category->slug() ?>">
            <?php } else { ?>
              </ul><ul class="<?= $category->slug() ?>">
            <?php }
            $currentCategory = $category;
          }
          $subCategories = $category->children()->filterBy("intendedTemplate", "subCategory")->listed(); ?>
          <li class="<?= $category->slug() ?>"><?= $category->name()->html() ?><li>
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
        </div>
      </div>
    </nav>
</header>