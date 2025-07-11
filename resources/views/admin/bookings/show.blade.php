@extends('admin.layout')
@section('content')
<h2>Detail Booking</h2>
<table class="table">
    <tr><th>User</th><td>{{ $booking->user->name }}</td></tr>
    <tr><th>Destinasi</th><td>{{ $booking->destination->name }}</td></tr>
    <tr><th>Tanggal</th><td>{{ $booking->booking_date }}</td></tr>
    <tr><th>Jumlah Orang</th><td>{{ $booking->total_person }}</td></tr>
    <tr><th>Status</th><td>{{ ucfirst($booking->status) }}</td></tr>
</table>
<form method="POST" action="{{ route('bookings.update', $booking->id) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="status" class="form-label">Ubah Status</label>
        <select class="form-control" name="status">
            <option value="pending" @if($booking->status=='pending') selected @endif>Pending</option>
            <option value="confirmed" @if($booking->status=='confirmed') selected @endif>Confirmed</option>
            <option value="cancelled" @if($booking->status=='cancelled') selected @endif>Cancelled</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Update Status</button>
    <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection 