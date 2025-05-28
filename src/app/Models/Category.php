<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // Một danh mục có nhiều sản phẩm
    public function nailPolishProducts()
    {
        return $this->hasMany(NailPolishProduct::class);
    }
}
