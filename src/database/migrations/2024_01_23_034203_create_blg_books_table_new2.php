 <!-- This migration creates the blg_books table with foreign keys to authors, categories, and publishers. 
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        // if (!Schema::hasTable('blg_books')) {
        //     Schema::create('blg_books', function (Blueprint $table) {
        //         $table->id();
        //         $table->string('title')->comment('Book title'); 
        //         $table->text('description')->nullable()->comment('Book description'); 
        //         $table->unsignedBigInteger('blg_author_id')->nullable()->comment('Foreign key to link with authors'); 
        //         $table->unsignedBigInteger('blg_category_id')->nullable()->comment('Foreign key to link with categories'); 
        //         $table->unsignedBigInteger('blg_publisher_id')->nullable()->comment('Foreign key to link with publishers'); 
        //         $table->unsignedBigInteger('publication_status')->comment('Foreign key to link with publish_statuses');
        //         $table->dateTime('publication_start_date')->nullable()->comment('Publication start date and time');
        //         $table->dateTime('publication_end_date')->nullable()->comment('Publication end date and time');
        //         $table->timestamps();
        

        //         $table->foreign('blg_author_id')->references('id')->on('blg_authors');
        //         $table->foreign('blg_category_id')->references('id')->on('blg_categories');
        //         $table->foreign('blg_publisher_id')->references('id')->on('blg_publishers');
        //         $table->foreign('publication_status')->references('id')->on('publish_statuses');
        //     });
        // }        
    }

    public function down(): void
    {
        // Schema::dropIfExists('blg_books');
        // Schema::dropIfExists('blg_authors');
        // Schema::dropIfExists('blg_categories');
        // Schema::dropIfExists('blg_publishers');
    }
};
