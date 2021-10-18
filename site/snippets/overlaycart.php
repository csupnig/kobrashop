<div id="overlay-cart" class="overlay cart width50 height100 fixed top right whiteBackground overlay-content">
	<button class="close floatRight mfp-close verySmallMargin"></button>

  <?php snippet('cart', ['cart' => merx()->cart()]); ?>
  <?php snippet('addresses', []); ?>
  <a href="<?= url('checkout') ?>">Checkout</a>
</div>
