<?php

namespace App\Console\Commands;

use App\Management\BestCompetitorProductManagement;
use App\Models\BestCompetitorProduct;
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
        $products = $productRepository->getList();
        foreach ($products as $product) {
            $productsWithSku = $productRepository->getBySku($product);

            foreach ($productsWithSku as $productWithSku) {
                $exist = $bestCompetitorProductManagement->checkSku($product);

                if($exist === false) {
                    $bestCompetitorProductFactory = BestCompetitorProduct::factory();
                    $bestCompetitorProduct = $bestCompetitorProductFactory->make([
                        'sku' => $productWithSku->sku,
                        'Titolo_Prodotto' => $productWithSku->titolo_prodotto,
                        'Winner_Competitor' => $productWithSku->competitor,
                        'Prezzo_di_Vendita' => $productWithSku->price,
                        'product_id' => $productWithSku->id,
                    ]);
                    $bestCompetitorProductRepository->save($bestCompetitorProduct);
                } else {
                    $bestCompetitorProduct = $bestCompetitorProductRepository->getBySku($productWithSku);
                    if($bestCompetitorProduct[0]->Prezzo_di_Vendita < $productWithSku->price) {
                        $bestCompetitorProduct[0]->Winner_Competitor = $productWithSku->competitor;
                        $bestCompetitorProduct[0]->Titolo_Prodotto = $productWithSku->titolo_prodotto;
                        $bestCompetitorProduct[0]->Prezzo_di_Vendita = $productWithSku->price;
                        $bestCompetitorProduct[0]->product_id = $productWithSku->id;

                        $bestCompetitorProductRepository->save($bestCompetitorProduct[0]);
                    }
                }
            }
        }
    }
}
