<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Booking Wisata Sintia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-admin-custom navbar-dark mb-0" style="position: fixed; top: 0; width: 100%; z-index: 1050;">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="/admin">Admin Wisata</a>
            <form action="{{ route('logout') }}" method="POST" class="mb-0">
                @csrf
                <button class="btn btn-outline-light btn-sm" type="submit">Logout</button>
            </form>
        </div>
    </nav>
    <div class="sidebar-admin">
        <ul class="nav flex-column py-4">
            <li class="nav-item mb-2">
                <a class="nav-link text-white fw-semibold d-flex align-items-center @if(request()->is('admin')) active @endif" href="/admin">
                    <i class="fa fa-tachometer-alt me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-white fw-semibold d-flex align-items-center @if(request()->is('admin/categories*')) active @endif" href="/admin/categories">
                    <i class="fa fa-list me-2"></i> Kategori
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-white fw-semibold d-flex align-items-center @if(request()->is('admin/destinations*')) active @endif" href="{{ route('admin.destinations.index') }}">
                    <i class="fa fa-map-marked-alt me-2"></i> Destinasi
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-white fw-semibold d-flex align-items-center @if(request()->is('admin/bookings*')) active @endif" href="/admin/bookings">
                    <i class="fa fa-ticket-alt me-2"></i> Booking
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-white fw-semibold d-flex align-items-center @if(request()->is('admin/reviews*')) active @endif" href="/admin/reviews">
                    <i class="fa fa-star me-2"></i> Review
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link text-white fw-semibold d-flex align-items-center @if(request()->is('admin/users*')) active @endif" href="{{ route('admin.users.index') }}">
                    <i class="fa fa-user me-2"></i> User
                </a>
            </li>
        </ul>
    </div>
    <div class="main-content" style="margin-left:180px; padding-top:70px; padding-right:32px; padding-left:32px;">
        @yield('content')
    </div>
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <style>
        .sidebar-admin {
            background: linear-gradient(120deg, #0d8ddb 60%, #3ec6e0 100%) !important;
            position: fixed;
            top: 0;
            left: 0;
            width: 180px;
            height: 100vh;
            z-index: 1040;
            overflow-y: auto;
            padding-top: 70px;
        }
        .sidebar-admin .nav-link {
            border-radius: 8px;
            transition: background 0.2s, color 0.2s;
            font-size: 1.08rem;
            padding: 12px 18px;
        }
        .sidebar-admin .nav-link.active, .sidebar-admin .nav-link:hover {
            background: #1565c0;
            color: #fff !important;
        }
        .sidebar-admin .nav-link i {
            width: 22px;
            text-align: center;
        }
        .navbar-admin-custom {
            background: linear-gradient(120deg, #0d8ddb 60%, #3ec6e0 100%) !important;
            border: none;
            box-shadow: none;
            position: sticky;
            top: 0;
            z-index: 1050;
        }
        .main-content {
            min-height: calc(100vh - 70px);
        }
    </style>
</body>
</html> 