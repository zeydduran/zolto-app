<?php

namespace App\Services;

use App\Services\Contracts\PaymentContract;
use App\Services\Validators\CreditCardValidator;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Http;

class PaymentService implements PaymentContract
{


    public function creditCard(array $params): array
    {
        CreditCardValidator::validate($params);
        $response = Http::zotlo()->post('/v1/payment/credit-card', [
            'json' => $params,
        ]);

        return json_decode($response->getBody(), true);
    }
}
