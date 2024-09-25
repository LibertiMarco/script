<?php

namespace App\Repository;

use App\Api\CompetitiveProductRepositoryInterface;
use App\Models\CompetitiveProduct;

class CompetitiveProductRepository implements CompetitiveProductRepositoryInterface
{

    public function create(string $sku, string $nomeProdotto, bool $isCompetitiveProduct, float $price)
    {
        $competitiveProductFactory = CompetitiveProduct::factory();
        $competitiveProduct = $competitiveProductFactory->create([
            'sku' => $sku,
            'nome_prodotto' => $nomeProdotto,
            'is_competitive_product' => $isCompetitiveProduct,
            'price' => $price,
        ]);
        return $competitiveProduct;
    }

    public function getById(int $id)
    {
        CompetitiveProduct::find($id);
    }

    public function getList()
    {
        CompetitiveProduct::all();
    }

    public function update(CompetitiveProduct $competitiveProduct, string $sku, string $nomeProdotto, bool $is_competitive_product, float $price)
    {
        $competitiveProduct->sku = $sku;
        $competitiveProduct->nome_prodotto = $nomeProdotto;
        $competitiveProduct->is_competitive_product = $is_competitive_product;
        $competitiveProduct->price = $price;
    }

    public function save(CompetitiveProduct $competitiveProduct)
    {
        $competitiveProduct->save();
    }

    public function delete(CompetitiveProduct $competitiveProduct)
    {
        $competitiveProduct->delete();
    }
}
