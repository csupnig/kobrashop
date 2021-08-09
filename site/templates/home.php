<?php snippet("head"); ?>
<?php snippet("header"); ?>
<?php snippet("products"); ?>


<?php snippet('cart', ['cart' => merx()->cart()]); ?>
<a href="<?= url('checkout') ?>">Checkout</a>
