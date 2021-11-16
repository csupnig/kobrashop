<?php
use Stripe\Stripe;

require_once __DIR__."/../shop/CartFunctions.php";
require 'vendor/autoload.php';


if (merx()->cart()->isEmpty()) {
  go('/');
}
if (kirby()->request()->method() === 'POST') {
  try {
        $cart = cart();
        $kirby = kirby();

        CartFunctions::initPayment();

      //$paymentIntent = $cart->getStripePaymentIntent();
      //$clientSecret = $paymentIntent->client_secret;
      //$kirby->session()->set('stripePaymentIntentId', $paymentIntent->id);

      // Accepting a stripe payment
      // https://stripe.com/docs/payments/accept-a-payment?integration=elements

      $lineItems = array();
      foreach ($cart->data() as $item) {

          // TODO handle proper product titles
          // TODO handle proper tax
          if ($item['id'] !== 'discount') {
              array_push($lineItems, [
                  'price_data' => [
                      'currency' => 'eur',
                      'product_data' => [
                          'name' => $item['title'],
                      ],
                      'unit_amount' => (int)($item['price'] * 100),
                  ],
                  'quantity' => (int)$item['quantity'],
              ]);
          }
      }

      // TODO handle discounts
      // https://stripe.com/docs/payments/checkout/discounts

        $stripeData = [
            'payment_method_types' => ['card', 'sofort'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => 'http://localhost/success',
            'cancel_url' => 'http://localhost/cancel',
        ];

      $session = \Stripe\Checkout\Session::create($stripeData);
    var_dump($session);

      //merx()->initializePayment();

        //go($session->url);
     // var_dump($session->url);
  } catch (Exception $ex) {
        var_dump($ex);
  }
}
