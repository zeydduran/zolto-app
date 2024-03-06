<?php

namespace App\Services;

use GuzzleHttp\Client;

class ZotloService
{

    protected $client;
    public function __construct()
    {
        
    }

    public function payment()
    {
        return  new PaymentService();
    }
}
