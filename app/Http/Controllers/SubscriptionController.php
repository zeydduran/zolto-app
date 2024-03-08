<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Models\Subscription;
use App\Services\Facades\ZotloService;
use App\Services\Responses\ErrorResponse;
use App\Services\Responses\Payment\Profile;
use App\Services\Responses\Subscription\SubscriptionSuccessResponse;
use App\Services\Responses\SuccessResponse;
use Illuminate\Support\Str;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $subscriptionList = ZotloService::subscription()->list($subscription->subscriber_id);
        // dd($subscriptionList->getResult());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreSubscriptionRequest $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubscriptionRequest $request)
    {

        $user = $request->user()->loadCount(['subscriptions' => function ($query) {
            $query->where('status', 'active');
        }]);
        if ($user->subscriptions_count <= 0) {
            $subscriptionId = Str::uuid();
            $params = $request->all();
            $params["subscriberId"] = (string) $subscriptionId;
            $payment =  ZotloService::payment()->creditCard($params);
            if ($payment instanceof SuccessResponse && $payment->isSuccess()) {
                /** @var Profile $profile */
                $profile = $payment->getProfile();
                $user->subscriptions()->create([
                    'subscriber_id' => (string) $subscriptionId,
                    'phone_number'  => $request->input('subscriberPhoneNumber'),
                    'start_date'    => $profile->startDate,
                    'expire_date'   => $profile->expireDate,
                    'status'        => $profile->realStatus,
                    'packageId'     => $profile->package,
                ]);
                return response()->json(['status' => true, 'subscription' => $profile], 201);
            } else {
                return response()->json([
                    'errorCode'    => $payment->getErrorCode(),
                    'errorMessage' => $payment->getErrorMessage()
                ], 400);
            }
        } else {
            return response()->json(['errorCode' => 403, 'errorMessage' => trans('Zaten Bir aboneliğiniz mevcut')], 403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
       
        $profile =  ZotloService::subscription()->profile($subscription->subscriber_id, 'zotlo.premium');
        if ($profile instanceof SuccessResponse) {
            return response()->json($profile);
        } else {
            return response()->json([
                'errorCode'    => $profile->getErrorCode(),
                'errorMessage' => $profile->getErrorMessage()
            ], 400);
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
    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}
