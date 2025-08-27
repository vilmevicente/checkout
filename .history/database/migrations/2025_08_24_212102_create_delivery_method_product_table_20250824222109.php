<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryMethodProductTable extends Migration
{
    public function up()
    {
        Schema::create('delivery_method_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delivery_method_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            // Garantir combinações únicas
            $table->unique(['delivery_method_id', 'product_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('delivery_method_product');
    }
}