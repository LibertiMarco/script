<?php

namespace App\Api;

use App\Models\BestCompetitorProduct;
use App\Models\Product;

interface BestCompetitorProductRepositoryInterface
{
    public function getById(int $id);
    public function getBySku(Product $product);
    public function getList();
    public function save(BestCompetitorProduct $bestCompetitorProduct);
    public function delete(BestCompetitorProduct $bestCompetitorProduct);
}
