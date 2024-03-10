<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signin(LoginRequest $request)
    {
        $request->authenticate();
        $token = $request->user()->createToken('access_token')->plainTextToken;
        return response()->json(['token' => $token]);
    }
}
