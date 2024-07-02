<?php

// routes/api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::middleware('api')->group(function () {
    Route::get('/profile', [ProfileController::class, 'profile']);
    Route::get('/profile/admin', [ProfileController::class, 'admin']);
    Route::get('/profile/{userId}', [ProfileController::class, 'getProfileById']);
});