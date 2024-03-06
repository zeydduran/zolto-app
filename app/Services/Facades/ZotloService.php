<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class ZotloService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'zotlo-service';
    }
}
