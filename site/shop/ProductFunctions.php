<?php

class ProductFunctions
{
    public static function getNetPrice($productPage) {
        $price = 0;
        if ($productPage !== null && $productPage->price() != null) {
            $price = 0 + (float) $productPage->price()->toFloat();
        }
        return $price;
    }

    public static function getGrossPrice($productPage) {
        $price = self::getNetPrice($productPage);
        if ($productPage != null && $productPage->tax() != null) {
            $price = $price + (float) $productPage->tax()->toFloat();
        }
        return $price;
    }
}
