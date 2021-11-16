<?php

use Kirby\Exception\Exception;
use Stripe\Stripe;
use Wagnerwagner\Merx\Gateways;

require_once __DIR__."/../shop/CartFunctions.php";
require 'vendor/autoload.php';

// Provide custom payment method
Gateways::$gateways['stripe_custom'] = [];

if (merx()->cart()->isEmpty()) {
  go('/');
}
if (kirby()->request()->method() === 'POST') {
  try {
        $cart = cart();
        $kirby = kirby();

        CartFunctions::setStripeApiKey();

        if ($cart->count() <= 0) {
            throw new Exception([
                'key' => 'merx.emptycart',
                'httpCode' => 500,
                'details' => [
                    'message' => 'Cart contains zero items.',
                ],
                'data' => [
                    'cart' => $cart->toArray(),
                ],
            ]);
        }
        if ($kirby->user() == null) {
            throw new Exception([
                'key' => 'merx.nouser',
                'httpCode' => 500,
                'details' => [
                    'message' => 'No logged in user found.',
                ],
                'data' => [
                ],
            ]);
        }

      // Accepting a stripe payment
      // https://stripe.com/docs/payments/accept-a-payment?integration=elements

      $lineItems = array();
      foreach ($cart->data() as $item) {

          // TODO handle proper tax
          // https://stripe.com/docs/tax/checkout
          // $tax += (float)$item['quantity'] * ((float)$item['tax'] ?? 0);
          // Only collect tax when no UID is set

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
            'customer_email' => $kirby->user()->email(),
            'payment_method_types' => ['card', 'sofort'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => option('ww.merx.stripe.success.url'),
            'cancel_url' => option('ww.merx.stripe.cancel.url'),
        ];

      $session = \Stripe\Checkout\Session::create($stripeData);

      merx()->initializePayment([
          'paymentMethod' => 'stripe_custom',
          'stripeSessionId' => $session->id
      ]);

      $orderPage = merx()->completePayment();

      // TODO initialize payment to create virtual order page
      // TODO complete payment to create final order page
      // TODO set session id to order page content

      // TODO implement webhook to be called and set order page to paid!

        go($session->url);

  } catch (Exception $ex) {
        var_dump($ex);
  }
}