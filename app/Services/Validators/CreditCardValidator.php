<?php

namespace App\Services\Validators;

use App\Services\Contracts\ValidationContract;
use Illuminate\Support\Facades\Validator;
use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardExpirationMonth;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardNumber;

class CreditCardValidator implements ValidationContract
{
    public static function validate(array $params): bool
    {
        $validator = Validator::make($params, [
            'cardNo'                => ['required', 'string', new CardNumber],
            'cardOwner'             => ['required', 'string'],
            'expireYear'            => ['required', 'string', new CardExpirationYear($params["expireMonth"])],
            'expireMonth'           => ['required', 'string', new CardExpirationMonth($params["expireYear"])],
            'cvv'                   => ['required', 'string', new CardCvc($params["cardNo"])],
            'subscriberPhoneNumber' => ['required', 'string'],
            'packageId'             => ['required', 'string'],
            'subscriberId'         => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            throw new \InvalidArgumentException($validator->errors()->first());
        }

        return true;
    }
}
