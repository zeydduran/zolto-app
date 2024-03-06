<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Services\PaymentService payment()
 */
class ZotloService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'zotlo-service';
    }
}
