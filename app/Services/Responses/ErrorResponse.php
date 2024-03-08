<?php

namespace App\Services\Responses;

class ErrorResponse
{
    public $meta;
    public $result;

    public function __construct(array $data)
    {
        $this->meta = $data['meta'];
        $this->result = $data['result'];
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
