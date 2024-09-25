<?php

namespace App\Console\Commands;

use App\Management\ProductManagement;
use App\Repository\ProductRepository;
use Illuminate\Console\Command;

class RecuperoProductStrumentiMusicaliCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:recupero-product-strumentalimusicali-command';

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
        for ($i = 1; $i < 9; $i++){
            $html = file_get_html("https://www.strumentimusicali.net/default.php/cPath/28_30_777/batterie-acustiche/kit-batterie-acustiche.html/page/".$i);

            foreach ($html->find("tr .productListing-even") as $productSite) {

                $competitor = "www.strumentimusicali.net";
                $titolo =  $productSite->find("a", 0)->attr["title"];
                $link = $productSite->find("a", 0)->attr["href"];

                $detail_html = file_get_html($link);

                if($detail_html->find("div .product-offert-price", 0) != null){
                    $priceString = $detail_html->find("div .product-offert-price", 0)->text();
                }else {
                    $priceString = $detail_html->find("div .product-base-price", 0)->text();
                }
                $price = $productManagement->castPrice($priceString, 15, 7);
                $sku = $detail_html->find("div .container-sidebar-right-product-code b", 0)->text();

                $product = $productRepository->create($sku, $titolo, $price, $competitor);

                echo "\n\n Prodotto: " . $titolo . "\n competitor: " . $competitor . "\n SKU: " . $sku . "\n prezzo: " . $price;
                $productRepository->save($product);
            }
            sleep(60);
        }
    }
}
