<?php

namespace App\Services\Responses\Subscription;

class Customer
{
    public $id;
    public $createDate;
    public $country;
    public $firstname;
    public $lastname;
    public $email;

    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->createDate = $data['createDate'];
        $this->country = $data['country'];
        $this->firstname = $data['firstname'];
        $this->lastname = $data['lastname'];
        $this->email = $data['email'];
    }
}
