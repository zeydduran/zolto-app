<?php

namespace App\Services\Responses\Subscription;

class SubscriptionListItem
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

    public function __construct(array $itemData)
    {
        $this->status = $itemData['status'];
        $this->realStatus = $itemData['realStatus'];
        $this->subscriberId = $itemData['subscriberId'];
        $this->subscriptionType = $itemData['subscriptionType'];
        $this->startDate = $itemData['startDate'];
        $this->expireDate = $itemData['expireDate'];
        $this->package = $itemData['package'];
        $this->language = $itemData['language'];
        $this->country = $itemData['country'];
        $this->phoneNumber = $itemData['phoneNumber'];
        $this->originalTransactionId = $itemData['originalTransactionId'];
        $this->cancellation = $itemData['cancellation'] !== null ? new Cancellation($itemData['cancellation']) : null;
        $this->quantity = $itemData['quantity'];
        $this->pendingQuantity = $itemData['pendingQuantity'];
        $this->customParameters = $itemData['customParameters'];
    }
}
