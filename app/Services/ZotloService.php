<?php

namespace App\Services;


class ZotloService
{

    public function __construct()
    {
    }

    public function payment()
    {
        return  new PaymentService();
    }

    public function subscription()
    {
        return new SubscriptionService();
    }
}
