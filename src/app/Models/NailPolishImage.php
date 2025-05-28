<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NailPolishImage extends Model
{
    use HasFactory;

    protected $fillable = ['nail_polish_id', 'image_url', 'alt_text'];

    public function nailPolishProduct()
    {
        return $this->belongsTo(NailPolishProduct::class, 'nail_polish_id');
    }
}
