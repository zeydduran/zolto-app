<?php

namespace App\Jobs;

use App\Dto\SubscriptionChangeDto;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SubscriberUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public SubscriptionChangeDto $dto
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $subscription = Subscription::where('subscriber_id', $this->dto->parameters->profile->subscriptionId)->first();

        if ($subscription) {
            $subscription->status = $this->dto->parameters->profile->realStatus == "active" ? "active" : "inactive";
            $subscription->save();
        }
    }
}
