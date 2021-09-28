<h1>Orders 1</h1>

<ul>
<?php $orders = $site->index()->filterBy("intendedTemplate", "order")->listed();
foreach ($orders as $order) {

  ?>
  <li><a href="<?= $order->url() ?>"><?=$order->invoiceNumber() ?> <?=$order->name() ?></a></li>
  <?php
}
?>
</ul>
