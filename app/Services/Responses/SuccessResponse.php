<?php

namespace App\Services\Responses;

class SuccessResponse
{
    public $meta;
    public $result;

    public function __construct(array $data)
    {
        $this->meta = $data['meta'];
        $this->result = $data['result'];
    }

    public function getMeta()
    {
        return $this->meta;
    }

    public function getResult()
    {
        return $this->result;
    }
}
