<?php

namespace App\Console\Commands;

use App\Models\Product;
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

        $productRepository->update(
            $product,
            $faker->uuid(),
            $faker->name,
            random_int(100,2500),
            $faker->company
        );

        $productRepository->save($product);
    }
}
