<?php

namespace App\Services;

use App\Services\Contracts\PaymentContract;
use App\Services\Responses\ZotloResponse;
use App\Services\Validators\CreditCardValidator;
use Illuminate\Support\Facades\Http;

class PaymentService implements PaymentContract
{


    public function creditCard(array $params): ZotloResponse
    {
        CreditCardValidator::validate($params);
        $response = Http::zotlo()->post('/v1/payment/credit-card', $params);
        if (in_array($response->status(), [200, 400])) {
            return new ZotloResponse($response->json());
        }
        throw new \Exception("Zotlo API request failed: " . $response->status());
    }
}
