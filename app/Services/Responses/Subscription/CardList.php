<?php

namespace App\Services\Responses\Subscription;

use App\Services\Responses\SuccessResponse;

class CardList extends SuccessResponse
{
    public function __construct(array $data)
    {
        $this->meta = $data["meta"];
        $this->result = $this->parseResult($data["result"]);

    }

    private function parseResult($resultData)
    {
        $result = collect($resultData);
        $parsedResult = [];

        foreach (data_get($result,'cardList',[]) as $item) {
            $parsedResult[] = new Card($item);
        }

        return $parsedResult;
    }
}
