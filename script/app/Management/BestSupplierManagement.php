<?php

namespace App\Management;

use App\Models\BestSupplier;

class BestSupplierManagement
{

    public function checkSku(String $sku)
    {
        $existProduct = BestSupplier::where('SKU','=',$sku)->get();
        if(sizeof($existProduct) > 0){
            $exist = true;
        } else {
            $exist = false;
        }
        return $exist;
    }
}
