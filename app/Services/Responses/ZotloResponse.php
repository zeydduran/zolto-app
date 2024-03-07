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
        $parsedResult = [];

        foreach ($result as $key => $value) {
            $parsedResult[$key] = $this->createObject($key, $value);
        }

        return $parsedResult;
    }

    private function createObject($key, $value)
    {
        switch ($key) {
            case 'profile':
                return $value !== null ? new Profile($value) : null;
            case 'package':
                return $value !== null ? new Package($value) : null;
            case 'customer':
                return $value !== null ? new Customer($value) : null;
            case 'card':
                return $value !== null ? new Card($value) : null;
            case 'response':
                return new ResponseData($value);
            default:
                return $value;
        }
    }

    public function isSuccess()
    {
        return $this->getResult()['response']->isSuccess ?? false;
    }

    public function getErrorCode()
    {
        return $this->meta['errorCode'] ?? null;
    }

    public function getErrorMessage()
    {
        return $this->meta['errorMessage'] ?? null;
    }
}
