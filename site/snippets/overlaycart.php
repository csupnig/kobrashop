<div id="overlay-cart" class="overlay cart width50 height100 fixed top right whiteBackground overlay-content">
	<button class="close floatRight mfp-close verySmallMargin"></button>

  <?php snippet('cart', ['cart' => merx()->cart()]); ?>
  <?php snippet('addresses', []); ?>
  <a href="/" id="checkout_link"><?= t("initcheckout") ?></a>
</div>
<div id="overlay-checkoutoverview" class="overlay checkoutoverview width50 height100 fixed top right whiteBackground overlay-content">
  <button class="close floatRight mfp-close verySmallMargin"></button>

  <?php snippet('checkoutoverview', ['cart' => merx()->cart()]); ?>
  <form id="checkout_form" name="checkout" method="post" action="<?=url('initcheckout') ?>">
    <input type="hidden" name="address_encoded">
    <button type="submit"><?= t("checkout") ?></button>
  </form>
</div>
