<?php

namespace App\Services\Responses;

class ResponseData
{
    public $isSuccess;
    public $transactionId;
    public $providerTransactionId;
    public $customTransactionId;
    public $statusCode;
    public $statusMessage;
    public $paymentDate;
    public $providerStatus;
    public $paymentStatus;
    public $redirectUrl;
    public $paymentProvider;
    public $packageId;

    public function __construct($data)
    {
        $this->isSuccess             = $data['isSuccess'];
        $this->transactionId         = $data['transactionId'];
        $this->providerTransactionId = $data['providerTransactionId'];
        $this->customTransactionId   = $data['customTransactionId'];
        $this->statusCode            = $data['statusCode'];
        $this->statusMessage         = $data['statusMessage'];
        $this->paymentDate           = $data['paymentDate'];
        $this->providerStatus        = $data['providerStatus'];
        $this->paymentStatus         = $data['paymentStatus'];
        $this->redirectUrl           = $data['redirectUrl'];
        $this->paymentProvider       = $data['paymentProvider'];
        $this->packageId             = $data['packageId'];
    }
}
