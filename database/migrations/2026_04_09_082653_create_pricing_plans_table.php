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
        Schema::create('pricing_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('summary');
            $table->string('previous_price')->nullable();
            $table->string('price');
            $table->string('discount_label')->nullable();
            $table->string('note')->nullable();
            $table->string('cta_label')->default('Pilih Paket');
            $table->json('features');
            $table->string('icon_letter', 2)->default('A');
            $table->string('accent_tone')->default('bronze');
            $table->unsignedSmallInteger('sort_order')->default(1);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_plans');
    }
};
