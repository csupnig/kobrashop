<?php


class AccountFunctions
{
    public static function getRoutes() {
        return [
            [
                'pattern' => 'account',
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
        try {
            $kirby = kirby();
            $kirby->impersonate('kirby');
            $user = $kirby->users()->create([
                'name'      => get('billing_first_name'),
                'lastname'  => get('billing_last_name'),
                'email'     => get('email'),
                'password'  => get('password'),
                'language'  => 'de',
                'role'      => 'customer',
                'content'   => [
                    'birthdate' => '1989-01-29',
                    'addresses' => json_encode(get('addresses'))
                ]
            ]);

            echo json_encode($user);

        } catch(Exception $e) {

            echo 'The user could not be created';
            echo $e->getMessage();

        }
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
        $addresses = null;
        if (isset($user)) {
            $role = $user->roles();
            $addresses = json_decode($user->addresses());
        }
        echo json_encode(array("loggedin" => isset($user), "role" => $role, "addresses" => $addresses));
    }
}
