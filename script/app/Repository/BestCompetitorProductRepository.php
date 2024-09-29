<?php

namespace App\Repository;

use App\Api\BestCompetitorProductRepositoryInterface;
use App\Models\BestCompetitorProduct;
use App\Models\Product;

class BestCompetitorProductRepository implements BestCompetitorProductRepositoryInterface
{

    public function create(
        String $sku,
        String $Titolo_Prodotto,
        String $Winner_Competitor,
        String $Prezzo_di_Vendita,
        String $product_id): BestCompetitorProduct
    {
        $bestCompetitorProductFactory = BestCompetitorProduct::factory();
        $bestCompetitorProduct = $bestCompetitorProductFactory->make([
            'SKU' => $sku,
            'Titolo_Prodotto' => $Titolo_Prodotto,
            'Winner_Competitor' => $Winner_Competitor,
            'Prezzo_di_Vendita' => $Prezzo_di_Vendita,
            'product_id' => $product_id,
        ]);

        return $bestCompetitorProduct;
    }

    public function getById(int $id): BestCompetitorProduct
    {
        return BestCompetitorProduct::find($id);
    }

    public function getBySku(Product $product): BestCompetitorProduct
    {
        return BestCompetitorProduct::where('sku','=',$product->sku)->get();
    }

    public function getList(): \Illuminate\Database\Eloquent\Collection
    {
        return BestCompetitorProduct::all();
    }

    public function update(
        BestCompetitorProduct $bestCompetitorProduct,
        String $sku,
        String $titoloProdotto,
        String $winnerCompetitor,
        String $Prezzo_di_Vendita,
        String $product_id): void
    {
        $bestCompetitorProduct->SKU = $sku;
        $bestCompetitorProduct->Titolo_Prodotto = $titoloProdotto;
        $bestCompetitorProduct->Winner_Competitor = $winnerCompetitor;
        $bestCompetitorProduct->Prezzo_di_Vendita = $Prezzo_di_Vendita;
        $bestCompetitorProduct->product_id = $product_id;
    }

    public function save(BestCompetitorProduct $bestCompetitorProduct): void
    {
        $bestCompetitorProduct->save();
    }

    public function delete(BestCompetitorProduct $bestCompetitorProduct): void
    {
        $bestCompetitorProduct->delete();
    }
}
