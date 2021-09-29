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
            [
                'pattern' => 'account',
                'method' => 'get',
                'action'  => function() {
                    AccountFunctions::getAccount();
                },
            ],
            [
                'pattern' => 'account/logout',
                'method' => 'put',
                'action'  => function() {
                    AccountFunctions::logout();
                },
            ],
            [
                'pattern' => 'account/login',
                'method' => 'put',
                'action'  => function() {
                    AccountFunctions::login();
                },
            ],
        ];
    }

    public static function createUser() {
        header('Content-type: application/json');
        echo json_encode(array("items" => array_values(cart()->toArray()), "sum" => cart()->getSum(), "tax" => cart()->getTax()));
    }

    public static function logout() {

        if ($user = kirby()->user()) {
            $user->logout();
        }
        self::getAccount();
    }

    public static function login() {


        kirby()->auth()->login(get('username'), get('password'));


        self::getAccount();
    }

    public static function getAccount() {
        header('Content-type: application/json');
        $user = kirby()->user();
        $role = null;
        if (isset($user)) {
            $role = $user->roles();
        }
        echo json_encode(array("loggedin" => isset($user), "role" => $role));
    }
}
