# Cara Penggunaan Middleware

## Login Credentials

### Admin
- **Email**: admin@sintia.com
- **Password**: password123
- **Role**: admin

### User Biasa
- **Email**: user@sintia.com  
- **Password**: password123
- **Role**: user

## Testing Middleware

### 1. Test Guest Middleware
- Akses `/login` atau `/register` tanpa login → ✅ Berhasil
- Login sebagai admin, lalu akses `/login` → 🔄 Redirect ke `/admin`
- Login sebagai user, lalu akses `/login` → 🔄 Redirect ke `/`

### 2. Test Auth Middleware
- Akses `/my-bookings` tanpa login → 🔄 Redirect ke `/login`
- Login sebagai user/admin, lalu akses `/my-bookings` → ✅ Berhasil

### 3. Test Admin Middleware
- Akses `/admin` tanpa login → 🔄 Redirect ke `/login`
- Login sebagai user biasa, lalu akses `/admin` → ❌ Error 403
- Login sebagai admin, lalu akses `/admin` → ✅ Berhasil

## Routes yang Terproteksi

### Routes Publik
- `/` (redirect ke destinations)
- `/destinations`
- `/destinations/{id}`
- `/reviews/{destination_id}`

### Routes dengan Auth Middleware
- `/bookings` (POST)
- `/reviews` (POST)
- `/my-bookings`
- `/my-bookings/{id}`
- `/my-bookings/{id}/print`
- `/my-bookings/{id}/cancel`
- `/booking/create/{id}`
- `/review/create/{id}`

### Routes dengan Admin Middleware
- `/admin/*` (semua routes admin)

### Routes dengan Guest Middleware
- `/login`
- `/register` 