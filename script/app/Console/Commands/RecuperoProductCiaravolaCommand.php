<?php

namespace App\Console\Commands;

use App\Api\ProductManagementInterface;
use App\Management\ProductManagement;
use App\Models\Product;
use App\Repository\ProductRepository;
use Illuminate\Console\Command;

class RecuperoProductCiaravolaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:recupero-product-ciaravola-command';

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
        ProductManagement $productManagement
    ) {
        include("simple_html_dom.php");
        $html = file_get_html("https://www.ciaravola.it/chitarre/chitarre-classiche/");


        foreach($html->find("div.content-box.clearfix") as $product){

            $competitor =  "www.ciaravola.it";
            $link =  $product->find("div a",0)->attr["href"];
            $titolo =  $product->find("div a",0)->attr["title"];
            $detail_html = file_get_html($link);

            if($detail_html->find("div .product-price.h5.has-discount span",0) != null){
                $priceString = $detail_html->find("div .product-price.h5.has-discount span",0)->text();
            } else{
                $priceString = $detail_html->find("div .current-price span",0)->text();
            }
            $price = $productManagement->castPrice($priceString, 13, 0);
            $sku = $detail_html->find("div .product-reference span",0)->text();

            $product = $productRepository->create($sku, $titolo, $price, $competitor);

            echo "\n\n Prodotto: " . $titolo . "\n competitor: " . $competitor . "\n SKU: " . $sku . "\n prezzo: " . $price;
            $productRepository->save($product);

        }
    }
}
