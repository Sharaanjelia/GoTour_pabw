<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\BlogPostController;
use App\Http\Controllers\Api\TestimonialController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\DiscountController;

// Auth
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->get('user', [AuthController::class, 'user']);

// Packages
Route::get('packages', [PackageController::class, 'index']);
Route::get('packages/{id}', [PackageController::class, 'show']);
Route::middleware('auth:sanctum')->group(function() {
    Route::post('packages', [PackageController::class, 'store']);
    Route::put('packages/{id}', [PackageController::class, 'update']);
    Route::delete('packages/{id}', [PackageController::class, 'destroy']);
});

// Payments
Route::middleware('auth:sanctum')->group(function() {
    Route::get('payments', [PaymentController::class, 'index']);
    Route::post('payments', [PaymentController::class, 'store']);
    Route::get('payments/{id}', [PaymentController::class, 'show']);
});

// Blog
Route::get('blog-posts', [BlogPostController::class, 'index']);
Route::get('blog-posts/{id}', [BlogPostController::class, 'show']);

// Testimonials
Route::get('testimonials', [TestimonialController::class, 'index']);

// Services
Route::get('services', [ServiceController::class, 'index']);

// Discounts
Route::get('discounts', [DiscountController::class, 'index']);
