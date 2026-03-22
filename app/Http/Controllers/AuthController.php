<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Handle user registration
    public function register(Request $request)
    {
        // Handle user registration logic here
        // Validate the request data
        request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|same:password',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generate an authentication token for the user
        $authToken = $user->createToken('auth_token')->plainTextToken;

        // Return a response with the user data and authentication token
        return response()->json(['message' => 'User created successfully', 'auth_token' => $authToken], 201);

    }


    // Handle user login
    public function login(Request $request)
    {
        // Handle user login logic here
        // Validate the request data
        request()->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to find the user by email
        $user = User::where('email', $request->email)->first();

        // Check if the user exists and the password is correct
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Generate an authentication token for the user
        $authToken = $user->createToken('auth_token')->plainTextToken;

        // Return a response with the user data and authentication token
        return response()->json(['message' => 'Login successful', 'auth_token' => $authToken], 200);

    }

    // Handle user logout
    public function logout(Request $request)
    {
        // Handle user logout logic here
        // Revoke the user's current authentication token
        $request->user()->currentAccessToken()->delete();

        // Return a response indicating successful logout
        return response()->json(['message' => 'No Content'], 204);
    }

}
