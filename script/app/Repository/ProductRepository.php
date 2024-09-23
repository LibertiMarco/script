<?php

namespace App\Repository;


use App\Api\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{

    public function getById(int $id)
    {
        return Product::find($id);
    }

    public function getBySku(Product $product)
    {
        return Product::where('sku','=',$product->sku)->get();
    }

    public function getList()
    {
        return Product::all();
    }

    public function save(Product $product)
    {
        $product->save();
    }

    public function delete(Product $product)
    {
        $product->delete();
    }
}
