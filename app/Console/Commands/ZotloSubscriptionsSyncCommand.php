<?php

namespace App\Console\Commands;

use App\Jobs\SubscriptionInquiry;
use App\Models\Subscription;
use Illuminate\Console\Command;

class ZotloSubscriptionsSyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:zotlo-subscriptions-sync-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Abonelik Hizmetlerini Senkronize Eder';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $subscriptions = Subscription::all(['subscriber_id','status']);
        foreach ($subscriptions as $key => $subscription) {
            SubscriptionInquiry::dispatch($subscription);
        }
    }
}
