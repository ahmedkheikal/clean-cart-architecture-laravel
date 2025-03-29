<?php

namespace App\Http\Controllers\Auth;

use App\Application\Services\Interfaces\CartServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request, CartServiceInterface $cartService)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid credentials',
                'data' => [],
            ], 401);
        }

        $cartService->moveSessionCartToDatabaseCart();

        return response()->json([
            'data' => [
                'user' => Auth::user(),
                'authorization' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ],
            'message' => 'Login successful',
        ], 200);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'data' => [
                'user' => Auth::user(),
                'authorization' => [
                    'token' => Auth::refresh(),
                    'type' => 'bearer',
                ]
            ],
            'message' => 'Token refreshed successfully',
        ]);
    }
}