@extends('frontend.layout')

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="row">
    <div class="col-md-8">
        <h1>{{ $destination->name }}</h1>
        <p><strong>Kategori:</strong> {{ $destination->category->name }}</p>
        <p><strong>Lokasi:</strong> {{ $destination->location }}</p>
        <p><strong>Harga:</strong> Rp{{ number_format($destination->price,0,',','.') }}</p>
        <p>{{ $destination->description }}</p>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Booking Sekarang</h5>
                <form action="{{ route('bookings.store') }}" method="POST">
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
                    <button type="submit" class="btn btn-success">Booking</button>
                </form>
            </div>
        </div>
    </div>
</div>
<hr>
<h3>Review Pengunjung</h3>
@foreach($destination->reviews as $review)
    <div class="mb-2">
        <strong>Rating: {{ $review->rating }}/5</strong><br>
        <span>{{ $review->comment }}</span>
    </div>
@endforeach
@if(session('user_id'))
<hr>
<h4>Tulis Review</h4>
<form action="{{ route('reviews.store') }}" method="POST">
    @csrf
    <input type="hidden" name="destination_id" value="{{ $destination->id }}">
    <div class="mb-2">
        <label for="rating" class="form-label">Rating</label>
        <select name="rating" class="form-control" required>
            <option value="">Pilih rating</option>
            @for($i=1;$i<=5;$i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>
    <div class="mb-2">
        <label for="comment" class="form-label">Komentar</label>
        <textarea name="comment" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Kirim Review</button>
</form>
@endif
@endsection 