<?php

namespace App\Management;

use App\Api\CompetitiveProductManagementInterface;
use App\Api\CompetitiveProductRepositoryInterface;
use App\Models\BestSupplier;
use App\Models\Product;
use Laravel\Nova\Fields\Boolean;

class CompetitiveProductManagement implements CompetitiveProductManagementInterface
{

    public function isCompetitiveProduct(BestSupplier $bestSuppliers): Boolean
    {
        $productsMediumPriceCiaravola = Product::where('competitor','=','www.ciaravola.it')
            ->avg('price');
        $productsMediumPriceStrumentiMusicali = Product::where('competitor','=','www.strumentimusicali.net')
            ->avg('price');

        if($productsMediumPriceCiaravola < $productsMediumPriceStrumentiMusicali) {
            $productsMediumPriceMinor = $productsMediumPriceCiaravola;
        }else {
            $productsMediumPriceMinor = $productsMediumPriceStrumentiMusicali;
        }

        if($bestSuppliers->price < $productsMediumPriceMinor) {
            return true;
        }else {
            return false;
        }
    }
}
