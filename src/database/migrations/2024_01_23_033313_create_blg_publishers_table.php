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
        Schema::create('blg_publishers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Publisher name'); // Publisher name
            $table->string('address')->nullable()->comment('Publisher address'); // Publisher address, nullable
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blg_publishers');
    }
};
