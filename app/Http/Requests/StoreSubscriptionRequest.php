<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardExpirationMonth;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardNumber;

class StoreSubscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cardNo'                => ['required', new CardNumber],
            'cardOwner'             => ['required'],
            'expireMonth'           => ['required', new CardExpirationMonth($this->get('expireYear'))],
            'expireYear'            => ['required', new CardExpirationYear($this->get('expireMonth'))],
            'cvv'                   => ['required', new CardCvc($this->get('cardNo'))],
            'subscriberPhoneNumber' => ['required'],
            'packageId'             => ['required', 'string'],
        ];
    }
}
