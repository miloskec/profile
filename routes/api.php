<?php

// routes/api.php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile']);
    Route::get('/profile/admin', [ProfileController::class, 'admin']);
    Route::get('/profile/{userId}', [ProfileController::class, 'getProfileById']);
});

Route::get('/health', function () {
    return response()->json(['status' => 'OK'], 200);
});
