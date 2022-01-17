<h1>Orders 1</h1>

<ul>
<?php
$usermail = kirby()->user()->email();

$orders = $site->index()->filterBy("intendedTemplate", "order")->listed()->filter(function($p) use($usermail) {
  return $p->email()->text() == $usermail;
});
foreach ($orders as $order) {

  ?>
  <li><a href="<?= $order->url() ?>"><?=$order->invoiceNumber() ?> <?=$order->name() ?></a></li>
  <?php
}
?>
</ul>
