<?php

namespace App\Management;

use App\Api\CompetitiveProductManagementInterface;
use App\Api\CompetitiveProductRepositoryInterface;
use App\Models\BestSupplier;
use App\Models\Product;

class CompetitiveProductManagement implements CompetitiveProductManagementInterface
{

    public function isCompetitiveProduct(BestSupplier $bestSuppliers)
    {
        $productsMediumPriceCiaravola = Product::where('competitor','=','www.ciaravola.it')->avg('price');
        $productsMediumPriceStrumentiMusicali = Product::where('competitor','=','www.strumentimusicali.net')->avg('price');

        if(($bestSuppliers->price < $productsMediumPriceCiaravola) && ($bestSuppliers->price < $productsMediumPriceStrumentiMusicali)){
            return true;
        } else{
            return false;
        }
    }
}
