<?php

namespace App\Console\Commands;

use App\Repository\ProductRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CreateProductCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(
        ProductRepository $productRepository
    ) {
        $faker = \Faker\Factory::create('it_IT');
        $productsLocal = "|sku|titolo_prodotto|prezzo| \n";
        $productsFTP = "|codice|titolo|price| \n";
        for ($i = 0; $i < 100; $i++){
            $product = $productRepository->create($faker->uuid(), $faker->name, random_int(100,2500), $faker->company);
            $productsLocal = $productsLocal . "|" . $product->sku . "|" . $product->titolo_prodotto . "|" . $product->price . "| \n";
            $productsFTP = $productsFTP . "|" . $product->sku . "|" . $product->titolo_prodotto . "|" . $product->price . "| \n";
            $productRepository->save($product);
        }
        //Alternare i due per non far creare gli stessi
        //Storage::disk('local')->put('products.csv',$productsLocal);
        Storage::disk('ftp')->put('products.csv',$productsFTP);
    }
}
