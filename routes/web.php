<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('destinations');
});

// Frontend
Route::get('/destinations', [App\Http\Controllers\FrontendController::class, 'destinations'])->name('destinations');
Route::get('/destinations/{id}', [FrontendController::class, 'destinationDetail'])->name('destinations.detail');
Route::get('/reviews/{destination_id}', [FrontendController::class, 'reviews'])->name('reviews.index');

// Auth routes with guest middleware
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Logout route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes that require authentication
Route::middleware('auth')->group(function () {
    Route::post('/bookings', [FrontendController::class, 'booking'])->name('bookings.store');
    Route::post('/reviews', [FrontendController::class, 'addReview'])->name('reviews.store');
    Route::get('/my-bookings', [FrontendController::class, 'myBookings'])->name('my.bookings');
    Route::get('/my-bookings/{id}', [FrontendController::class, 'myBookingDetail'])->name('my.bookings.detail');
    Route::get('/my-bookings/{id}/print', [FrontendController::class, 'printBooking'])->name('my.bookings.print');
    Route::put('/my-bookings/{id}/cancel', [FrontendController::class, 'cancelBooking'])->name('my.bookings.cancel');
    Route::get('/booking/create/{id}', [App\Http\Controllers\FrontendController::class, 'showBookingForm'])->name('booking.create');
    Route::get('/review/create/{id}', [App\Http\Controllers\FrontendController::class, 'showReviewForm'])->name('review.create');
});

// Admin routes with admin middleware
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Categories
    Route::resource('categories', AdminController::class)->parameters(['categories' => 'id'])->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    
    // Destinations
    Route::get('destinations', [AdminController::class, 'destinationsIndex'])->name('admin.destinations.index');
    Route::get('destinations/create', [AdminController::class, 'destinationsCreate'])->name('admin.destinations.create');
    Route::post('destinations', [AdminController::class, 'destinationsStore'])->name('admin.destinations.store');
    Route::get('destinations/{id}/edit', [AdminController::class, 'destinationsEdit'])->name('admin.destinations.edit');
    Route::put('destinations/{id}', [AdminController::class, 'destinationsUpdate'])->name('admin.destinations.update');
    Route::delete('destinations/{id}', [AdminController::class, 'destinationsDestroy'])->name('admin.destinations.destroy');
    
    // Bookings
    Route::get('bookings', [AdminController::class, 'bookingsIndex'])->name('bookings.index');
    Route::get('bookings/{id}', [AdminController::class, 'bookingsShow'])->name('bookings.show');
    Route::put('bookings/{id}', [AdminController::class, 'bookingsUpdate'])->name('bookings.update');
    Route::delete('bookings/{id}', [AdminController::class, 'bookingsDestroy'])->name('bookings.destroy');
    
    // Reviews
    Route::get('reviews', [AdminController::class, 'reviewsIndex'])->name('reviews.index');
    Route::delete('reviews/{id}', [AdminController::class, 'reviewsDestroy'])->name('reviews.destroy');
    
    // Users
    Route::get('users', [AdminController::class, 'usersIndex'])->name('admin.users.index');
});
