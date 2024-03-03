<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('name_kh', 255)->nullable();
            $table->string('name_en', 255);
            $table->string('slug_kh', 500)->nullable();
            $table->string('slug_en', 500);
            $table->string('short_info_kh', 500)->nullable();
            $table->string('short_info_en', 500)->nullable();
            $table->string('price');
            $table->text('description_kh')->nullable();
            $table->text('description_en');
            $table->string('featured_image');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_feature')->default(false);
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
