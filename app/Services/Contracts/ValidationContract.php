<?php

namespace App\Services\Contracts;

interface ValidationContract
{
    public static function validate(array $params): bool;
}
