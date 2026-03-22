<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\ProfileController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Public route for user registration
Route::post('/register', [AuthController::class, 'register']);

// Public route for user login
Route::post('/login', [AuthController::class, 'login']);

// Public route GET request handler
Route::get('/login', function () {
    return response()->json(['message' => 'Only POST request is allowed for API']);
})->name('login');

// Protected routes for user management, accessible only to authenticated users
Route::middleware('auth:sanctum')->group(function () {
    // Route to show authenticated user profile
    Route::get('/user', [ProfileController::class, 'show']);
    // Route to update authenticated user profile
    Route::match(['put', 'patch'], '/user', [ProfileController::class, 'update']);
    // Route to delete authenticated user profile
    Route::delete('/user', [ProfileController::class, 'destroy']);

    // Logout route
    Route::post('/logout', [AuthController::class, 'logout']);

    // Urls resource route
    Route::apiResource('urls', UrlController::class);
});

