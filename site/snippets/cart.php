
<table class="shop_table shop_table_responsive cart" cellspacing="0">
  <tbody>


  <?php foreach ($cart as $item): ?>
    <tr class="cart_item">

      <td class="product-quantity quantity-input" data-title="Anzahl">
        <div class="quantity-buttons">
          <div class="floatLeft tinyLeftPadding tinyTopPadding centeredText">
            <button class="quantity increase large"><span class="color2">+</span></button><br>
            <button class="quantity decrease large"><span class="color2">-</span></button>
          </div>
        </div>
        <div class="quantity">
          <input type="number" id="quantity_614b35549eb44" class="input-text qty text" step="1" min="0" max="" name="quantity" value="<?= $item['quantity'] ?>" title="Menge" size="4" pattern="[0-9]*" inputmode="numeric">
          <span> Stk.</span></div>
      </td>

      <td class="product-name" data-title="Produkt">
        <a href="<?= $item['id'] ?>"><span class="txt-product-name"><?= $item['title'] ?></span></a><br><span class="txt-overlay-sku">582 900</span>-<span class="product-color-icon color-gelb">4</span>					</td>

      <td class="product-total">
        <span class="amount"><?= formatPrice($item['sum']) ?></span>
        <div class="product-remove">
          <a href="https://kobrashop.at/cart/?remove_item=d4d0f965a7ad0d7fe1db894e32a7e51c&amp;_wpnonce=9df371d273" class="remove" title="" data-product_id="125315" data-product_sku="582 900-4">×</a>					    </div>
      </td>
    </tr>
  <?php endforeach; ?>

  </tbody>
</table>

<p>
  <strong>Tax:</strong> <?= formatPrice($cart->getTax()) ?><br>
  <strong>Sum:</strong> <?= formatPrice($cart->getSum()) ?>
</p>
