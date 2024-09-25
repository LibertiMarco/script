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

        foreach ($data as $productLocal) {
            $exist = $bestSupplierManagement->checkSku($productLocal['sku']);
            if($exist === false){
                $bestSupplier = $bestSupplierRepository->create($productLocal['sku'], $productLocal['titolo_prodotto'],$productLocal['prezzo'], 'Local');
                $bestSupplierRepository->save($bestSupplier);
            }else{
                $bestSupplierExist = $bestSupplierRepository->getBySku($productLocal['sku']);
                if ($bestSupplierExist[0]->price > $productLocal['prezzo']) {
                    $bestSupplierRepository->update($bestSupplierExist[0], $productLocal['sku'],  $productLocal['titolo_prodotto'],  $productLocal['prezzo'],  'Local');
                    $bestSupplierRepository->save($bestSupplierExist[0]);
                }
            }
        }

        foreach ($dataFTP as $productFTP) {
            $exist = $bestSupplierManagement->checkSku($productFTP['codice']);
            if($exist === false){
                $bestSupplier = $bestSupplierRepository->create($productFTP['codice'], $productFTP['titolo'],$productFTP['price'], 'FTP');
                $bestSupplierRepository->save($bestSupplier);
            }else{
                $bestSupplierExist = $bestSupplierRepository->getBySku($productFTP['codice']);
                if ($bestSupplierExist[0]->price > $productFTP['price']) {
                    $bestSupplierRepository->update($bestSupplierExist[0], $productFTP['codice'],  $productLocal['titolo'],  $productLocal['price'],  'FTP');
                    $bestSupplierRepository->save($bestSupplierExist[0]);
                }
            }
        }

        foreach ($dataHTML as $productHTML) {
            $exist = $bestSupplierManagement->checkSku($productHTML['cod']);
            if($exist === false){
                $bestSupplier = $bestSupplierRepository->create($productHTML['cod'], $productHTML['title'],$productHTML['prezzo_vendita'], 'HTTP');
                $bestSupplierRepository->save($bestSupplier);
            }else{
                $bestSupplierExist = $bestSupplierRepository->getBySku($productHTML['cod']);
                if ($bestSupplierExist[0]->price > $productHTML['cod']) {
                    $bestSupplierRepository->update($bestSupplierExist[0], $productHTML['cod'],  $productHTML['title'],  $productHTML['prezzo_vendita'],  'HTTP');
                    $bestSupplierRepository->save($bestSupplierExist[0]);
                }
            }
        }

    }
}
