<?php

namespace App\Management;

use App\Api\ProductManagementInterface;
use Laravel\Nova\Fields\Number;

class ProductManagement implements ProductManagementInterface
{

    public function castPrice(string $priceString, $strlen, $offset): int|string
    {
        if(strlen($priceString) === $strlen) {
            $price = substr($priceString, $offset,1).substr($priceString, $offset+2,3).".".substr($priceString, $offset+6,2);
        }else if (strlen($priceString) === $strlen-2) {
            $price = substr($priceString, $offset,3).".".substr($priceString, $offset+4,2);
        }else if (strlen($priceString) === $strlen-3) {
            $price = substr($priceString, $offset,2).".".substr($priceString, $offset+3,2);
        }else {
            $price = 0;
        }
        return $price;
    }

}
