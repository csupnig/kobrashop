<div id="overlay-cart" class="overlay cart width33 height100 fixed top right verySmallPadding whiteBackground overlay-content">
	<button class="close floatRight mfp-close"></button>

  <?php snippet('cart', ['cart' => merx()->cart()]); ?>
  <a href="<?= url('checkout') ?>">Checkout</a>
</div>
