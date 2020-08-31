<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;

class AuthController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        $rememberMe = $request->input('remember_me');

        if (!Auth::attempt($credentials)) {
            return $this->sendError('You can not sign with those credentials');
        }

        $token = Auth::user()->createToken(config('app.name'));

        $tempDate = Carbon::now();
        $expiresAt = $token->token->expires_at = $rememberMe 
            ? $tempDate->addMonth() : $tempDate->addDay();

        $token->token->save();

        // TODO: Возвращать также данные о пользователе
        // 'token_type' => 'Bearer'
        return $this->sendData([
            'access_token' => $token->accessToken,
            'expires_at' => Carbon::parse($expiresAt)->toDateTimeString(),
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return $this->sendSuccess();
    }
}
