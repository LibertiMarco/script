<?php

namespace App\Api;

use App\Models\Product;

interface BestCompetitorProductManagementInterface
{
    public function checkSku(Product $product);
}
