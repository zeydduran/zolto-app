<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\Facades\ZotloService;
use App\Services\Responses\SuccessResponse;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class CreateSubscription implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public User $user, public array $params)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $subscriptionId = Str::uuid();
        $this->params["subscriberId"] = (string) $subscriptionId;
        $this->params["subscriberEmail"] = $this->user->email;
        $this->params["subscriberFirstname"] = $this->user->name;
        $this->params["subscriberLastname"] = $this->user->lastname;
        $this->params["subscriberIpAddress"] = $this->params["ip"];
        $payment = ZotloService::payment()->creditCard($this->params);
        if ($payment instanceof SuccessResponse && $payment->isSuccess()) {
            /** @var Profile $profile */
            $profile = $payment->getProfile();
            $subscription = $this->user->subscriptions()->create([
                "subscriber_id" => (string) $subscriptionId,
                "phone_number" => $this->params["subscriberPhoneNumber"],
                "start_date" => $profile->startDate,
                "expire_date" => $profile->expireDate,
                "status" => $profile->realStatus,
                "packageId" => $profile->package,
            ]);
            Redis::set('user:subscription:' . $this->user->id, $subscription);
        }
    }
}
