<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlogPostController;
use App\Http\Controllers\Api\TestimonialController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\DiscountController;
use App\Http\Controllers\Api\PaymentApiController;
use App\Http\Controllers\Api\BlogApiController;
use App\Http\Controllers\Api\Admin\BlogPostApiController;



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


// Blog
Route::get('blog-posts', [BlogPostController::class, 'index']);
Route::get('blog-posts/{id}', [BlogPostController::class, 'show']);

// Testimonials
Route::get('testimonials', [TestimonialController::class, 'index']);

// Services
Route::get('services', [ServiceController::class, 'index']);

// Discounts
Route::get('discounts', [DiscountController::class, 'index']);


//payment API routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/payments', [PaymentApiController::class, 'index']);
    Route::post('/payments', [PaymentApiController::class, 'store']);
    Route::get('/payments/{payment}', [PaymentApiController::class, 'show']);
    Route::put('/payments/{payment}', [PaymentApiController::class, 'update']);
    Route::delete('/payments/{payment}', [PaymentApiController::class, 'destroy']);
    Route::post('/payments/{payment}/pay', [PaymentApiController::class, 'pay']);
});


// Blog API (PUBLIC)
Route::get('blog-posts', [BlogApiController::class, 'index']);
Route::get('blog-posts/{blog}', [BlogApiController::class, 'show']);

// admin blog API 
Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::get('blog-posts', [BlogPostApiController::class, 'index']);
    Route::post('blog-posts', [BlogPostApiController::class, 'store']);
    Route::get('blog-posts/{id}', [BlogPostApiController::class, 'show']);
    Route::put('blog-posts/{id}', [BlogPostApiController::class, 'update']);
    Route::delete('blog-posts/{id}', [BlogPostApiController::class, 'destroy']);
});
