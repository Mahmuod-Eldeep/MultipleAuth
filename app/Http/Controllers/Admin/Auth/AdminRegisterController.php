<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegisterRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminRegisterController extends Controller
{
    public function register(RegisterRequest $registerRequest)
    {

        $userData = $registerRequest->only(['name', 'email', 'password']);
        $userData['password'] = Hash::make($registerRequest['password']);

        $user = Admin::create($userData);
        return response()->json([
            'data' => $user,
            // 'acces_token' => $user->createToken('api_token')->plainTextToken,
            // 'token_type' => 'Bearer'
        ], 201);
    }
}
