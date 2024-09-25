<?php

namespace App\Api;

use App\Models\BestSupplier;

interface BestSupplierRepositoryInterface
{
    public function create(String $sku, String $title, String $price, String $supplier);
    public function getById(int $id);
    public function getBySku(String $sku);
    public function getList();
    public function update(BestSupplier $bestSupplier, String $sku, String $title, String $price, String $supplier);
    public function save(BestSupplier $bestSupplier);
    public function delete(BestSupplier $bestSupplier);
}
