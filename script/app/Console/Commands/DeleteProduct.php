<?php

namespace App\Console\Commands;

use App\Repository\ProductRepository;
use Illuminate\Console\Command;

class DeleteProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-product';

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
    )
    {
        $idProduct = $this->ask('Inserisci l\'id del prodotto che vuoi eliminare');
        $product = $productRepository->getById($idProduct);
        $productRepository->delete($product);
        echo "Prodotto eliminato correttamente";
    }
}
