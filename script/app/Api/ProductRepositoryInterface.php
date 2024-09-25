<?php

namespace App\Api;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function create(String $sku, String $titolo_prodotto, String $price, String $competitor);
    public function getById(int $id);
    public function getBySku(Product $product);
    public function getList();
    public function getListByFile(String $filePath, String $driver, String $mode);
    public function update(Product $product, String $sku, String $titolo_prodotto, String $price, String $competitor);
    public function save(Product $product);
    public function delete(Product $product);
}
