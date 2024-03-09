<?php

namespace App\Services;

use App\Services\Responses\Subscription\CardList;
use App\Services\Responses\Subscription\SubscriptionErrorResponse;
use App\Services\Responses\Subscription\SubscriptionList;
use App\Services\Responses\Subscription\SubscriptionSuccessResponse;
use App\Services\Validators\SubscriptionCancellationValidator;
use Illuminate\Support\Facades\Http;

class SubscriptionService
{
    public function profile(
        string $subscriberId,
        string $packageId
    ): SubscriptionSuccessResponse|SubscriptionErrorResponse {
        $response = Http::zotlo()->get("/v1/subscription/profile", [
            "subscriberId" => $subscriberId,
            "packageId" => $packageId,
        ]);
        if ($response->ok()) {
            return new SubscriptionSuccessResponse($response->json());
        }
        if ($response->badRequest()) {
            return new SubscriptionErrorResponse($response->json());
        }
        throw new \Exception(
            "Zotlo API request failed: " . $response->status()
        );
    }

    /**
     * @return SubscriptionList<SubscriptionListItem[]>
     */
    public function list(
        string $subscriberId
    ): SubscriptionList|SubscriptionErrorResponse {
        $response = Http::zotlo()->get("/v1/subscription/list", [
            "subscriberId" => $subscriberId,
        ]);
        if ($response->ok()) {
            return new SubscriptionList($response->json());
        }
        if ($response->badRequest()) {
            return new SubscriptionErrorResponse($response->json());
        }
        throw new \Exception(
            "Zotlo API request failed: " . $response->status()
        );
    }
    public function cancellation(
        array $params
    ): SubscriptionSuccessResponse|SubscriptionErrorResponse {
        $validate = SubscriptionCancellationValidator::validate($params);
        if ($validate !== true) {
            return new SubscriptionErrorResponse([
                "meta" => [
                    "errorCode" => 422,
                    "errorMessage" => $validate,
                ],
                "result" => [],
            ]);
        }
        $response = Http::zotlo()->post("/v1/subscription/cancellation", [
            "subscriberId" => $params["subscriberId"],
            "cancellationReason" => $params["cancellationReason"],
            "force" => 0,
            "packageId" => $params["packageId"],
        ]);
        if ($response->ok()) {
            return new SubscriptionSuccessResponse($response->json());
        }
        if ($response->badRequest()) {
            return new SubscriptionErrorResponse($response->json());
        }
        throw new \Exception(
            "Zotlo API request failed: " . $response->status()
        );
    }

    public function cardList(
        string $subscriptionId
    ): CardList|SubscriptionErrorResponse {
        $response = Http::zotlo()
            ->withQueryParameters([
                "subscriberId" => $subscriptionId,
            ])
            ->get("/v1/subscription/card-list");
        if ($response->ok()) {
            return new CardList($response->json());
        }
        if ($response->badRequest()) {
            return new SubscriptionErrorResponse($response->json());
        }
        throw new \Exception(
            "Zotlo API request failed: " . $response->status()
        );
    }
}
