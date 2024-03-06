<?php

namespace App\Services\Responses;

class Card
{
    public $cardNumber;
    public $expireDate;

    public function __construct($data)
    {
        $this->cardNumber = $data['cardNumber'];
        $this->expireDate = $data['expireDate'];
    }
}
