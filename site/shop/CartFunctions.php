<?php


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
            $user = $kirby->user();
            if (isset($user)) {
                $cart->add(['id' => 'shipping', 'price' => 20]);

            }
        }
    }

    public static function removeShipping($cart) {
        if ($cart->count() > 0) {
            $cart->remove('shipping');
        }
    }

    public static function generateCheckoutOverview() {

        $country = get('billing_country');
        CartFunctions::handleCartShipping(cart(), $country);

        return self::getCart();
    }

    public static function addToCart() {
        $id = get('id');
        $quantity = get('quantity');
        $color = get('color');
        $articleid = get('articleid');
        $cart = cart();
        CartFunctions::removeShipping($cart);
        $cart->add([
            'id' => $id,
            'quantity' => 0 + $quantity,
            'color' => $color,
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
        $cart->remove($id);
        return self::getCart();
    }

    public static function getCart() {
        header('Content-type: application/json');
        return json_encode(array("items" => array_values(cart()->toArray()), "sum" => cart()->getSum(), "tax" => cart()->getTax()));
    }
}
