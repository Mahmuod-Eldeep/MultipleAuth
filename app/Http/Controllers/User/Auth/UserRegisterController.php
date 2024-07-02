<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRegisterController extends Controller
{
    public function register(RegisterRequest $registerRequest)
    {
        $userData = $registerRequest->only(['name', 'email', 'password']);
        $userData['password'] = Hash::make($registerRequest['password']);

        $user = User::create($userData);
        return response()->json([
            'data' => $user,
            // 'acces_token' => $user->createToken('api_token')->plainTextToken,
            // 'token_type' => 'Bearer'
        ], 201);
    }
}
