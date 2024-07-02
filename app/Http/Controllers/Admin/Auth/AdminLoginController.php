<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{

    public function login(LoginRequest $loginRequest)
    {

        $credentials = $loginRequest->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {

            $admin = Admin::where('email', $loginRequest->email)->first();
            return response()->json([
                'acces_token' => $admin->createToken('api_token')->plainTextToken,
                'token_type' => 'Bearer'
            ]);
        }
        return response()->json([
            'message' => 'Login information invalid'
        ], 401);
    }
}
