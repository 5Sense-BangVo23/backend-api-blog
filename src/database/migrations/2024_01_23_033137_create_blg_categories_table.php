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
        Schema::create('blg_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Category name'); // Category name
            $table->text('description')->nullable()->comment('Category description'); // Category description, nullable
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blg_categories');
    }
};
