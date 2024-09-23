<?php

namespace App\Api;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function getById(int $id);
    public function getBySku(Product $product);
    public function getList();
    public function save(Product $product);
    public function delete(Product $product);
}
