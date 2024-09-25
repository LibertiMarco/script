<?php

namespace App\Api;

use App\Models\BestCompetitorProduct;
use App\Models\Product;

interface BestCompetitorProductRepositoryInterface
{
    public function create(String $sku, String $Titolo_Prodotto, String $Winner_Competitor, String $Prezzo_di_Vendita, String $product_id);
    public function getById(int $id);
    public function getBySku(Product $product);
    public function getList();
    public function update(BestCompetitorProduct $bestCompetitorProduct, String $sku, String $titoloProdotto, String $winnerCompetitor, String $Prezzo_di_Vendita, String $product_id);
    public function save(BestCompetitorProduct $bestCompetitorProduct);
    public function delete(BestCompetitorProduct $bestCompetitorProduct);
}
