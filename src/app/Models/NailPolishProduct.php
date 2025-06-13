<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NailPolishProduct extends Model
{
    use HasFactory;


    protected $fillable = [
        'name','images_urls',
        'code', 'brand_id', 'category_id', 'color_code', 'color_name', 
        'finish_type', 'volume_ml', 'dry_time_seconds', 'durability_days',
        'is_vegan', 'is_cruelty_free', 'is_toxic_free', 'price_vnd', 'currency',
        'manufacture_date', 'expiry_date', 'barcode',
        'usage_instructions', 'warning_notes', 'storage_instructions'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
