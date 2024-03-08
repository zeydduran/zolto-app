<?php
namespace App\Services\Responses\Subscription;

use App\Services\Responses\ErrorResponse;

class SubscriptionErrorResponse extends ErrorResponse
{
    public function __construct(array $data)
    {
        parent::__construct($data);
    }
}
