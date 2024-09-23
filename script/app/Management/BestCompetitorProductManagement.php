<?php

namespace App\Management;

use App\Api\BestCompetitorProductManagementInterface;
use App\Models\BestCompetitorProduct;
use App\Models\Product;

class BestCompetitorProductManagement implements BestCompetitorProductManagementInterface
{

    public function checkSku(Product $product)
    {
        $existProduct = BestCompetitorProduct::where('SKU','=',$product->sku)->get();
        if(sizeof($existProduct) > 0){
            $exist = true;
        } else {
            $exist = false;
        }
        return $exist;
    }
}
