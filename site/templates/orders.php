<h1>Orders 1</h1>

<ul>
<?php $orders = $site->index()->filterBy("intendedTemplate", "order")->listed()->filter(function($p) {
  return $p->stripeSessionId() == "cs_test_b134kWJVcmU7388dLePTGYzKPwE3Bn4JCsyn41i3DipHT1LrwDco542tfg";
});
foreach ($orders as $order) {

  ?>
  <li><a href="<?= $order->url() ?>"><?=$order->invoiceNumber() ?> <?=$order->name() ?></a></li>
  <?php
}
?>
</ul>
