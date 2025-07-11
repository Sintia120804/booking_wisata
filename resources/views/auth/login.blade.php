@extends('frontend.layout')
@section('content')
<h2>Login</h2>
<form method="POST" action="{{ url('/login') }}">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" required>
    </div>
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
    <button type="submit" class="btn btn-primary">Login</button>
    <a href="{{ route('register') }}" class="btn btn-link">Register</a>
</form>
@endsection 