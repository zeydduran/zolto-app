<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubscriptionController;
use App\Services\Facades\ZotloService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post("signin", [AuthController::class, "signin"]);
Route::middleware("auth:sanctum")->group(function () {
    Route::get("/user", function (Request $request) {
        return $request->user();
    });
    Route::post("/subscription/cancellation/{subscription}", [
        SubscriptionController::class,
        "cancellation",
    ]);
    Route::post("/subscription/card-list/{subscription}", [
        SubscriptionController::class,
        "cardList",
    ]);
    Route::apiResource("subscription", SubscriptionController::class);
});
