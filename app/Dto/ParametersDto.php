<?php

namespace App\Dto;

class ParametersDto
{
    public ProfileDto $profile;
    public PackageDto $package;
    public ?PackageDto $newPackage;
    public ?CardDto $card;
    public ?CustomerDto $customer;

    public function __construct($data)
    {
        $this->profile = new ProfileDto($data["profile"]);
        $this->package = new PackageDto($data["package"]);
        $this->newPackage = $data["newPackage"]
            ? new PackageDto($data["newPackage"])
            : null;
        $this->card = $data["card"] ? new CardDto($data["card"]) : null;
        $this->customer = $data["customer"]
            ? new CustomerDto($data["customer"])
            : null;
    }
}
