<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('best_competitor_products', function (Blueprint $table) {
            $table->id();
            $table->string('SKU')->unique();
            $table->string('Titolo_Prodotto');
            $table->string('Winner_Competitor');
            $table->float('Prezzo_di_Vendita');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('best_competitor_products');
    }
};
