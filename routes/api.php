<?php
// PHOTO RECOMMENDATIONS (PUBLIC)
Route::get('photo-recommendations', [\App\Http\Controllers\Api\PhotoRecommendationController::class, 'index']);
Route::get('photo-recommendations/{id}', [\App\Http\Controllers\Api\PhotoRecommendationController::class, 'show']);
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

// AUTH
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->get('user', [AuthController::class, 'user']);

// PACKAGES
Route::get('packages', [PackageController::class, 'index']);
Route::get('packages/{id}', [PackageController::class, 'show']);
Route::middleware('auth:sanctum')->group(function() {
    Route::post('packages', [PackageController::class, 'store']);
    Route::put('packages/{id}', [PackageController::class, 'update']);
    Route::delete('packages/{id}', [PackageController::class, 'destroy']);
    
    // PROFILE PHOTO
    Route::post('profile/photo', [\App\Http\Controllers\Api\ProfilePhotoController::class, 'update']);
});

// BLOG
Route::get('blog-posts', [BlogPostController::class, 'index']);
Route::get('blog-posts/{id}', [BlogPostController::class, 'show']);
Route::get('blogs', [BlogPostController::class, 'index']);

// TESTIMONIALS
Route::get('testimonials', [TestimonialController::class, 'index']);

// SERVICES
Route::get('services', [ServiceController::class, 'index']);

// DISCOUNTS
Route::get('discounts', [DiscountController::class, 'index']);

// PAYMENTS (auth required)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('payments', [PaymentApiController::class, 'index']);
    Route::post('payments', [PaymentApiController::class, 'store']);
    Route::get('payments/{payment}', [PaymentApiController::class, 'show']);
    Route::put('payments/{payment}', [PaymentApiController::class, 'update']);
    Route::delete('payments/{payment}', [PaymentApiController::class, 'destroy']);
    Route::post('payments/{payment}/pay', [PaymentApiController::class, 'pay']);
});

// BLOG API (PUBLIC)
Route::get('blog-posts', [BlogApiController::class, 'index']);
Route::get('blog-posts/{blog}', [BlogApiController::class, 'show']);

// ADMIN BLOG API (auth required, prefix 'admin')

Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    // Blog Posts (sudah ada)
    Route::get('blog-posts', [BlogPostApiController::class, 'index']);
    Route::post('blog-posts', [BlogPostApiController::class, 'store']);
    Route::get('blog-posts/{id}', [BlogPostApiController::class, 'show']);
    Route::put('blog-posts/{id}', [BlogPostApiController::class, 'update']);
    Route::delete('blog-posts/{id}', [BlogPostApiController::class, 'destroy']);

    // Packages
    Route::get('packages', [\App\Http\Controllers\Api\Admin\PackageAdminController::class, 'index']);
    Route::post('packages', [\App\Http\Controllers\Api\Admin\PackageAdminController::class, 'store']);
    Route::get('packages/{id}', [\App\Http\Controllers\Api\Admin\PackageAdminController::class, 'show']);
    Route::put('packages/{id}', [\App\Http\Controllers\Api\Admin\PackageAdminController::class, 'update']);
    Route::delete('packages/{id}', [\App\Http\Controllers\Api\Admin\PackageAdminController::class, 'destroy']);

    // Payments
    Route::get('payments', [\App\Http\Controllers\Api\Admin\PaymentAdminController::class, 'index']);
    Route::post('payments', [\App\Http\Controllers\Api\Admin\PaymentAdminController::class, 'store']);
    Route::get('payments/{id}', [\App\Http\Controllers\Api\Admin\PaymentAdminController::class, 'show']);
    Route::put('payments/{id}', [\App\Http\Controllers\Api\Admin\PaymentAdminController::class, 'update']);
    Route::delete('payments/{id}', [\App\Http\Controllers\Api\Admin\PaymentAdminController::class, 'destroy']);

    // Users
    Route::get('users', [\App\Http\Controllers\Api\Admin\UserAdminController::class, 'index']);
    Route::post('users', [\App\Http\Controllers\Api\Admin\UserAdminController::class, 'store']);
    Route::get('users/{id}', [\App\Http\Controllers\Api\Admin\UserAdminController::class, 'show']);
    Route::put('users/{id}', [\App\Http\Controllers\Api\Admin\UserAdminController::class, 'update']);
    Route::delete('users/{id}', [\App\Http\Controllers\Api\Admin\UserAdminController::class, 'destroy']);
    // Testimonials
    Route::get('testimonials', [\App\Http\Controllers\Api\Admin\TestimonialAdminController::class, 'index']);
    Route::post('testimonials', [\App\Http\Controllers\Api\Admin\TestimonialAdminController::class, 'store']);
    Route::get('testimonials/{id}', [\App\Http\Controllers\Api\Admin\TestimonialAdminController::class, 'show']);
    Route::put('testimonials/{id}', [\App\Http\Controllers\Api\Admin\TestimonialAdminController::class, 'update']);
    Route::delete('testimonials/{id}', [\App\Http\Controllers\Api\Admin\TestimonialAdminController::class, 'destroy']);

    // Services
    Route::get('services', [\App\Http\Controllers\Api\Admin\ServiceAdminController::class, 'index']);
    Route::post('services', [\App\Http\Controllers\Api\Admin\ServiceAdminController::class, 'store']);
    Route::get('services/{id}', [\App\Http\Controllers\Api\Admin\ServiceAdminController::class, 'show']);
    Route::put('services/{id}', [\App\Http\Controllers\Api\Admin\ServiceAdminController::class, 'update']);
    Route::delete('services/{id}', [\App\Http\Controllers\Api\Admin\ServiceAdminController::class, 'destroy']);

    // Discounts
    Route::get('discounts', [\App\Http\Controllers\Api\Admin\DiscountAdminController::class, 'index']);
    Route::post('discounts', [\App\Http\Controllers\Api\Admin\DiscountAdminController::class, 'store']);
    Route::get('discounts/{id}', [\App\Http\Controllers\Api\Admin\DiscountAdminController::class, 'show']);
    Route::put('discounts/{id}', [\App\Http\Controllers\Api\Admin\DiscountAdminController::class, 'update']);
    Route::delete('discounts/{id}', [\App\Http\Controllers\Api\Admin\DiscountAdminController::class, 'destroy']);

    // Photo Recommendations
    Route::get('photo-recommendations', [\App\Http\Controllers\Api\Admin\PhotoRecommendationAdminController::class, 'index']);
    Route::post('photo-recommendations', [\App\Http\Controllers\Api\Admin\PhotoRecommendationAdminController::class, 'store']);
    Route::get('photo-recommendations/{id}', [\App\Http\Controllers\Api\Admin\PhotoRecommendationAdminController::class, 'show']);
    Route::put('photo-recommendations/{id}', [\App\Http\Controllers\Api\Admin\PhotoRecommendationAdminController::class, 'update']);
    Route::delete('photo-recommendations/{id}', [\App\Http\Controllers\Api\Admin\PhotoRecommendationAdminController::class, 'destroy']);
});
