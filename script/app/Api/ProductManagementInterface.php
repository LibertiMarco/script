<?php

namespace App\Api;

use App\Models\Product;

interface ProductManagementInterface
{
    public function castPrice(string $priceString, int $strlen, int $offset);
}
