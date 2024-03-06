<?php

namespace App\Providers;

use App\Services\ZotloService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class ZotloServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ZotloService::class, function ($app) {
            return new ZotloService();
        });

        $this->app->alias(ZotloService::class, 'zotlo-service');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Http::macro('zotlo', function () {
            return Http::withHeaders([
                'AccessKey'    => env('ZORLO_ACCESS_KEY'),
                'AccessSecret' => env('ZOTLO_ACCESS_SECRET'),
                'AppId'        => env('ZOTLO_APP_ID'),
                'Language'     => 'TR',
                'Content-Type' => 'application/json'
            ])->baseUrl(env('ZOTLO_URL'));
        });
    }
}
