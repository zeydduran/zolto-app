<?php

use App\Http\Controllers\AuthController;

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

Route::get('/test', function (Request $request) {
    return ZotloService::payment()->creditCard([
        "cardNo"                => "4130111111111118",
        "cardOwner"             => "Test Test",
        "expireMonth"           => "12",
        "expireYear"            => "25",
        "cvv"                   => "555",
        "language"              => "ru",
        "packageId"             => "zotlo.premium",
        "packageCountry"        => "TR",
        "platform"              => "IOS",
        "cardToken"             => "",
        "subscriberPhoneNumber" => "+905555555555",
        "subscriberFirstname"   => "Karolann",
        "subscriberLastname"    => "Smitham",
        "subscriberEmail"       => "Sally.Effertz62@yahoo.com",
        "subscriberId"          => "510d8f57-05ef-4971-8246-3cdf4249636d",
        "subscriberIpAddress"   => $request->ip,
        "subscriberCountry"     => "TR",
        "transactionSource"     => "",
        "installment"           => 1,
        "quantity"              => 1,
        "force3ds"              => 0,
        "useWallet"             => false,
        "discountPercent"       => 0,
        "redirectUrl"           => "https://example.com",

    ]);
});
Route::post('signin', [AuthController::class, 'signin']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
