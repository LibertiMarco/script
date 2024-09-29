<?php

namespace App\Repository;

use App\Api\BestSupplierRepositoryInterface;
use App\Models\BestSupplier;
use Illuminate\Database\Eloquent\Collection;

class BestSupplierRepository implements BestSupplierRepositoryInterface
{

    public function create(
        String $sku,
        String $title,
        String $price,
        String $supplier): BestSupplier
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

    public function getById(int $id): BestSupplier
    {
        return BestSupplier::find($id);
    }

    public function getBySku(string $sku): BestSupplier
    {
        return BestSupplier::where('sku','=',$sku)->get();
    }

    public function getList(): Collection
    {
        return BestSupplier::all();
    }

    public function update(
        BestSupplier $bestSupplier,
        String $sku,
        String $title,
        String $price,
        String $winnerSupplier): void
    {
        $bestSupplier->sku = $sku;
        $bestSupplier->title = $title;
        $bestSupplier->price = $price;
        $bestSupplier->winner_supplier = $winnerSupplier;
    }

    public function save(BestSupplier $bestSupplier): void
    {
        $bestSupplier->save();
    }

    public function delete(BestSupplier $bestSupplier): void
    {
        $bestSupplier->delete();
    }
}
