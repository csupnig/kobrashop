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
  []),
];
