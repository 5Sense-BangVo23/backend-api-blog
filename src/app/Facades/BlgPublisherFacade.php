<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class BlgPublisherFacade extends Facade{

    protected static function getFacadeAccessor()
    {
        return 'BlgPublisherService';
    }
}