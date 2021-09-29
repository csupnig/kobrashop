<?php


class AccountFunctions
{
    public static function getRoutes() {
        return [
            [
                'pattern' => 'user',
                'method' => 'post',
                'action'  => function() {
                    AccountFunctions::createUser();
                },
            ],
        ];
    }

    public static function createUser() {
        header('Content-type: application/json');
        echo json_encode(array("items" => array_values(cart()->toArray()), "sum" => cart()->getSum(), "tax" => cart()->getTax()));
    }

    public static function getCart() {
        header('Content-type: application/json');
        echo json_encode(array("items" => array_values(cart()->toArray()), "sum" => cart()->getSum(), "tax" => cart()->getTax()));
    }
}
