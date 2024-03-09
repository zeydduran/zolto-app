<?php

namespace App\Services\Responses\Subscription;

class Card
{
    public $id;
    public $token;
    public $cardNumber;
    public $createDate;
    public $expireDate;
    public $cardExpire;
    public $tokenType;
    public $deletable;

    public function __construct($data)
    {
        $this->cardNumber = $data["cardNumber"];
        $this->expireDate = $data["expireDate"] ?? null;
        $this->id = $data["id"] ?? null;
        $this->token = $data["token"] ?? null;
        $this->createDate = $data["createDate"] ?? null;
        $this->deletable = $data["deletable"] ?? null;
        $this->cardExpire = $data["cardExpire"] ?? null;
    }
}
