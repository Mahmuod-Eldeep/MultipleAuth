<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function login(LoginRequest $loginRequest)
    {
        $credentials = $loginRequest->only('email', 'password');
        if (Auth::attempt($credentials)) {

            $user = User::Where('email', $loginRequest->email)->first();
            return response()->json([
                'acces_token' => $user->createToken('api_token')->plainTextToken,
                'token_type' => 'Bearer'

            ]);
        }
        return response()->json([
            'Message' =>   'Login information invalid', 401
        ]);
    }
}
