<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlgPublisher extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address'];

    public function books()
    {
        return $this->hasMany(BlgBook::class, 'blg_publisher_id');
    }
}
