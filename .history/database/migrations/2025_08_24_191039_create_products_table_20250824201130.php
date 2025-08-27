<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->decimal('price', 10, 2);
        $table->decimal('original_price', 10, 2)->nullable();
        $table->text('description')->nullable();
        $table->string('main_banner')->nullable();
        $table->string('secondary_banner')->nullable();
        $table->text('delivery_content')->nullable(); // Conteúdo para envio por email
        $table->string('delivery_file')->nullable(); // Arquivo para anexar no email
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
