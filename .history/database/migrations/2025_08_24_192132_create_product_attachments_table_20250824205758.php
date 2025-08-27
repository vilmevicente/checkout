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
        $table->string('name');
        $table->string('file_path'); // Alterado de file_url para file_path
        $table->string('original_name'); // Nome original do arquivo
        $table->string('mime_type')->nullable();
        $table->integer('size')->nullable();
        $table->integer('order')->default(0);
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('product_attachments');
    }
}