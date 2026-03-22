<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    //
    public function show(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }

    // Update user
    public function update(Request $request)
    {
        $user = $request->user();

        // Debug: Check what data is being received
        // Log::info('Update request data:', $request->all());
        // Log::info('Authenticated user ID:', ['id' => $user->id]);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => [
                'sometimes',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
            'password' => 'sometimes|string|min:8|confirmed',
        ]);

        // Debug: Check what passed validation
        // Log::info('Validated data:', $validated);

        // Handle password update separately if provided
        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $updated = $user->update($validated);

        // Debug: Check if update was successful
        // Log::info('Update successful?', ['result' => $updated]);

        // Refresh the user instance to get updated data
        $user->refresh();

        // Debug: Check user after update
        // Log::info('User after update:', $user->toArray());

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'data' => $user
        ], 200);
    }

    // Delete user
    public function destroy(Request $request)
    {
        $user = $request->user();

        // Revoke all tokens
        $user->tokens()->delete();

        // Delete the user
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User account deleted successfully'
        ], 200);
    }
}
