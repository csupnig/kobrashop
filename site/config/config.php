<?php
use Kirby\Exception\Exception;
require_once __DIR__."/../shop/CartFunctions.php";
require_once __DIR__."/../shop/AccountFunctions.php";
require_once __DIR__."/../shop/OrderFunctions.php";
require_once __DIR__."/stripe.config.php";
require_once __DIR__."/mailchimp.config.php";

return [
  'debug' => true,
  'mailchimp.api.key' => MailchimpConfig::getAPIKey(),
  'mailchimp.list.id' => MailchimpConfig::getListId(),
    'ww.merx.stripe.success.url' => 'https://dev1.millertwitchell.com/success',
    'ww.merx.stripe.cancel.url' => 'https://dev1.millertwitchell.com/cancel',
    'ww.merx.stripe.test.publishable_key' => StripeConfig::getTestPKey(),
    'ww.merx.stripe.test.secret_key' => StripeConfig::getTestSKey(),
    'ww.merx.stripe.live.publishable_key' => StripeConfig::getPKey(),
    'ww.merx.stripe.live.secret_key' => StripeConfig::getSKey(),
    'ww.merx.stripe.test.webhook_secret' => StripeConfig::getTestWebhookSecret(),
    'ww.merx.stripe.live.webhook_secret' => StripeConfig::getWebhookSecret(),
  'ww.merx.gateways' => [
    'empty-gateway' => [],
    'stripe_custom' => []
  ],
  'hooks' => [
    'ww.merx.cart' => function ($cart) {
        try {
            CartFunctions::handleCartDiscount($cart);
        } catch (\Exception $exception) {
            var_dump($exception);
        }
    },
      'ww.merx.initializePayment:before' => function($data, $cart) {
            //var_dump($data);
            //var_dump($cart);
      },
    'page.create:after' => function ($page) {
      //Copy product price to product variant on creation
      if ($page->intendedTemplate() == "productvariant") {
        $page->update([
          "price" => $page->parent()->price(),
          "tax" => $page->parent()->price()->toFloat()*$page->parent()->tax()->toFloat()
        ]); 
      }
    },
    'page.update:after' => function ($newPage, $oldPage) {
      //Copy product price to product variants on update
      if ($newPage->intendedTemplate() == "product") {
        foreach ($newPage->children()->filterBy("intendedTemplate", "productvariant") as $productvariant) {
          $productvariant->update([
              "price" => $newPage->price(),
              "tax" => $newPage->price()->toFloat()*$newPage->tax()->toFloat()
            ]);
        }
        foreach ($newPage->drafts()->filterBy("intendedTemplate", "productvariant") as $productvariant) {
          $productvariant->update([
              "price" => $newPage->price(),
              "tax" => $newPage->price()->toFloat()*$newPage->tax()->toFloat()
            ]);
        }
      }       
    },
    'page.delete:before' => function ($page) {
        // do something before a page gets deleted
    }
  ],
  'routes' => array_merge(
        CartFunctions::getRoutes(),
        AccountFunctions::getRoutes(),
        OrderFunctions::getRoutes(),
  []),
];
