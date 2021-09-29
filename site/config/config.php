<?php
use Kirby\Exception\Exception;
require_once __DIR__."/../shop/CartFunctions.php";
require_once __DIR__."/../shop/AccountFunctions.php";

return [
  'debug' => true,
  'ww.merx.gateways' => [
    'empty-gateway' => [],
  ],
    'hooks' => [
        'ww.merx.cart' => function ($cart) {

        }
    ],
  'routes' => array_merge(
        CartFunctions::getRoutes(),
        AccountFunctions::getRoutes(),
  []),
];
