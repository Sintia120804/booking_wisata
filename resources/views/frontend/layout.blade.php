<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Wisata Sintia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav id="navbar-user" class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="/">Booking Wisata Sintia</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/destinations">Destinasi</a></li>
                    @if(session('user_id'))
                        <li class="nav-item"><a class="nav-link" href="{{ route('my.bookings') }}">Booking Saya</a></li>
                        <li class="nav-item"><span class="nav-link">{{ session('user_name') }}</span></li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="btn btn-link nav-link" type="submit">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
   <style>
    #navbar-user {
        position: fixed !important;
        top: 0;
        width: 100%;
        z-index: 1030;
        background: linear-gradient(120deg, #0d8ddb 60%, #3ec6e0 100%) !important;
        color: #fff !important;
    }

    body {
        padding-top: 80px; /* Tambahkan ini agar konten tidak tertutup navbar */
    }

    #navbar-user .navbar-brand,
    #navbar-user .nav-link {
        color: #fff !important;
    }

    #navbar-user .nav-link.active, 
    #navbar-user .nav-link:focus, 
    #navbar-user .nav-link:hover {
        color: #fff !important;
        text-shadow: 0 1px 4px rgba(0,0,0,0.10);
    }
</style>

    </style>
</body>
</html> 