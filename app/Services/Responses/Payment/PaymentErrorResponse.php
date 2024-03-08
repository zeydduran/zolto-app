<?php

namespace App\Services\Responses\Payment;

use App\Services\Responses\ErrorResponse;

class PaymentErrorResponse extends ErrorResponse
{
    public function __construct(array $data)
    {
        parent::__construct($data);
    }
}
