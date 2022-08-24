<?php

namespace App\Http\Controllers;

// use App\Models\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    
    // Register Function

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $password = Hash::make($request->password);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password
        ]);

        return response()->json([
            'message' => 'Registration successful'
        ], 200);
    }

    // Login function

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // fetch user if exists
        $user = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // throw error if user does not exist
        if(!Auth::attempt($user))
        {
            return response()->json([
                'error' => 'Unauthorised Access'
            ], 401);
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;

        return response()->json([
            'user' => Auth::user(),
            'access_token' => $accessToken
        ], 200);
    }

    // Fetch authenticated user

    public function user(Request $request)
    {
        $user = $request->user();

        return response()->json(['user', $user], 200);
    }

    // Logout function
    
    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();

        return response()->json([
            'message' => 'You have successfully been logged out'
        ], 200);
    }

}
