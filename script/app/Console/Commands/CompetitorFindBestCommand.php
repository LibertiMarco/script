<?php

namespace App\Console\Commands;

use App\Management\BestCompetitorProductManagement;
use App\Repository\BestCompetitorProductRepository;
use App\Repository\ProductRepository;
use Illuminate\Console\Command;

class CompetitorFindBestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:competitor-find-best-command';

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
        ProductRepository $productRepository,
        BestCompetitorProductManagement $bestCompetitorProductManagement,
        BestCompetitorProductRepository $bestCompetitorProductRepository
    ) {
        $products = $productRepository->getList(); //Recupero di tutti i product
        foreach ($products as $product) { //Ciclo per scorrerli singolarmente
            $productsWithSku = $productRepository->getBySku($product); //Recuperiamo tutti i prodotti con quello sku (possono esserci N prodotti con lo stesso sku)

            foreach ($productsWithSku as $productWithSku) { //Scorriamo i prodotti con lo sku recuperato
                $exist = $bestCompetitorProductManagement->checkSku($product); //Controlliamo se esiste già questo sku nella tabella BestCompetitorProduct

                if($exist === false) { //Se non esiste lo creiamo
                    $bestCompetitorProduct = $bestCompetitorProductRepository->create(
                        $productWithSku->sku,
                        $productWithSku->titolo_prodotto,
                        $productWithSku->competitor,
                        $productWithSku->price,
                        $productWithSku->id
                    );
                    $bestCompetitorProductRepository->save($bestCompetitorProduct);
                }else {
                    $bestCompetitorProduct = $bestCompetitorProductRepository->getBySku($productWithSku); //se esiste lo recuperiamo
                    if($bestCompetitorProduct[0]->Prezzo_di_Vendita < $productWithSku->price) { //confrontiamo i prezzi e se il nuovo prodotto ha il prezzo migliore aggiorniamo i dati
                        $bestCompetitorProductRepository->update(
                            $bestCompetitorProduct[0],
                            $productWithSku->sku,
                            $productWithSku->titolo_prodotto,
                            $productWithSku->competitor,
                            $productWithSku->price,
                            $productWithSku->id
                        );
                        $bestCompetitorProductRepository->save($bestCompetitorProduct[0]);
                    }
                }
            }
        }
    }
}
