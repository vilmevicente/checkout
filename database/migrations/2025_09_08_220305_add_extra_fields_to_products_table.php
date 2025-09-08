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
        Schema::table('products', function (Blueprint $table) {
        $table->string('upsells_title')->nullable();
        $table->string('reviews_title')->nullable();
        $table->string('timer_text')->nullable();
        $table->string('features_button_text')->nullable();
        $table->string('features_icon')->nullable();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
        $table->dropColumn([
            'upsells_title',
            'reviews_title',
            'timer_text',
            'features_button_text',
            'features_icon'
        ]);
    });
    }
};
