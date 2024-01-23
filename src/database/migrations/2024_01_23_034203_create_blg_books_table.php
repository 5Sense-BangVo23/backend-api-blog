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
            Schema::create('blg_books', function (Blueprint $table) {
                $table->id();
                $table->string('title')->comment('Book title'); // Book title
                $table->text('description')->nullable()->comment('Book description'); // Book description, nullable
                $table->unsignedBigInteger('blg_author_id')->nullable()->comment('Foreign key to link with authors'); // Foreign key to link with authors, nullable
                $table->unsignedBigInteger('blg_category_id')->nullable()->comment('Foreign key to link with categories'); // Foreign key to link with categories, nullable
                $table->unsignedBigInteger('blg_publisher_id')->nullable()->comment('Foreign key to link with publishers'); // Foreign key to link with publishers, nullable
                $table->timestamps();
                $table->foreign('blg_author_id')->references('id')->on('blg_authors');
                $table->foreign('blg_category_id')->references('id')->on('blg_categories');
                $table->foreign('blg_publisher_id')->references('id')->on('blg_publishers');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blg_books');
        Schema::dropIfExists('blg_authors');
        Schema::dropIfExists('blg_categories');
        Schema::dropIfExists('blg_publishers');
    }
};
