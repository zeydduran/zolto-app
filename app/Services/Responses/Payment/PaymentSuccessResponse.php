<?php

namespace App\Services\Responses\Payment;

use App\Services\Responses\SuccessResponse;

class PaymentSuccessResponse extends SuccessResponse
{
    public $meta;
    public $result;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->meta = $data['meta'];
        $this->result = $this->parseResult($data['result']);
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
        $className = ucfirst($key);

        $classPath = __DIR__ . DIRECTORY_SEPARATOR . $className . '.php';
        if (file_exists($classPath) && class_exists("App\Services\Responses\Payment\\{$className}")) {
            return $value !== null ? app("App\Services\Responses\Payment\\{$className}", ['data' => $value]) : null;
        } else {
            return $value;
        }
    }

    public function isSuccess()
    {
        return $this->getResult()['response']->isSuccess ?? false;
    }

    

    public function __call($method, $arguments): mixed
    {
        if (strpos($method, 'get') === 0 && property_exists($this, 'result')) {
            $property = lcfirst(substr($method, 3));

            if (is_object($this->result[$property]) && isset($this->result[$property])) {
                return $this->result[$property];
            }
            throw new \BadFunctionCallException("Property {$property} does not exist.");
        }
        throw new \BadFunctionCallException("Method {$method} does not exist.");
    }
}
