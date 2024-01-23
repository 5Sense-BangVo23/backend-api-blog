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
        DB::table('blg_users')->update(['remember_token' => '']);
    
        // Modify the column to allow empty strings
        Schema::table('blg_users', function (Blueprint $table) {
            $table->string('remember_token', 500)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blg_users', function (Blueprint $table) {
            //
        });
    }
};
