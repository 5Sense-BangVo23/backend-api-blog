<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class BlgBookFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'BlgBookService';
    }
}