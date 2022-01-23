<?php
use Stripe\Stripe;
require 'vendor/autoload.php';

class CartFunctions
{
    public static function getRoutes() {
        return [
            [
                'pattern' => 'checkoutoverview',
                'method' => 'post',
                'action'  => function() {
                    return CartFunctions::generateCheckoutOverview();
                },
            ],
            [
                'pattern' => 'cart',
                'method' => 'post',
                'action'  => function() {
                    return CartFunctions::addToCart();
                },
            ],
            [
                'pattern' => 'cart',
                'method' => 'put',
                'action'  => function() {
                    return CartFunctions::updateQuantity();
                },
            ],
            [
                'pattern' => 'cart',
                'method' => 'get',
                'action'  => function() {
                    return CartFunctions::getCart();
                },
            ],
            [
                'pattern' => 'cart',
                'method' => 'delete',
                'action'  => function() {
                    return CartFunctions::removeFromCart();
                },
            ],
        ];
    }

    public static function initCheckout() {

        return '';
    }

    public static function setStripeApiKey() {
        if (option('ww.merx.production') === true) {
            Stripe::setApiKey(option('ww.merx.stripe.live.secret_key'));
        } else {
            Stripe::setApiKey(option('ww.merx.stripe.test.secret_key'));
        }
    }

    public static function getStripeWebhookSecret() {
        if (option('ww.merx.production') === true) {
            return option('ww.merx.stripe.live.webhook_secret');
        } else {
            return option('ww.merx.stripe.test.webhook_secret');
        }
    }

    public static function handleCartDiscount($cart) {
        if ($cart->count() > 0) {
            $cart->remove('discount');

            $kirby = kirby();
            $user = $kirby->user();
            if (isset($user)) {
                $discount = $user->discount()->toFloat();
                if (isset($discount) && $discount > 0) {
                    $cart->add(['id' => 'discount', 'price' => -$cart->getSum() * $discount]);
                }
            }
        }
    }

    public static function handleCartShipping($cart, $country) {
        if ($cart->count() > 0) {
            $cart->remove('shipping');

            $kirby = kirby();
            $site = $kirby->site();
            $user = $kirby->user();
            if (isset($user)) {
                $shippingPage = $site->index()->filterBy("intendedTemplate", "shippingcountry")->findBy('title', 'Austria');

                $weight = 0;
                foreach ($cart->data() as $item) {
                    if ($item['id'] !== 'shipping' && $item['id'] !== 'discount') {
                        $page = page($item['id']);
                        $product = $page->parent();
                        $weight += $item['quantity'] * $product->weight()->toInt();
                    }
                }

                $shippingprice = self::getShippingPrice($weight, $shippingPage);

                $cart->add(['id' => 'shipping', 'price' => $shippingprice]);

            }
        }
    }

    public static function getShippingPrice($weightInGramms, $shippingpage) {
        if ($weightInGramms <= 3000) {
            return floatval($shippingpage->shipping3()->toString());
        } else if ($weightInGramms <= 5000) {
            return floatval($shippingpage->shipping5()->toString());
        } else if ($weightInGramms <= 10000) {
          return floatval($shippingpage->shipping10()->toString());
        } else if ($weightInGramms <= 15000) {
          return floatval($shippingpage->shipping15()->toString());
        } else if ($weightInGramms <= 20000) {
          return floatval($shippingpage->shipping20()->toString());
        } else if ($weightInGramms <= 25000) {
          return floatval($shippingpage->shipping25()->toString());
        } else if ($weightInGramms <= 30000) {
            return floatval($shippingpage->shipping30()->toString());
      } else if ($weightInGramms <= 40000) {
        return floatval($shippingpage->shipping40()->toString());
      } else if ($weightInGramms <= 50000) {
       return floatval($shippingpage->shipping50()->toString());
      } else if ($weightInGramms <= 60000) {
       return floatval($shippingpage->shipping60()->toString());
      } else if ($weightInGramms <= 70000) {
       return floatval($shippingpage->shipping70()->toString());
      } else {
        // TODO calculate
        $shipping70 = floatval($shippingpage->shipping70()->toString());
        $shippingextra = floatval($shippingpage->shippingextra()->toString());
        $restweight = $weightInGramms - 70000;
        return $shipping70 + ceil($restweight / 1000) * $shippingextra;
      }

    }

    public static function removeShipping($cart) {
        if ($cart->count() > 0) {
            $cart->remove('shipping');
        }
    }

    public static function generateCheckoutOverview() {


        CartFunctions::handleCartShipping(cart(), $country);

        return self::getCart();
    }

    public static function addToCart() {
        $id = get('id');
        $quantity = get('quantity');
        $color = get('color');
        $name = get('name');
        $articleid = get('articleid');
        $cart = cart();
        CartFunctions::removeShipping($cart);
        $cart->add([
            'id' => $id,
            'quantity' => 0 + $quantity,
            'color' => $color,
            'title' => $name,
            'articleid' => $articleid
        ]);
        return self::getCart();
    }

    public static function updateQuantity() {
        $id = get('id');
        $quantity = get('quantity');
        $cart = cart();
        CartFunctions::removeShipping($cart);
        if (0 + $quantity <= 0) {
            $cart->remove('discount');
            $cart->remove($id);
        } else {
            $cart->updateItem([
                'id' => $id,
                'quantity' => 0 + $quantity
            ]);
        }
        return self::getCart();
    }

    public static function removeFromCart() {
        $id = get('id');
        $cart = cart();
        CartFunctions::removeShipping($cart);
        $cart->remove('discount');
        $cart->remove($id);
        return self::getCart();
    }

    public static function getCart() {
        header('Content-type: application/json');

        return json_encode(array("items" => array_values(cart()->toArray()), "sum" => cart()->getSum(), "tax" => cart()->getTax()));
    }
}
