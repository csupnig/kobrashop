class Cart {

  static _instance = undefined;
  static getInstance() {
    if (!Cart._instance) {
      Cart._instance = new Cart();
    }
    return Cart._instance;
  }

  template = undefined;

  bind() {
    $('button.cart').click(() => {
      this.show();
    });
    $('#overlay-cart .close').click(() => {
      this.hide();
    });
    $('#openaccount_from_cart').click(($event) => {
      this.hide();
      Account.getInstance().show();
      $event.preventDefault();
    });
    const $cartcontainer = $('#cartcontainer');
    $cartcontainer.on('click', '.increase', (event) => {
      const id = this.getProductIdFromEventTarget(event);
      const q = this.getCartQuantityForId(id);
      this.setQuantityForId(id, q + 1);
    });
    $cartcontainer.on('click', '.decrease', (event) => {
      const id = this.getProductIdFromEventTarget(event);
      const q = this.getCartQuantityForId(id);
      this.setQuantityForId(id, q - 1);
    });
    $cartcontainer.on('blur', '[name="quantity"]', (event) => {
      const id = this.getProductIdFromEventTarget(event);
      const q = this.getCartQuantityForId(id);
      this.setQuantityForId(id, q);
    });
    $cartcontainer.on('click', '.remove', (event) => {
      this.remove(this.getProductIdFromEventTarget(event));
      event.preventDefault();
    });
    const template = $('#carttemplate').html();

    this.template = TemplateEngine.getInstance().precompileTemplate(template);
    this.refresh();
  }

  remove(id) {
    Http.remove('/cart', {id : id}).then(response => {
      this.render(response);
    });
  }

  add(product) {
    Http.post('/cart', product).then((response) => {
      this.render(response);
      $('.header-cart-button-container').removeClass('hidden');
      this.show();
    });
  }

  refresh() {
    Http.get('/cart').then((cart) => {
      this.render(cart);
    });
  }

  render(cart) {
    $('#cartcontainer').html(this.template(cart));
  }

  show() {
    $("div.overlay").removeClass("active");
    $("div.overlay.cart").addClass("active");
  }

  hide() {
    $("div.overlay.cart").removeClass("active");
  }

  getProductIdFromEventTarget(event) {
    return $(event.currentTarget).parents('.cart_item').attr('data-id');
  }

  getCartQuantityForId(id) {
    return +$('#cartcontainer [data-id="'+id+'"] [name="quantity"]').val();
  }

  setQuantityForId(id, quantity) {
    if (quantity < 0) {
      return;
    }
    $('#cartcontainer [data-id="'+id+'"] [name="quantity"]').val(quantity);
    Http.put('/cart', {id : id, quantity : quantity}).then(response => {
      this.render(response);
    });
  }

}

class Product {

  static _instance = undefined;
  static getInstance() {
    if (!Product._instance) {
      Product._instance = new Product();
    }
    return Product._instance;
  }

  bind() {
    $('#productform').submit((event) => {
      const product = $('#productform').serializeArray().reduce((prev, current) => {
        prev[current.name] = current.value;
        return prev;
      }, {});
      this.processProduct(product);
      this.addToCart(product);
      event.preventDefault();
    });
    const $quantityField = $('#productform [name="quantity"]');
    $('#productform .quantity.increase').click((event) => {
        const quantity = +$quantityField.val();
        $quantityField.val(quantity + 1);
        event.preventDefault();
    });
    $('#productform .quantity.decrease').click((event) => {
      let quantity = +$quantityField.val();
      if (quantity > 1) {
        quantity--
      }
      $quantityField.val(quantity);
      event.preventDefault();
    });
  }

  addToCart(product) {
    const quantity = +product.quantity;
    if (isNaN(quantity) || quantity < 0) {
      return;
    }
    Cart.getInstance().add(product);
  }

  processProduct(product) {
    const variants = JSON.parse(productVariants);
    const id = variants['color'+product.color];
    product.id = id;
  }
}

class Checkout {

  static _instance = undefined;
  static getInstance() {
    if (!Checkout._instance) {
      Checkout._instance = new Checkout();
    }
    return Checkout._instance;
  }

  template = undefined;

  bind() {
    $('#overlay-checkoutoverview .close').click(() => {
      this.hideOverlays();
    });
    var $form = $('#checkout_form');
    $('#checkout_link').click((event) => {

      var address = Addresses.getInstance().getCartAddress();
      var deliveryAddress = Addresses.getInstance().getDeliveryAddress();

      var valid = true;

      if (!Addresses.getInstance().isCartAddressValid()) {
        valid = false;
        Addresses.getInstance().setCartFormError();
      }

      if ($('.delivery-address').hasClass('hidden')) {
        deliveryAddress = {};
      } else {
        if (!Addresses.getInstance().isDeliveryAddressValid()) {
          valid = false;
          Addresses.getInstance().setDeliveryFormError();
        }
      }

      if (valid) {
        this.fetchOverview(address, deliveryAddress);
      }

      event.preventDefault();
      return false;
    });
    const template = $('#overviewtemplate').html();

    this.template = TemplateEngine.getInstance().precompileTemplate(template);
  }

  showOverview() {
    $("div.overlay.checkoutoverview").addClass("active");
  }

  hideOverlays() {
    $("div.overlay").removeClass("active");
  }

  fetchOverview(address, deliveryAddress) {

    Http.post('/checkoutoverview', {
      address,
      deliveryAddress
    }).then((response) => {
      this.renderOverview(response);
      this.hideOverlays();
      this.showOverview();
      $('#checkout_form input[name="address_encoded"]').val(JSON.stringify(address));
      $('#checkout_form input[name="delivery_address_encoded"]').val(JSON.stringify(deliveryAddress));
    });
  }

  renderOverview(cart) {
    $('#checkoutoverview_container').html(this.template(cart));
  }

}

class Orders {

  static _instance = undefined;
  static getInstance() {
    if (!Orders._instance) {
      Orders._instance = new Orders();
    }
    return Orders._instance;
  }

  template = undefined;

  bind() {

    const template = $('#orderstemplate').html();

    this.template = TemplateEngine.getInstance().precompileTemplate(template);

    this.fetchOrders();
  }

  fetchOrders() {
    Http.get('/user/orders').then((response) => {
      if (response && response.orders) {
        this.renderOrders({items : response.orders});
      }
    });
  }

  renderOrders(orders) {
    $('.order-container').html(this.template(orders));
  }

}

$(document).ready(() => {
    Product.getInstance().bind();
    Cart.getInstance().bind();
    Checkout.getInstance().bind();
    Orders.getInstance().bind();
});
