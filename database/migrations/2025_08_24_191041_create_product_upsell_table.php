<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductUpsellTable extends Migration
{
    public function up()
    {
        Schema::create('product_upsell', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('upsell_product_id')->constrained('products')->onDelete('cascade');
            $table->integer('order')->default(0);
            $table->decimal('discount_price', 10, 2)->nullable(); // Preço especial para este upsell
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            // Garantir que não haja duplicatas
            $table->unique(['product_id', 'upsell_product_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_upsell');
    }
}