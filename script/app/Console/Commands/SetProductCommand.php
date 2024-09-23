<?php

namespace App\Console\Commands;

use App\Repository\ProductRepository;
use Illuminate\Console\Command;

class SetProductCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:set-product';

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
        $idProduct = $this->ask('Inserisci l\'id del prodotto che vuoi modificare: ');

        $product = $productRepository->getById($idProduct);

        $product->sku = $faker->uuid();
        $product->titolo_prodotto = $faker->name;
        $product->price = random_int(100,2500);
        $product->competitor = $faker->company;

        $productRepository->save($product);
    }
}
