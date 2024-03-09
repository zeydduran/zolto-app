<?php

namespace App\Services\Validators;

use App\Services\Contracts\ValidationContract;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SubscriptionCancellationValidator implements ValidationContract
{
    public static function validate(array $params): bool|string
    {
        $validator = Validator::make($params, [
            "subscriberId" => [
                "required",
                "string",
                Rule::exists("subscriptions", "subscriber_id")->where(function (
                    $query
                ) {
                    return $query->where("status", "active");
                }),
            ],
            "cancellationReason" => ["required", "string"],
            "packageId" => ["required", "string"],
            "force" => ["required", "boolean"],
        ]);

        if ($validator->fails()) {
            return $validator->errors()->first();
        }

        return true;
    }
}
