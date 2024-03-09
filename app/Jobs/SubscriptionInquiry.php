<?php

namespace App\Jobs;

use App\Models\Subscription;
use App\Services\Facades\ZotloService;
use App\Services\Responses\Subscription\Profile;
use App\Services\Responses\SuccessResponse;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SubscriptionInquiry implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Subscription $subscription)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $response = ZotloService::subscription()->profile(
            $this->subscription->subscriber_id,
            "zotlo.premium"
        );

        if ($response instanceof SuccessResponse) {
            /** @var Profile $profile */
            $profile = $response->getProfile();
            $this->subscription->status =
                $profile->realStatus == "active" ? "active" : "inactive";
            $this->subscription->save();
        }
    }
}
