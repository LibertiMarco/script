<?php

namespace App\Repository;

use App\Api\CompetitiveProductRepositoryInterface;
use App\Models\CompetitiveProduct;
use Illuminate\Database\Eloquent\Collection;

class CompetitiveProductRepository implements CompetitiveProductRepositoryInterface
{

    public function create(
        string $sku,
        string $nomeProdotto,
        bool $isCompetitiveProduct,
        float $price): CompetitiveProduct
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

    public function getById(int $id): CompetitiveProduct
    {
        return CompetitiveProduct::find($id);
    }

    public function getList(): Collection
    {
        return CompetitiveProduct::all();
    }

    public function update(
        CompetitiveProduct $competitiveProduct,
        string $sku,
        string $nomeProdotto,
        bool $is_competitive_product,
        float $price): void
    {
        $competitiveProduct->sku = $sku;
        $competitiveProduct->nome_prodotto = $nomeProdotto;
        $competitiveProduct->is_competitive_product = $is_competitive_product;
        $competitiveProduct->price = $price;
    }

    public function save(CompetitiveProduct $competitiveProduct): void
    {
        $competitiveProduct->save();
    }

    public function delete(CompetitiveProduct $competitiveProduct): void
    {
        $competitiveProduct->delete();
    }
}
