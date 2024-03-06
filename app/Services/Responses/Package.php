<?php

namespace App\Services\Responses;

class Package
{
    public $packageId;
    public $price;
    public $currency;
    public $packageType;
    public $name;
    public $subscriptionPackageType;
    public $bundlePackages;

    public function __construct($data)
    {
        $this->packageId = $data['packageId'];
        $this->price = $data['price'];
        $this->currency = $data['currency'];
        $this->packageType = $data['packageType'];
        $this->name = $data['name'];
        $this->subscriptionPackageType = $data['subscriptionPackageType'];
        $this->bundlePackages = $data['bundlePackages'];
    }
}
