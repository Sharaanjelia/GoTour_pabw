<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\PackageController as AdminPackageController;
use Illuminate\Support\Facades\Route;

// Render the app front page using HomeController so searches and content
// always go to the same home view (was previously the default Laravel welcome view).
Route::get('/', [HomeController::class, 'index'])->name('root');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
            // Download E-Tiket
            Route::get('/eticket/{payment}', [\App\Http\Controllers\EticketController::class, 'download'])->name('eticket.download');
        // Favorite (wishlist)
        Route::post('/favorite', [\App\Http\Controllers\FavoriteController::class, 'store'])->name('favorite.store');
        Route::delete('/favorite/{id}', [\App\Http\Controllers\FavoriteController::class, 'destroy'])->name('favorite.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // User Profile Page
    Route::get('/profil', [\App\Http\Controllers\UserProfileController::class, 'index'])->name('user.profile');
    Route::post('/profil/update', [\App\Http\Controllers\UserProfileController::class, 'updateProfile'])->name('user.profile.update');
    Route::post('/profil/password', [\App\Http\Controllers\UserProfileController::class, 'updatePassword'])->name('user.password.update');
    Route::delete('/profil/account', [\App\Http\Controllers\UserProfileController::class, 'destroy'])->name('user.account.destroy');
});

require __DIR__.'/auth.php';

// Public Paket routes
Route::get('/paket', [PackageController::class, 'index'])->name('paket.index');
Route::get('/paket/{package:slug}', [PackageController::class, 'show'])->name('paket.show');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Other public pages mapped from legacy PHP
Route::get('/blog', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('/layanan', [\App\Http\Controllers\ServiceController::class, 'index'])->name('layanan.index');
Route::get('/discounts', [\App\Http\Controllers\DiscountController::class, 'index'])->name('discounts.index');
Route::get('/foto', [\App\Http\Controllers\PhotoController::class, 'index'])->name('foto.index');

Route::get('/testimoni/create', [\App\Http\Controllers\TestimonialController::class, 'create'])->name('testimoni.create');
Route::get('/testimoni', [\App\Http\Controllers\TestimonialController::class, 'index'])->name('testimoni.index');
Route::post('/testimoni', [\App\Http\Controllers\TestimonialController::class, 'store'])->name('testimoni.store');


Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.packages.index');
    })->name('dashboard');

    Route::resource('packages', \App\Http\Controllers\Admin\PackageController::class)->names('packages')->parameters(['packages' => 'package']);

    // Admin resources for converted legacy pages
    Route::resource('blog', \App\Http\Controllers\Admin\BlogPostController::class)->names('blog')->parameters(['blog' => 'blog']);
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class)->names('services')->parameters(['services' => 'service']);
    Route::resource('discounts', \App\Http\Controllers\Admin\DiscountController::class)->names('discounts')->parameters(['discounts' => 'discount']);
    Route::resource('testimonials', \App\Http\Controllers\Admin\TestimonialController::class)->names('testimonials')->parameters(['testimonials' => 'testimonial'])->except(['create','store','show']);
    Route::post('testimonials/{testimonial}/approve', [\App\Http\Controllers\Admin\TestimonialController::class, 'approve'])->name('testimonials.approve');
    Route::resource('photos', \App\Http\Controllers\Admin\PhotoRecommendationController::class)->names('photos')->parameters(['photos' => 'photo']);
    
    // Booking & Payment Management (gabungan dalam 1 controller)
    Route::get('bookings', [\App\Http\Controllers\Admin\BookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/{booking}/edit', [\App\Http\Controllers\Admin\BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('bookings/{booking}', [\App\Http\Controllers\Admin\BookingController::class, 'update'])->name('bookings.update');
    Route::delete('bookings/{booking}', [\App\Http\Controllers\Admin\BookingController::class, 'destroy'])->name('bookings.destroy');

    // User management for admins (kept here for simplicity)
    Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
    Route::post('users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
    Route::post('users/{user}/toggle-admin', [\App\Http\Controllers\Admin\UserController::class, 'toggleAdmin'])->name('users.toggleAdmin');
});


Route::middleware('auth')->group(function(){
    Route::get('payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('payments', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('payments/{payment}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
    Route::put('payments/{payment}', [PaymentController::class, 'update'])->name('payments.update');
    Route::delete('payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');
    
    // Payment methods (choose method for a created payment)
    Route::get('payments/{payment}/methods', [PaymentController::class, 'methods'])->name('payments.methods');
    Route::post('payments/{payment}/pay', [PaymentController::class, 'pay'])->name('payments.pay');
    Route::get('payments/{payment}/success', [PaymentController::class, 'success'])->name('payments.success');
});

// Public routes (index/show only - can view payments) - defined after to avoid route conflicts
Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');
Route::get('payments/{payment}', [PaymentController::class, 'show'])->name('payments.show');

