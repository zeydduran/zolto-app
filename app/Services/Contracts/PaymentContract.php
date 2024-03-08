<?php

namespace App\Services\Contracts;

use App\Services\Responses\Payment\PaymentErrorResponse;
use App\Services\Responses\Payment\PaymentSuccessResponse;
use App\Services\Responses\PaymentResponse;

interface PaymentContract
{
    public function creditCard(array $params): PaymentErrorResponse|PaymentSuccessResponse;
    // Diğer API metotları için gerekirse ilgili fonksiyonları ekleyebilirsiniz...
}
