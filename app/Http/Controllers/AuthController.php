<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users', // Validate email uniqueness
            'password' => 'required|min:6',          // Minimum password length
        ]);

        // Create the user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), // Hash the password
        ]);

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    /**
     * Log in an existing user and issue a token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password'); // Retrieve email and password

        if (Auth::attempt($credentials)) { // Attempt authentication
            $user = Auth::user(); // Retrieve the authenticated user
            $token = $user->createToken('auth_token')->plainTextToken; // Generate API token

            return response()->json([
                'token' => $token,
                'message' => 'Login successful',
            ], 200);
        }

        return response()->json(['message' => 'Invalid credentials'], 401); // Invalid login
    }
}


