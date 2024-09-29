<?php

namespace App\Repository;


use App\Api\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ProductRepository implements ProductRepositoryInterface
{

    public function create(
        String $sku,
        String $titolo_prodotto,
        String $price,
        String $competitor): Product
    {
        $productFactory = Product::factory();
        $product = $productFactory->make([
            'sku' => $sku,
            'titolo_prodotto' => $titolo_prodotto,
            'price' => $price,
            'competitor' => $competitor
        ]);
        return $product;
    }

    public function getById(int $id): Product
    {
        return Product::find($id);
    }

    public function getBySku(Product $product): Product
    {
        return Product::where('sku','=',$product->sku)->get();
    }

    public function getList(): Collection
    {
        return Product::all();
    }

    public function getListByFile(
        String $filePath,
        String $driver,
        String $mode): array
    {
        if($mode === 'HTTP') {
            $response = Http::get($filePath);
        }
        if ((Storage::disk($driver)->exists($filePath) && $mode==='standard')||($response->successful() && $mode==='HTTP')) {
            if($mode === 'standard') {
                $csvContent = Storage::disk($driver)->get($filePath);
            }else {
                $csvContent = $response->body();
            }

            $handle = fopen('php://memory', 'r+');
            fwrite($handle, $csvContent);
            rewind($handle);  // Torna all'inizio del file
            $data = [];
            $header = fgetcsv($handle, 1000, '|');

            while (($row = fgetcsv($handle, 1000, '|')) !== false) {
                $data[] = array_combine($header, $row);
            }

            fclose($handle);
        }else {
            echo 'File non trovato';
        }
        return $data;
    }

    public function update(
        Product $product,
        String $sku,
        String $titolo_prodotto,
        String $price,
        String $competitor): void
    {
        $product->sku = $sku;
        $product->titolo_prodotto  = $titolo_prodotto;
        $product->price = $price;
        $product->competitor  = $competitor;
    }

    public function save(Product $product): void
    {
        $product->save();
    }

    public function delete(Product $product): void
    {
        $product->delete();
    }
}
