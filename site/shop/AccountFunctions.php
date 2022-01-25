<?php

require_once __DIR__."/MailchimpFunctions.php";

class AccountFunctions
{
    public static function getRoutes() {
        return [
            [
                'pattern' => 'account',
                'method' => 'post',
                'action'  => function() {
                    return AccountFunctions::createUser();
                },
            ],
            [
                'pattern' => 'account',
                'method' => 'get',
                'action'  => function() {
                    return AccountFunctions::getAccount();
                },
            ],
            [
                'pattern' => 'account/addresses',
                'method' => 'put',
                'action'  => function() {
                    return  AccountFunctions::saveAddresses();
                },
            ],
            [
                'pattern' => 'account/logout',
                'method' => 'put',
                'action'  => function() {
                    return  AccountFunctions::logout();
                },
            ],
            [
                'pattern' => 'account/login',
                'method' => 'put',
                'action'  => function() {
                    return AccountFunctions::login();
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
                    'business' => get('business'),
                    'uid' => get('uid'),
                    'addresses' => json_encode(get('addresses'))
                ]
            ]);

            if (get('news_subscription') == 'true') {
                $company = "".get('billing_company');
                $usermail = get('email');
                MailchimpFunctions::registerUser(get('billing_first_name'), get('billing_last_name'), $company, $usermail);
            }

            return json_encode($user);

        } catch(Exception $e) {

            echo 'The user could not be created';
            echo $e->getMessage();

        }
    }

    public static function saveAddresses() {
        try {
            $kirby = kirby();

            $addresses = json_encode(get('addresses'));

            $kirby->user()->update(['addresses' => $addresses]);
            return self::getAccount();

        } catch(Exception $e) {

            echo 'The addresses could not be saved';
            echo $e->getMessage();

        }
    }

    public static function logout() {

        if ($user = kirby()->user()) {
            $user->logout();
        }
        return self::getAccount();
    }

    public static function login() {


        kirby()->auth()->login(get('username'), get('password'));


        return self::getAccount();
    }

    public static function isCompanyCustomer() {
            $kirby = kirby();
            if ($kirby && $kirby->user() !== null) {
                $user = $kirby->user();
                $firma = $user->business() !== null && $user->business()->toString() == 'true';
                return $firma;
            }
            return false;
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
        return json_encode(array("loggedin" => isset($user), "role" => $role, "addresses" => $addresses));
    }
}
