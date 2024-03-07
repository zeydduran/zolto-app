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
        $className = ucfirst($key);

        $classPath = __DIR__ . DIRECTORY_SEPARATOR . $className . '.php';
        if (file_exists($classPath) && class_exists("App\Services\Responses\\{$className}")) {
            return $value !== null ? app("App\Services\Responses\\{$className}", ['data' => $value]) : null;
        } else {
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

    public function __call($method, $arguments)
    {
        if (strpos($method, 'get') === 0 && property_exists($this, 'result')) {
            $property = lcfirst(substr($method, 3));

            if (is_object($this->result[$property]) && isset($this->result[$property])) {
                return $this->result[$property];
            }
            throw new \BadMethodCallException("Method {$method} does not exist.");
        }
    }
}
