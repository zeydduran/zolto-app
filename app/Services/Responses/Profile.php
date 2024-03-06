<?php

namespace App\Services\Responses;

class Profile
{
    public $status;
    public $realStatus;
    public $subscriberId;
    public $subscriptionId;
    public $subscriptionType;
    public $startDate;
    public $expireDate;
    public $renewalDate;
    public $package;
    public $country;
    public $phoneNumber;
    public $language;
    public $originalTransactionId;
    public $lastTransactionId;
    public $subscriptionPackageType;
    public $cancellation;
    public $customParameters;
    public $quantity;
    public $pendingQuantity;

    public function __construct($data)
    {
        $this->status = $data['status'];
        $this->realStatus = $data['realStatus'];
        $this->subscriberId = $data['subscriberId'];
        $this->subscriptionId = $data['subscriptionId'];
        $this->subscriptionType = $data['subscriptionType'];
        $this->startDate = $data['startDate'];
        $this->expireDate = $data['expireDate'];
        $this->renewalDate = $data['renewalDate'];
        $this->package = $data['package'];
        $this->country = $data['country'];
        $this->phoneNumber = $data['phoneNumber'];
        $this->language = $data['language'];
        $this->originalTransactionId = $data['originalTransactionId'];
        $this->lastTransactionId = $data['lastTransactionId'];
        $this->subscriptionPackageType = $data['subscriptionPackageType'];
        $this->cancellation = $data['cancellation'];
        $this->customParameters = $data['customParameters'];
        $this->quantity = $data['quantity'];
        $this->pendingQuantity = $data['pendingQuantity'];
    }
}
