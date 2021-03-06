<h2 class="bold verySmallHPadding verySmallVPadding"><?= t("cart") ?></h2>
<div id="cartcontainer" class="">

</div>

<script id="carttemplate" type="text/x-handlebars">
<table class="shop_table shop_table_responsive cart width100" cellspacing="0">
  <tbody>


  {{#each items}}
    {{#if (or (ifEquals this.id "discount") (ifEquals this.id "shipping"))}}
    <tr class="cart_item" data-id="{{this.id}}">
      <td></td><td class="product-name verySmallVPadding" data-title="Discount">
          <span class="txt-product-name bold black noUnderline">{{#if (ifEquals this.id "discount")}}<?= t("discount") ?>{{else}}<?= t("shipping") ?>{{/if}}</span>
        </td><td class="product-total verySmallVPadding rightText">
          <span class="amount large bold">{{formatCurrency this.sum }}</span>
        </td>
        <td class="product-remove rightText verySmallRightPadding">
        </td>
    </tr>
    {{else}}
      <tr class="cart_item" data-id="{{this.id}}">
        <td class="product-quantity quantity-input verySmallVPadding verySmallLeftPadding" data-title="Anzahl">
          <div class="quantity-buttons floatLeft verySmallTopPadding centeredText">
              <button class="quantity increase"><span class="">+</span></button><br/>
              <button class="quantity decrease"><span class="">-</span></button>
          </div>
          <div class="quantity">
            <input type="number" class="input-text quantity text rightText" step="1" min="0" max="" name="quantity" value="{{ this.quantity }}" title="Menge" size="4" pattern="[0-9]*" inputmode="numeric">
            <span> Stk.</span>
          </div>
        </td>
        <td class="product-name verySmallVPadding" data-title="Produkt">
          <span class="txt-product-name bold black noUnderline"><a href="{{ this.id }}">{{ this.title }}</a></span><br><span class="txt-overlay-sku">{{this.articleid}}</span>-<span class="product-color-icon circle color{{this.color}} centeredText vCentered inlineBlock">{{this.color}}</span>
        </td>
        <td class="product-total verySmallVPadding rightText">
          <span class="amount large bold">{{formatCurrency this.sum }}</span>
        </td>
        <td class="product-remove rightText verySmallRightPadding">
          <span class="bold noUnderline"><a href="" class="remove">??</a></span>
        </td>
      </tr>
    {{/if}}
  {{/each}}

  </tbody>
</table>
<div class="width100 rightText verySmallHPadding smallVPadding">
  {{#if retail}}
  <span class="floatLeft"><?= t("vat") ?></span><span class="floatRight">{{formatCurrency tax}}</span><br/><br/>
  {{/if}}
  <span class="floatLeft bold"><?= t("total") ?></span><span class="floatRight bold large">{{formatCurrency total}}</span>
</div>
</script>
