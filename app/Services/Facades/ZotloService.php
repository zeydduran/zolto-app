<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Services\PaymentService payment()
 * @method static \App\Services\SubscriptionService subscription()
 */
class ZotloService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'zotlo-service';
    }
}
