<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublishStatus extends Model
{
    use HasFactory;

    protected $table = 'publish_statuses';
    

    public function books()
    {
        return $this->hasMany(BlgBook::class, 'publication_status');
    }
}
