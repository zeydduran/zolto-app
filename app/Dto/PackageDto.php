<?php
namespace App\Dto;
class PackageDto
{
    public string $packageId;
    public float $price;
    public string $currency;
    public string $packageType;
    public string $name;
    public string $subscriptionPackageType;
    public array $bundlePackages;

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