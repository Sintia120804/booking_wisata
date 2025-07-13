@extends('frontend.layout')
@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height:70vh;">
    <div class="card shadow-lg p-4 border-0" style="max-width:400px; width:100%; border-radius:1.5rem; background:linear-gradient(120deg,#f8fbff 60%,#eaf6ff 100%);">
        <div class="text-center mb-4">
            <span class="d-inline-block bg-primary text-white rounded-circle mb-2" style="width:56px;height:56px;line-height:56px;font-size:2rem;"><i class="fa fa-user"></i></span>
            <h2 class="fw-bold mb-1">Login</h2>
            <div class="text-muted mb-2">Masuk ke akun Anda</div>
        </div>
        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif
        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control rounded-pill px-3 py-2" name="email" required autofocus>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control rounded-pill px-3 py-2" name="password" required>
            </div>
            @if($errors->any())
                <div class="alert alert-danger text-center">{{ $errors->first() }}</div>
            @endif
            <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-semibold mb-2">Login</button>
            <div class="text-center mt-2">
                <span class="text-muted">Belum punya akun?</span>
                <a href="{{ route('register') }}" class="fw-semibold">Register</a>
            </div>
        </form>
    </div>
</div>
@endsection 