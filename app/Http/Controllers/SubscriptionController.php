<?php

namespace App\Http\Controllers;

use App\Dto\SubscriptionChangeDto;
use App\Http\Middleware\SubscriptionMiddleware;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\SubscriptionCancellationRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Http\Resources\SubscriptionResource;
use App\Jobs\CreateSubscription;
use App\Models\Subscription;
use App\Services\Facades\ZotloService;
use App\Services\Responses\SuccessResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware(SubscriptionMiddleware::class)->only('store');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $subscriptions = Subscription::when($request->has("user_id"), function (
            $query
        ) use ($request) {
            $query->where("user_id", $request->get("user_id"));
        })->paginate();

        return SubscriptionResource::collection($subscriptions);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubscriptionRequest $request)
    {
        $user = $request->user();
        $params = $request->all();
        $params["ip"] = $request->ip();
        $params["subscriberPhoneNumber"] = $request->get(
            "subscriberPhoneNumber"
        );
        
        CreateSubscription::dispatch($user, $params);


        return response()->json(
            [
                "status" => true,
                "message" => trans(
                    "Abonelik Talebiniz alındı. İşlem gerçekleştiğinde tarafınıza bilgi verilecektir."
                ),
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        $profile = ZotloService::subscription()->profile(
            $subscription->subscriber_id,
            "zotlo.premium"
        );
        if ($profile instanceof SuccessResponse) {
            return response()->json($profile->getResult(), 200);
        } else {
            return response()->json(
                [
                    "errorCode" => $profile->getErrorCode(),
                    "errorMessage" => $profile->getErrorMessage(),
                ],
                400
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateSubscriptionRequest $request,
        Subscription $subscription
    ) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        //
    }

    public function cancellation(
        Subscription $subscription,
        SubscriptionCancellationRequest $request
    ) {
        $cancellation = ZotloService::subscription()->cancellation([
            "subscriberId" => $subscription->subscriber_id,
            "cancellationReason" => $request->get("cancellationReason"),
            "packageId" => $subscription->packageId,
            "force" => $request->get("force"),
        ]);
        if ($cancellation instanceof SuccessResponse) {
            $subscription->status = "inactive";
            $subscription->save();
            Redis::delete('user:subscription:' . $subscription->user_id);
            return response()->json(
                $cancellation->getCancellationStatus(),
                200
            );
        } else {
            return response()->json($cancellation, 400);
        }
    }

    public function cardList(Subscription $subscription)
    {
        $cardList = ZotloService::subscription()->cardList(
            $subscription->subscriber_id
        );
        if ($cardList instanceof SuccessResponse) {
            return response()->json($cardList->getResult());
        } else {
            return response()->json($cardList, 400);
        }
    }

    public function hook(Request $request)
    {
        $dto = new SubscriptionChangeDto($request->all());
    }
}
