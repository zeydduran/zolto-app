<?php

namespace App\Dto;

class CustomerDto
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
