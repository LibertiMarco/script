<?php

namespace App\Console\Commands;

use App\Management\CompetitiveProductManagement;
use App\Repository\BestSupplierRepository;
use App\Repository\CompetitiveProductRepository;
use Illuminate\Console\Command;

class CompetitiveProductCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:competitive-product-command';

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
        CompetitiveProductManagement $competitiveProductManagement,
        BestSupplierRepository $bestSupplierRepository,
        CompetitiveProductRepository $competitiveProductRepository
    ) {
        $bestSuppliers = $bestSupplierRepository->getList(); //Recupero di tutti i BestSuppliers

        foreach ($bestSuppliers as $bestSupplier) { //ciclo per scorrerli singolarmente
            $competitiveProduct = $competitiveProductRepository->create( //Inseriamo nella nuova tabella con il flag iscompetitive calcolato nel management
                $bestSupplier->sku,
                $bestSupplier->title,
                $competitiveProductManagement->isCompetitiveProduct($bestSupplier),
                $bestSupplier->price
            );
            $competitiveProductRepository->save($competitiveProduct);
        }
    }
}
