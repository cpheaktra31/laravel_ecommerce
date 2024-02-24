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
        Schema::create('slides', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_kh');
            $table->string('short_info_en')->nullable();
            $table->string('short_info_kh')->nullable();
            $table->string('url')->nullable();
            $table->string('image');
            $table->string('background')->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_promotion')->default(false);
            $table->integer('ordering')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slides');
    }
};
