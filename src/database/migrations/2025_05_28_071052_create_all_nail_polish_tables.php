<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Bảng brands
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('country')->nullable();
            $table->string('website')->nullable();
            $table->string('logo_url')->nullable();
            $table->timestamps();
        });

        // 2. Bảng categories
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });


        // 4. Bảng nail_polish_products
        Schema::create('nail_polish_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code', 50)->unique();
            $table->foreignId('brand_id')->nullable()->constrained()
                ->nullOnDelete()->cascadeOnUpdate();

            $table->foreignId('category_id')->nullable()->constrained()
                ->nullOnDelete()->cascadeOnUpdate();

            $table->string('color_code', 20)->nullable();
            $table->string('color_name', 100)->nullable();

            $table->enum('finish_type', ['bóng', 'lì', 'nhũ']);
            $table->decimal('volume_ml', 5, 2)->nullable();
            $table->integer('dry_time_seconds')->nullable();
            $table->integer('durability_days')->nullable();

            $table->boolean('is_vegan')->default(false);
            $table->boolean('is_cruelty_free')->default(false);
            $table->boolean('is_toxic_free')->default(false);

            $table->bigInteger('price_vnd')->nullable();
            $table->string('currency', 3)->default('VND');

            $table->date('manufacture_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('barcode', 20)->unique()->nullable();

            $table->text('usage_instructions')->nullable();
            $table->text('warning_notes')->nullable();
            $table->text('storage_instructions')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nail_polish_products');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('brands');
    }
};
