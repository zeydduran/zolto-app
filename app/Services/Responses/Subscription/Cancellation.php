<?php

namespace App\Services\Responses\Subscription;

class Cancellation
{
    public $date;
    public $reason;
    public $code;

    public function __construct(array $cancellationData)
    {
        $this->date = $cancellationData['date'];
        $this->reason = $cancellationData['reason'];
        $this->code = $cancellationData['code'];
    }
}
