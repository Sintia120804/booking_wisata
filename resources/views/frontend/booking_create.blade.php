@extends('frontend.layout')
@section('content')
<div class="container my-5">
    <div class="row mb-4">
        <div class="col-md-6">
            @if($destination->image)
                <img src="{{ asset('storage/'.$destination->image) }}" class="img-fluid rounded shadow mb-3" alt="{{ $destination->name }}">
            @endif
            <h2 class="fw-bold">{{ $destination->name }}</h2>
            <div class="mb-2"><span class="badge bg-primary">{{ $destination->category->name }}</span></div>
            <div class="mb-2"><i class="fa fa-map-marker-alt me-1"></i> {{ $destination->location }}</div>
            <div class="mb-2 text-primary fw-bold fs-4">Rp{{ number_format($destination->price,0,',','.') }}</div>
            <p>{{ $destination->description }}</p>
        </div>
        <div class="col-md-6">
            <div class="card card-body">
                <h4 class="mb-3">Form Booking</h4>
                @if($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif
                <form action="{{ route('bookings.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="destination_id" value="{{ $destination->id }}">
                    <div class="mb-3">
                        <label for="booking_date" class="form-label">Tanggal Booking</label>
                        <input type="date" class="form-control" name="booking_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="total_person" class="form-label">Jumlah Orang</label>
                        <input type="number" class="form-control" name="total_person" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="payment_proof" class="form-label">Bukti Pembayaran (jpg/png/pdf, opsional)</label>
                        <input type="file" class="form-control" name="payment_proof" accept="image/*,.pdf">
                    </div>
                    <button type="submit" class="btn btn-success">Booking</button>
                    <a href="{{ route('destinations.detail', $destination->id) }}" class="btn btn-secondary ms-2">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 