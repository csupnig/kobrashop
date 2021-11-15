<?php


class CartFunctions
{
    public static function getRoutes() {
        return [
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

    public static function handleCartDiscount($cart) {
        if ($cart->count() > 0) {
            $cart->remove('shipping');
            $cart->remove('discount');

            $kirby = kirby();
            $discount = $kirby->user()->discount()->toFloat();
            if (isset($discount) && $discount > 0) {
                $cart->add(['id' => 'discount', 'price' => -$cart->getSum() * $discount]);
            }
        }
    }

    public static function addToCart() {
        $id = get('id');
        $quantity = get('quantity');
        $color = get('color');
        $articleid = get('articleid');
        cart()->add([
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
        if (0 + $quantity <= 0) {
            cart()->remove($id);
        } else {
            cart()->updateItem([
                'id' => $id,
                'quantity' => 0 + $quantity
            ]);
        }
        return self::getCart();
    }

    public static function removeFromCart() {
        $id = get('id');

        cart()->remove($id);
        return self::getCart();
    }

    public static function getCart() {
        header('Content-type: application/json');
        return json_encode(array("items" => array_values(cart()->toArray()), "sum" => cart()->getSum(), "tax" => cart()->getTax()));
    }
}
