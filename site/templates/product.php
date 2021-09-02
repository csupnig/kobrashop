<h1><?= $page->title() ?></h1>
<form action="<?= url('add') ?>" method="post">
  Price: <?= formatPrice($page->price()->toFloat()) ?><br>
  Tax: <?= formatPrice(calculateTax($page->price()->toFloat(), $page->tax()->toFloat())) ?><br>
  <input type="hidden" name="id" value="<?= $page->id() ?>">
  <input type="number" name="quantity" value="1" min="1">
  <button>add to cart</button>
</form>
