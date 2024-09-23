<?php

namespace App\Console\Commands;

use App\Repository\ProductRepository;
use Illuminate\Console\Command;

class ReadProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:read-product';

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
        $idProduct = $this->ask('Inserisci l\'id del prodotto che vuoi visualizzare');
        $product = $productRepository->getById($idProduct);

        echo "\n Titolo Prodotto: " . $product->titolo_prodotto . " - SKU: " . $product->sku . " - price: " . $product->price . " - competitor: " . $product->competitor;
    }
}
