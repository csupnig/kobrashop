<?php


class CartFunctions
{
    public static function getRoutes() {
        return [
            [
                'pattern' => 'cart',
                'method' => 'post',
                'action'  => function() {
                    CartFunctions::addToCart();
                },
            ],
            [
                'pattern' => 'cart',
                'method' => 'put',
                'action'  => function() {
                    CartFunctions::updateQuantity();
                },
            ],
            [
                'pattern' => 'cart',
                'method' => 'get',
                'action'  => function() {
                    CartFunctions::getCart();
                },
            ],
            [
                'pattern' => 'cart',
                'method' => 'delete',
                'action'  => function() {
                    CartFunctions::removeFromCart();
                },
            ],
        ];
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
        self::getCart();
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
        self::getCart();
    }

    public static function removeFromCart() {
        $id = get('id');

        cart()->remove($id);
        self::getCart();
    }

    public static function getCart() {
        header('Content-type: application/json');
        echo json_encode(array("items" => array_values(cart()->toArray()), "sum" => cart()->getSum(), "tax" => cart()->getTax()));
    }
}
