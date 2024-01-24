<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlgBook extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'blg_author_id', 'blg_category_id', 'blg_publisher_id', 'publication_status'];


     // Define relationship with BlgAuthor (Many-to-One)
     public function author()
     {
         return $this->belongsTo(BlgAuthor::class, 'blg_author_id');
     }
 
     // Define relationship with BlgCategory (Many-to-One)
     public function category()
     {
         return $this->belongsTo(BlgCategory::class, 'blg_category_id');
     }
 
     // Define relationship with BlgPublisher (Many-to-One)
     public function publisher()
     {
         return $this->belongsTo(BlgPublisher::class, 'blg_publisher_id');
     }

     public function status()
     {
         return $this->belongsTo(PublishStatus::class, 'publication_status');
     }
}
