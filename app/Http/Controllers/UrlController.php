<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Show all shortened URLs of a user
        $userId = $request->user()->id;
        $urls = Url::where('user_id', $userId)->paginate(10);

        if (!$userId || !$urls) {
            return response()->json([
                'success' => false,
                'message' => 'Bad request'
            ], 400);

        }

        return response()->json([
            'success' => true,
            'data' => $urls
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Save shortened URL
        $validated = $request->validate([
            'original_url' => 'required|url|max:2048'
        ]);

        // Generate unique shortcode
        do {
            $shortCode = substr(bin2hex(random_bytes(4)), 0, 6);
        } while (Url::where('short_code', $shortCode)->exists());

        // Create URL record with authenticated user
        $url = Url::create([
            'original_url' => $validated['original_url'],
            'short_code' => $shortCode,
            'user_id' => $request->user()->id,
            'click_count' => 0
        ]);

        if (!$url) {
            return response()->json([
                'success' => false,
                'data' => 'Bad request'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $url
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        // Show single URL
        $userId = $request->user()->id;
        $url = Url::where('id', $id)->where('user_id', $userId)->get();

        if (!$userId || !$url) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        return response()->json([
            'success' => 'true',
            'data' => $url
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Update single URL
        $validated = $request->validate([
            'original_url' => 'required|url|max:2048'
        ]);

        $userId = $request->user()->id;
        $updated = Url::where('id', $id)->where('user_id', $userId)->update(['original_url' => $validated['original_url']]);

        if (!$userId || !$updated) {
            return response()->json([
                'success' => false,
                'message' => 'Bad Request',
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $updated
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        // Delete single URL
        $userId = $request->user()->id;
        $deleted = Url::where('id', $id)->where('user_id', $userId)->delete();

        if (!$userId || !$deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Bad Request',
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $deleted
        ], 200);
    }
}
