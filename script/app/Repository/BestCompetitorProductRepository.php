<?php

namespace App\Repository;

use App\Api\BestCompetitorProductRepositoryInterface;
use App\Models\BestCompetitorProduct;
use App\Models\Product;

class BestCompetitorProductRepository implements BestCompetitorProductRepositoryInterface
{

    public function getById(int $id)
    {
        return BestCompetitorProduct::find($id);
    }

    public function getBySku(Product $product)
    {
        return BestCompetitorProduct::where('sku','=',$product->sku)->get();
    }

    public function getList()
    {
        return BestCompetitorProduct::all();
    }

    public function save(BestCompetitorProduct $bestCompetitorProduct)
    {
        $bestCompetitorProduct->save();
    }

    public function delete(BestCompetitorProduct $bestCompetitorProduct)
    {
        $bestCompetitorProduct->delete();
    }
}
