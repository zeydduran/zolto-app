<?php

namespace App\Services\Responses;

class ZotloResponse
{
    public $meta;
    public $result;

    public function __construct(array $data)
    {
        $this->meta = $data['meta'];
        $this->result = $this->parseResult($data['result']);
    }

    public function getMeta()
    {
        return $this->meta;
    }

    public function getResult()
    {
        return $this->result;
    }

    private function parseResult($resultData)
    {
        $result = collect($resultData);
        $result['profile'] = new Profile($result->get('profile'));
        $result['package'] = new Package($result->get('package'));
        $result['customer'] = new Customer($result->get('customer'));
        $result['card'] = new Card($result->get('card'));
        $result['response'] = new ResponseData($result->get('response'));
        return $result;
    }

    public function isSuccess()
    {
        return $this->getResult()->get('response')->isSuccess;
    }
}
