<?php

namespace App\Api;

use App\Models\CompetitiveProduct;

Interface CompetitiveProductRepositoryInterface
{
    public function create(String $sku, String $nomeProdotto, bool $is_competitive_product, Float $price);
    public function getById(int $id);
    public function getList();
    public function update(CompetitiveProduct $competitiveProduct, String $sku, String $nomeProdotto, bool $is_competitive_product, Float $price);
    public function save(CompetitiveProduct $competitiveProduct);
    public function delete(CompetitiveProduct $competitiveProduct);
}
