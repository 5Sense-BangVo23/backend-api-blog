<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlgAuthor extends Model
{
    use HasFactory;
    protected $fillable = ['full_name', 'age', 'phone_number'];


    public function books()
    {
        return $this->hasMany(BlgBook::class, 'blg_author_id');
    }
}
