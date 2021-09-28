<?php
use Kirby\Exception\Exception;
require_once __DIR__."/../shop/CartFunctions.php";

return [
  'debug' => true,
  'ww.merx.gateways' => [
    'empty-gateway' => [],
  ],
  'routes' => array_merge(
      CartFunctions::getRoutes(),
      [
    [
      'pattern' => 'add',
      'method' => 'post',
      'action'  => function () {
        $id = get('id');
        $quantity = get('quantity');
        $url = get('url');
        try {
          cart()->add([
            'id' => $id,
            'quantity' => $quantity,
          ]);
          if (isset($url)) {
              go($url."#cartopen");
          } else {
            go('/');
          }
        } catch (Exception $ex) {
          return $ex->getMessage();
        }
      },
    ],

  ]),
];
