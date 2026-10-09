<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $response = ['user' => $user, 'token' => $user->createToken('api_gateway')->plainTextToken];

            return response()->json($response);
        } else {
            return response()->json(['message' => 'Unauthorised'], 401);
        }
    }

    public function me(Request $request)
    {
        return response()->json(['user' => Auth::user()]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
