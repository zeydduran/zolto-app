<?php

namespace App\Services;

use App\Services\Contracts\PaymentContract;
use App\Services\Responses\Payment\PaymentErrorResponse;
use App\Services\Responses\Payment\PaymentSuccessResponse;
use App\Services\Validators\CreditCardValidator;
use Illuminate\Support\Facades\Http;

class PaymentService implements PaymentContract
{


    public function creditCard(array $params): PaymentSuccessResponse|PaymentErrorResponse
    {
        CreditCardValidator::validate($params);
        $response = Http::zotlo()->post('/v1/payment/credit-card', $params);
        if ($response->ok()) {
            return new PaymentSuccessResponse($response->json());
        }
        if ($response->badRequest()) {
            return new PaymentErrorResponse($response->json());
        }
      
        throw new \Exception("Zotlo API request failed: " . $response->status());
    }
}
