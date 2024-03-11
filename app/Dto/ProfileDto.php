<?php
namespace App\Dto;
class ProfileDto
{
    public string $status;
    public string $realStatus;
    public string $subscriberId;
    public int $subscriptionId;
    public string $subscriptionType;
    public string $startDate;
    public string $expireDate;
    public string $renewalDate;
    public string $package;
    public string $country;
    public string $phoneNumber;
    public string $language;
    public string $originalTransactionId;
    public string $lastTransactionId;
    public string $subscriptionPackageType;
    public ?string $cancellation; 
    public array $customParameters;
    public int $quantity;
    public int $pendingQuantity;

    public function __construct($data)
    {
        $this->status = $data["status"];
        $this->realStatus = $data["realStatus"];
        $this->subscriberId = $data["subscriberId"];
        $this->subscriptionId = $data["subscriptionId"];
        $this->subscriptionType = $data["subscriptionType"];
        $this->startDate = $data["startDate"];
        $this->expireDate = $data["expireDate"];
        $this->renewalDate = $data["renewalDate"];
        $this->package = $data["package"];
        $this->country = $data["country"];
        $this->phoneNumber = $data["phoneNumber"];
        $this->language = $data["language"];
        $this->originalTransactionId = $data["originalTransactionId"];
        $this->lastTransactionId = $data["lastTransactionId"];
        $this->subscriptionPackageType = $data["subscriptionPackageType"];
        $this->cancellation = $data["cancellation"];
        $this->customParameters = $data["customParameters"];
        $this->quantity = $data["quantity"];
        $this->pendingQuantity = $data["pendingQuantity"];
    }
}
