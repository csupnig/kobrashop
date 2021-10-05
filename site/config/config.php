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

    },
    'page.create:after' => function ($page) {
      //Copy product price to product variant on creation
      if ($page->intendedTemplate() == "productvariant") {
        $page->update([
          "price" => $page->parent()->price()
        ]); 
      }
    },
    'page.update:after' => function ($newPage, $oldPage) {
      //Copy product price to product variants on update
      if ($newPage->intendedTemplate() == "product") {
        foreach ($newPage->children()->filterBy("intendedTemplate", "productvariant") as $productvariant) {
          $productvariant->update([
              "price" => $newPage->price()
            ]);
        }
        foreach ($newPage->drafts()->filterBy("intendedTemplate", "productvariant") as $productvariant) {
          $productvariant->update([
              "price" => $newPage->price()
            ]);
        }
      }       
    },
    'page.delete:before' => function ($page) {
        // do something before a page gets deleted
    }
  ],
  'routes' => array_merge(
        CartFunctions::getRoutes(),
        AccountFunctions::getRoutes(),
  []),
];
