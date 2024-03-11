<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Response;

class SubscriptionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $subscription = Redis::get('user:subscription:' . $user->id);
        if ($subscription) {
            return response()->json(
                [
                    "errorCode" => 403,
                    "errorMessage" => trans(
                        "Zaten aktif bir aboneliğiniz mevcut"
                    ),
                ],
                403
            );
        }
        return $next($request);
    }
}
