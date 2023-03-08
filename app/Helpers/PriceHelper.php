<?php

namespace App\Helpers;

class PriceHelper
{
    public static function format($price)
    {
        $price = (int) $price;

        return "Rp " . number_format($price, 2, ',', '.');
    }
}
