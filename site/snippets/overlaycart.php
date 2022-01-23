<div id="overlay-cart" class="overlay cart width50 height100 microVPadding fixed top right whiteBackground overlay-content">
	<button class="close floatRight mfp-close verySmallMargin"></button>

  <?php snippet('cart', ['cart' => merx()->cart()]); ?>
  <div class="cart-main-address">
  <?php snippet('addresses', []); ?>
  </div>
  <h2 class="verySmallHPadding smallTopPadding verySmallBottomPadding delivery-address-header">
    <span class="bold"><?= t("deliveryAddress") ?> </span>
    <span>(<?= t("deliveryAddressIfDifferent") ?>)</span>
  </h2>
  <div class="address-container delivery-address verySmallHPadding hidden">

  </div>
  <a class="continue fixed width100 verySmallPadding whiteBackground" href="/" id="checkout_link">
    <button class="continue blackBackground white"><?= t("initcheckout") ?></button>
  </a>
</div>
<div id="overlay-checkoutoverview" class="overlay checkoutoverview width50 height100 fixed top right whiteBackground overlay-content">
  <button class="close floatRight mfp-close verySmallMargin"></button>

  <?php snippet('checkoutoverview', ['cart' => merx()->cart()]); ?>
  <form id="checkout_form" class="verySmallHPadding" name="checkout" method="post" action="<?=url('initcheckout') ?>">
    <input type="hidden" name="address_encoded">
    <input type="hidden" name="delivery_address_encoded">
    <button type="submit" class="button continue tinyTopMargin blackBackground white"><?= t("checkout") ?></button>
  </form>
</div>
