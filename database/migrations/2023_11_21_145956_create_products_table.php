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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('name_kh');
            $table->string('name_en');
            $table->string('slug_kh');
            $table->string('slug_en');
            $table->string('short_info_kh', 500);
            $table->string('short_info_en', 500);
            $table->string('price');
            $table->text('description_kh');
            $table->text('description_en');
            $table->string('featured_image');
            $table->timestamps();
            $table->softDeletes();
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
