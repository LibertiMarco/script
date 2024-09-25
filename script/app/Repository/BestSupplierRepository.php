<?php

namespace App\Repository;

use App\Api\BestSupplierRepositoryInterface;
use App\Models\BestSupplier;

class BestSupplierRepository implements BestSupplierRepositoryInterface
{

    public function create(String $sku, String $title, String $price, String $supplier)
    {
        $bestSupplierFactory = BestSupplier::factory();
        $bestSupplier = $bestSupplierFactory->make([
            'sku' => $sku,
            'title' => $title,
            'price' => $price,
            'winner_supplier' => $supplier,
        ]);
        return $bestSupplier;
    }

    public function getById(int $id)
    {
        return BestSupplier::find($id);
    }

    public function getBySku(string $sku)
    {
        return BestSupplier::where('sku','=',$sku)->get();
    }

    public function getList()
    {
        return BestSupplier::all();
    }

    public function update(BestSupplier $bestSupplier, String $sku, String $title, String $price, String $winnerSupplier)
    {
        $bestSupplier->sku = $sku;
        $bestSupplier->title = $title;
        $bestSupplier->price = $price;
        $bestSupplier->winner_supplier = $winnerSupplier;
    }

    public function save(BestSupplier $bestSupplier)
    {
        $bestSupplier->save();
    }

    public function delete(BestSupplier $bestSupplier)
    {
        $bestSupplier->delete();
    }
}
