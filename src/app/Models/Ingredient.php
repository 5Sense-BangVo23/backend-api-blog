<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Ingredient extends Pivot
{
    protected $table = 'nail_polish_ingredient';

    protected $fillable = ['nail_polish_id', 'ingredient_id'];
}
