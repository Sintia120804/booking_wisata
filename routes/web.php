<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

// Frontend
Route::get('/destinations', [FrontendController::class, 'destinations'])->name('destinations.index');
Route::get('/destinations/{id}', [FrontendController::class, 'destinationDetail'])->name('destinations.detail');
Route::post('/bookings', [FrontendController::class, 'booking'])->name('bookings.store');
Route::get('/reviews/{destination_id}', [FrontendController::class, 'reviews'])->name('reviews.index');

// Admin (sementara tanpa middleware, nanti akan ditambah)
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('categories', AdminController::class)->parameters(['categories' => 'id'])->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('destinations', AdminController::class)->parameters(['destinations' => 'id'])->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('bookings', AdminController::class)->parameters(['bookings' => 'id'])->only(['index', 'show', 'update', 'destroy']);
    Route::resource('reviews', AdminController::class)->parameters(['reviews' => 'id'])->only(['index', 'destroy']);
    Route::resource('users', AdminController::class)->parameters(['users' => 'id'])->only(['index', 'edit', 'update', 'destroy']);
});
