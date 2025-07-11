<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Booking Wisata Sintia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="/admin">Admin Panel</a>
            <form action="{{ route('logout') }}" method="POST" class="mb-0">
                @csrf
                <button class="btn btn-outline-light btn-sm" type="submit">Logout</button>
            </form>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 bg-light p-3 min-vh-100">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="/admin">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/categories">Kategori</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.destinations.index') }}">Destinasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/bookings">Booking</a></li>
                    <li class="nav-item"><a class="nav-link" href="/admin/reviews">Review</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}">User</a></li>
                </ul>
            </div>
            <div class="col-md-10 p-4">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 