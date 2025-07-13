# Middleware Implementation for Booking Wisata Sintia

## Overview
Middleware telah berhasil diimplementasikan untuk mengamankan aplikasi booking wisata Sintia. Middleware ini menggantikan pengecekan manual di controller dengan sistem yang lebih terstruktur dan aman.

## Middleware yang Dibuat

### 1. Authenticate Middleware (`app/Http/Middleware/Authenticate.php`)
- **Fungsi**: Memastikan user sudah login sebelum mengakses halaman tertentu
- **Cara Kerja**: Mengecek session `user_id`
- **Response**: Redirect ke halaman login jika belum login

### 2. AdminMiddleware (`app/Http/Middleware/AdminMiddleware.php`)
- **Fungsi**: Memastikan user yang login memiliki role admin
- **Cara Kerja**: 
  - Mengecek session `user_id` (harus login)
  - Mengecek session `user_role` harus 'admin'
- **Response**: 
  - Redirect ke login jika belum login
  - Error 403 jika bukan admin

### 3. GuestMiddleware (`app/Http/Middleware/GuestMiddleware.php`)
- **Fungsi**: Mencegah user yang sudah login mengakses halaman login/register
- **Cara Kerja**: Mengecek session `user_id`
- **Response**: 
  - Redirect ke admin dashboard jika admin
  - Redirect ke home jika user biasa

## Registrasi Middleware

Middleware telah didaftarkan di `bootstrap/app.php`:

```php
$middleware->alias([
    'auth' => \App\Http\Middleware\Authenticate::class,
    'admin' => \App\Http\Middleware\AdminMiddleware::class,
    'guest' => \App\Http\Middleware\GuestMiddleware::class,
]);
```

## Penggunaan di Routes

### Routes Publik (Tanpa Middleware)
```php
Route::get('/destinations', [FrontendController::class, 'destinations']);
Route::get('/destinations/{id}', [FrontendController::class, 'destinationDetail']);
Route::get('/reviews/{destination_id}', [FrontendController::class, 'reviews']);
```

### Routes Auth (Guest Middleware)
```php
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register']);
});
```

### Routes Terproteksi (Auth Middleware)
```php
Route::middleware('auth')->group(function () {
    Route::post('/bookings', [FrontendController::class, 'booking']);
    Route::post('/reviews', [FrontendController::class, 'addReview']);
    Route::get('/my-bookings', [FrontendController::class, 'myBookings']);
    // ... routes lainnya
});
```

### Routes Admin (Admin Middleware)
```php
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard']);
    Route::resource('categories', AdminController::class);
    // ... routes admin lainnya
});
```

## Keuntungan Implementasi Middleware

1. **Keamanan**: Pengecekan otomatis di level route, tidak perlu manual di setiap controller
2. **Maintainability**: Mudah diubah dan dikelola secara terpusat
3. **Clean Code**: Controller menjadi lebih bersih tanpa pengecekan manual
4. **Reusability**: Middleware dapat digunakan di berbagai route
5. **Consistency**: Pengecekan yang konsisten di seluruh aplikasi

## Testing Middleware

### Test Login sebagai User Biasa
1. Akses `/login`
2. Login dengan user biasa
3. Coba akses `/admin` → akan mendapat error 403

### Test Login sebagai Admin
1. Akses `/login`
2. Login dengan admin@sintia.com
3. Akses `/admin` → berhasil masuk

### Test Akses Tanpa Login
1. Logout
2. Coba akses `/my-bookings` → redirect ke login
3. Coba akses `/admin` → redirect ke login

## File yang Dimodifikasi

1. **Created**: `app/Http/Middleware/Authenticate.php`
2. **Created**: `app/Http/Middleware/AdminMiddleware.php`
3. **Created**: `app/Http/Middleware/GuestMiddleware.php`
4. **Modified**: `bootstrap/app.php` - registrasi middleware
5. **Modified**: `routes/web.php` - penerapan middleware
6. **Modified**: `app/Http/Controllers/AdminController.php` - hapus checkAdmin()
7. **Modified**: `app/Http/Controllers/FrontendController.php` - hapus pengecekan manual

## Kesimpulan

Middleware telah berhasil diimplementasikan dan menggantikan semua pengecekan manual di controller. Sistem sekarang lebih aman, terstruktur, dan mudah dikelola. 