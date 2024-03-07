<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Models\Subscription;
use App\Services\Facades\ZotloService;
use App\Services\Responses\Profile;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            $subscription =  $user->subscriptions()->create([
                'phone_number' => $request->input('subscriberPhoneNumber'),
            ]);
            $params = $request->all();
            $params["subscriberId"] = $subscription->subscriber_id;
            $payment =  ZotloService::payment()->creditCard($params);
            if ($payment->isSuccess()) {
                /** @var Profile $profile */
                $profile = $payment->getProfile();
                $subscription->start_date = $profile->startDate;
                $subscription->save();
            } else {
                return response()->json([
                    'errorCode' => $payment->getErrorCode(),
                    'errorMessage' => $payment->getErrorMessage()
                ], 400);
            }
        } else {
            return response()->json(['status' => false], 403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        //
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
