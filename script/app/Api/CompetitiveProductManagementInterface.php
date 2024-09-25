<?php

namespace App\Api;

use App\Models\BestSupplier;

interface CompetitiveProductManagementInterface
{
    public function isCompetitiveProduct(BestSupplier $bestSuppliers);
}
