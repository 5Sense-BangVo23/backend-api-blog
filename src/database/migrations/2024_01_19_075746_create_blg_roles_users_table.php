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
        Schema::create('blg_roles_users', function (Blueprint $table) {
                $table->id();
                $table->foreignId('blg_role_id')->constrained('blg_roles');
                $table->foreignId('blg_user_id')->constrained('blg_users');
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blg_roles_users');
    }
};
