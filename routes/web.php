<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('destinations.index');
});

// Frontend
Route::get('/destinations', [FrontendController::class, 'destinations'])->name('destinations.index');
Route::get('/destinations/{id}', [FrontendController::class, 'destinationDetail'])->name('destinations.detail');
Route::post('/bookings', [FrontendController::class, 'booking'])->name('bookings.store');
Route::get('/reviews/{destination_id}', [FrontendController::class, 'reviews'])->name('reviews.index');
Route::post('/reviews', [FrontendController::class, 'addReview'])->name('reviews.store');

// Auth manual
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin (sementara tanpa middleware, nanti akan ditambah)
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('categories', AdminController::class)->parameters(['categories' => 'id'])->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('destinations', AdminController::class)->parameters(['destinations' => 'id'])->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('bookings', AdminController::class)->parameters(['bookings' => 'id'])->only(['index', 'show', 'update', 'destroy']);
    Route::resource('reviews', AdminController::class)->parameters(['reviews' => 'id'])->only(['index', 'destroy']);
    Route::resource('users', AdminController::class)->parameters(['users' => 'id'])->only(['index', 'edit', 'update', 'destroy']);
});

// Admin Destinasi CRUD manual
Route::prefix('admin')->middleware([])->group(function () {
    Route::get('destinations', [AdminController::class, 'destinationsIndex'])->name('admin.destinations.index');
    Route::get('destinations/create', [AdminController::class, 'destinationsCreate'])->name('admin.destinations.create');
    Route::post('destinations', [AdminController::class, 'destinationsStore'])->name('admin.destinations.store');
    Route::get('destinations/{id}/edit', [AdminController::class, 'destinationsEdit'])->name('admin.destinations.edit');
    Route::put('destinations/{id}', [AdminController::class, 'destinationsUpdate'])->name('admin.destinations.update');
    Route::delete('destinations/{id}', [AdminController::class, 'destinationsDestroy'])->name('admin.destinations.destroy');
});

// Admin Booking CRUD manual
Route::prefix('admin')->middleware([])->group(function () {
    Route::get('bookings', [AdminController::class, 'bookingsIndex'])->name('bookings.index');
    Route::get('bookings/{id}', [AdminController::class, 'bookingsShow'])->name('bookings.show');
    Route::put('bookings/{id}', [AdminController::class, 'bookingsUpdate'])->name('bookings.update');
    Route::delete('bookings/{id}', [AdminController::class, 'bookingsDestroy'])->name('bookings.destroy');
});

// Admin Review CRUD manual
Route::prefix('admin')->middleware([])->group(function () {
    Route::get('reviews', [AdminController::class, 'reviewsIndex'])->name('reviews.index');
    Route::delete('reviews/{id}', [AdminController::class, 'reviewsDestroy'])->name('reviews.destroy');
});

// Admin User CRUD manual
Route::prefix('admin')->middleware([])->group(function () {
    Route::get('users', [AdminController::class, 'usersIndex'])->name('admin.users.index');
});
