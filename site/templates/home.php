<?php snippet("head"); ?>
<body class="home">
	<?php snippet("header"); ?>
	<?php snippet("products"); ?>
	<?php snippet("footer"); ?>
</body>

<?php snippet('cart', ['cart' => merx()->cart()]); ?>
<a href="<?= url('checkout') ?>">Checkout</a>
