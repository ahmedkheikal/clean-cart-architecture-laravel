<?php

namespace App\Http\Controllers\Auth;

use App\Application\Services\Interfaces\CartServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;

class RegisterController extends Controller
{
    public function register(Request $request, CartServiceInterface $cartService)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        // move session cart to database cart
        $cartService->moveSessionCartToDatabaseCart();
        return response()->json([
            'message' => 'User registered successfully',
            'data' => [
                'user' => $user,
                'authorization' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ],
        ], 201);
    }
}
