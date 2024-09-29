<?php

namespace App\Console\Commands;

use App\Management\BestSupplierManagement;
use App\Models\BestSupplier;
use App\Repository\BestSupplierRepository;
use App\Repository\ProductRepository;
use Illuminate\Console\Command;

class SupplierMatchCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'supplier:match';

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
        BestSupplierRepository $bestSupplierRepository,
        BestSupplierManagement $bestSupplierManagement
    ) {
        $data = $productRepository->getListByFile('products.csv','local','standard'); //|sku|titolo_prodotto|prezzo|
        $dataFTP = $productRepository->getListByFile('products.csv','ftp','standard'); //|codice|titolo|price|
        $dataHTML = $productRepository->getListByFile('http://localhost:8080/products.csv','ftp','HTTP'); //|cod|title|prezzo_vendita|

        foreach ($data as $productLocal) { //Ciclo per i valori del file in locale
            $exist = $bestSupplierManagement->checkSku($productLocal['sku']); //check se esiste sulla tabella BestSupplier
            if($exist === false) { // se non esiste lo creiamo
                $bestSupplier = $bestSupplierRepository->create(
                    $productLocal['sku'],
                    $productLocal['titolo_prodotto'],
                    $productLocal['prezzo'],
                    'Local'
                );
                $bestSupplierRepository->save($bestSupplier);
            }else {
                $bestSupplierExist = $bestSupplierRepository->getBySku($productLocal['sku']); //se esiste lo recuperiamo
                if ($bestSupplierExist[0]->price > $productLocal['prezzo']) { //confrontiamo i prezzi e se il nuovo prodotto ha il prezzo migliore aggiorniamo i dati
                    $bestSupplierRepository->update(
                        $bestSupplierExist[0],
                        $productLocal['sku'],
                        $productLocal['titolo_prodotto'],
                        $productLocal['prezzo'],
                        'Local'
                    );
                    $bestSupplierRepository->save($bestSupplierExist[0]);
                }
            }
        }

        foreach ($dataFTP as $productFTP) { //Ciclo per i valori del file salvato in un area FTP
            $exist = $bestSupplierManagement->checkSku($productFTP['codice']); //check se esiste sulla tabella BestSupplier
            if($exist === false) { // se non esiste lo creiamo
                $bestSupplier = $bestSupplierRepository->create(
                    $productFTP['codice'],
                    $productFTP['titolo'],
                    $productFTP['price'],
                    'FTP'
                );
                $bestSupplierRepository->save($bestSupplier);
            }else {
                $bestSupplierExist = $bestSupplierRepository->getBySku($productFTP['codice']); //se esiste lo recuperiamo
                if ($bestSupplierExist[0]->price > $productFTP['price']) { //confrontiamo i prezzi e se il nuovo prodotto ha il prezzo migliore aggiorniamo i dati
                    $bestSupplierRepository->update(
                        $bestSupplierExist[0],
                        $productFTP['codice'],
                        $productLocal['titolo'],
                        $productLocal['price'],
                        'FTP'
                    );
                    $bestSupplierRepository->save($bestSupplierExist[0]);
                }
            }
        }

        foreach ($dataHTML as $productHTML) { //Ciclo per i valori del file in cURL
            $exist = $bestSupplierManagement->checkSku($productHTML['cod']); //check se esiste sulla tabella BestSupplier
            if($exist === false) { // se non esiste lo creiamo
                $bestSupplier = $bestSupplierRepository->create(
                    $productHTML['cod'],
                    $productHTML['title'],
                    $productHTML['prezzo_vendita'],
                    'HTTP'
                );
                $bestSupplierRepository->save($bestSupplier);
            }else {
                $bestSupplierExist = $bestSupplierRepository->getBySku($productHTML['cod']); //se esiste lo recuperiamo
                if ($bestSupplierExist[0]->price > $productHTML['cod']) { //confrontiamo i prezzi e se il nuovo prodotto ha il prezzo migliore aggiorniamo i dati
                    $bestSupplierRepository->update(
                        $bestSupplierExist[0],
                        $productHTML['cod'],
                        $productHTML['title'],
                        $productHTML['prezzo_vendita'],
                        'HTTP'
                    );
                    $bestSupplierRepository->save($bestSupplierExist[0]);
                }
            }
        }
    }
}
