<?php

namespace App\Services;

use App\Services\Responses\Subscription\SubscriptionErrorResponse;
use App\Services\Responses\Subscription\SubscriptionList;
use App\Services\Responses\Subscription\SubscriptionSuccessResponse;
use Illuminate\Support\Facades\Http;

class SubscriptionService
{
    public function profile(string $subscriberId, string $packageId): SubscriptionSuccessResponse|SubscriptionErrorResponse
    {
        $response = Http::zotlo()->get('/v1/subscription/profile', [
            'subscriberId' => $subscriberId,
            'packageId'    => $packageId
        ]);
        if ($response->ok()) {
            return new SubscriptionSuccessResponse($response->json());
        }
        if ($response->badRequest()) {
            return new SubscriptionErrorResponse($response->json());
        }
        throw new \Exception("Zotlo API request failed: " . $response->status());
    }

    /**
     * @return SubscriptionList<SubscriptionListItem[]>
     */
    public function list(string $subscriberId): SubscriptionList|SubscriptionErrorResponse
    {
        $response = Http::zotlo()->get('/v1/subscription/list', [
            'subscriberId' => $subscriberId,
        ]);
        if ($response->ok()) {
            return new SubscriptionList($response->json());
        }
        if ($response->badRequest()) {
            return new SubscriptionErrorResponse($response->json());
        }
        throw new \Exception("Zotlo API request failed: " . $response->status());
    }
}
