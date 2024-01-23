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
        Schema::create('blg_authors', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->comment('Author\'s full name'); // Author's full name
            $table->integer('age')->comment('Author\'s age'); // Author's age
            $table->string('phone_number')->comment('Author\'s phone number'); // Author's phone number
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blg_authors');
    }
};
