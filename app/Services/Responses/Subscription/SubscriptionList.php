<?php

namespace App\Services\Responses\Subscription;

use App\Services\Responses\SuccessResponse;

class SubscriptionList extends SuccessResponse
{
    public $meta;
    public $result;

    public function __construct(array $data)
    {
        $this->meta = $data['meta'];
        $this->result = $this->parseResult($data['result']);
    }

    private function parseResult($resultData)
    {
        $result = collect($resultData);
        $parsedResult = [];

        foreach ($result as $item) {
            $parsedResult[] = new SubscriptionListItem($item);
        }

        return $parsedResult;
    }
    
}
