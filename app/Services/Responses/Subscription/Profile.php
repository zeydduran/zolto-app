<?php

namespace App\Services\Responses\Subscription;

class Profile
{
    public $status;
    public $realStatus;
    public $subscriberId;
    public $subscriptionType;
    public $startDate;
    public $expireDate;
    public $package;
    public $language;
    public $country;
    public $phoneNumber;
    public $originalTransactionId;
    public $cancellation;
    public $quantity;
    public $pendingQuantity;
    public $customParameters;

    public function __construct(array $data)
    {
        $this->status                = $data['status'];
        $this->realStatus            = $data['realStatus'];
        $this->subscriberId          = $data['subscriberId'];
        $this->subscriptionType      = $data['subscriptionType'];
        $this->startDate             = $data['startDate'];
        $this->expireDate            = $data['expireDate'];
        $this->package               = $data['package'];
        $this->language              = $data['language'];
        $this->country               = $data['country'];
        $this->phoneNumber           = $data['phoneNumber'];
        $this->originalTransactionId = $data['originalTransactionId'];
        $this->cancellation          = $data['cancellation'] !== null ? new Cancellation($data['cancellation']) : null;
        $this->quantity              = $data['quantity'];
        $this->pendingQuantity       = $data['pendingQuantity'];
        $this->customParameters      = $data['customParameters'];
    }
}
