<?php

namespace App\Services;

class ZoltoService
{
    protected $access_key;
    protected $access_secret;
    protected $app_id;
    public function __construct($access_key, $access_secret, $app_id)
    {
        $this->access_key = $access_key;
        $this->access_secret = $access_secret;
        $this->app_id = $app_id;
    }
}
