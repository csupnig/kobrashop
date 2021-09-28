<div id="cartcontainer" class="">

</div>

<script id="carttemplate" type="text/x-handlebars">
<table class="shop_table shop_table_responsive cart" cellspacing="0">
  <tbody>


  {{#each items}}
    <tr class="cart_item" data-id="{{this.id}}">

      <td class="product-quantity quantity-input" data-title="Anzahl">
        <div class="quantity-buttons">
          <div class="floatLeft tinyLeftPadding tinyTopPadding centeredText">
            <button class="quantity increase large"><span class="">+</span></button>
            <button class="quantity decrease large"><span class="">-</span></button>
          </div>
        </div>
        <div class="quantity">
          <input type="number" class="input-text qty text" step="1" min="0" max="" name="quantity" value="{{ this.quantity }}" title="Menge" size="4" pattern="[0-9]*" inputmode="numeric">
          <span> Stk.</span></div>
      </td>

      <td class="product-name" data-title="Produkt">
        <a href="{{ this.id }}"><span class="txt-product-name">{{ this.title }}</span></a><br><span class="txt-overlay-sku">{{this.articleid}}</span>-<span class="product-color-icon color{{this.color}}">{{this.color}}</span>					</td>

      <td class="product-total">
        <span class="amount">{{formatCurrency this.sum }}</span>
        <div class="product-remove">
          <a href="" class="remove">×</a>					    </div>
      </td>
    </tr>
  {{/each}}

  </tbody>
</table>

<p>
  <strong>Tax:</strong> {{formatCurrency tax}}<br>
  <strong>Sum:</strong> {{formatCurrency sum}}
</p>

</script>
