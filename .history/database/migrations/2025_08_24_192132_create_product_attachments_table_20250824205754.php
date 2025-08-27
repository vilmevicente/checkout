<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttachmentsTable extends Migration
{
    public function up()
    {
        Schema::create('product_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('name'); // Nome do arquivo
            $table->string('file_url'); // URL do arquivo
            $table->string('file_type')->nullable(); // Tipo do arquivo (pdf, zip, etc)
            $table->integer('file_size')->nullable(); // Tamanho do arquivo em bytes
            $table->integer('order')->default(0); // Ordem de exibição
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_attachments');
    }
}