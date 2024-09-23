<?php

namespace App\Console\Commands;

use App\Models\Product;
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
        $products = "| sku | titolo_prodotto | prezzo | \n";
        $productFactory = Product::factory();
        for ($i = 0; $i < 100; $i++){
            $product = $productFactory->make([
                'sku' => $faker->uuid(),
                'titolo_prodotto' => $faker->name,
                'price' => random_int(100,2500),
                'competitor' => $faker->company
            ]);
            $products = $products . "|" . $product->sku . "|" . $product->titolo_prodotto . "|" . $product->price . "| \n";
            //$productRepository->save($product);
        }
        Storage::disk('local')->put('products.csv',$products);
        //Storage::disk('ftp')->put('products.csv',$products);
    }
}
