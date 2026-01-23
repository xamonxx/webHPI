<?php

use App\Http\Controllers\Api\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Public API endpoints for form submissions and AJAX requests.
| Rate limiting applied for security.
|
*/

// Contact Form Submission
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:10,1') // 10 requests per minute per IP
    ->name('api.contact.store');

// Calculator API (if needed)
// Calculator API
Route::controller(\App\Http\Controllers\Api\CalculatorController::class)->group(function () {
    Route::get('/calculator/init', 'init');
    Route::get('/calculator/materials', 'getMaterials');
    Route::get('/calculator/price', 'getPrice');
    Route::post('/calculator/calculate', 'calculate');
});

// User info route (for authenticated requests)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
