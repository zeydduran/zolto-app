<?php
namespace App\Dto;

class CardDto
{
    public string $cardNumber;
    public string $expireDate;

    public function __construct($data)
    {
        $this->cardNumber = $data['cardNumber'];
        $this->expireDate = $data['expireDate'];
    }
}