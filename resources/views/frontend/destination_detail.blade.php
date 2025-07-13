@extends('frontend.layout')

@section('content')
<div class="container my-4">
    <div class="row mb-4">
        <div class="col-md-7">
            @if($destination->image)
                <img src="{{ asset('storage/'.$destination->image) }}" class="img-fluid rounded shadow" alt="{{ $destination->name }}">
            @else
                <div class="bg-secondary d-flex align-items-center justify-content-center rounded" style="height:320px;">
                    <span class="text-white">Tidak ada gambar</span>
                </div>
            @endif
        </div>
        <div class="col-md-5">
            <h2 class="fw-bold">{{ $destination->name }}</h2>
            <div class="mb-2"><span class="badge bg-primary">{{ $destination->category->name }}</span></div>
            <div class="mb-2"><i class="fa fa-map-marker-alt me-1"></i> {{ $destination->location }}</div>
            <div class="mb-2 text-primary fw-bold fs-4">Rp{{ number_format($destination->price,0,',','.') }}</div>
            <p>{{ $destination->description }}</p>
            <div class="d-flex gap-3 mt-4 align-items-start flex-wrap">
                <div class="d-flex flex-column">
                    <a href="{{ route('booking.create', $destination->id) }}" class="btn btn-success btn-lg fw-semibold mb-3" style="min-width:220px;">Booking Sekarang</a>
                    <a href="{{ route('review.create', $destination->id) }}" class="btn btn-outline-primary btn-lg fw-semibold" style="min-width:220px;">Tulis Review</a>
                </div>
                <a href="{{ route('destinations') }}" class="btn btn-secondary btn-lg fw-semibold" style="min-width:180px;"><i class="fa fa-arrow-left me-1"></i> Kembali</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="collapse mb-4" id="bookingForm">
                <div class="card card-body">
                    <h5 class="mb-3">Form Booking</h5>
                    @if($errors->any() && session('form') !== 'review')
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
                    </form>
                </div>
            </div>
            <div class="collapse mb-4" id="reviewForm">
                <div class="card card-body">
                    <h5 class="mb-3">Tulis Review</h5>
                    @if($errors->any() && session('form') === 'review')
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif
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
                </div>
            </div>
            <hr>
            <h4>Review Pengunjung</h4>
            @forelse($destination->reviews as $review)
                <div class="mb-2 border-bottom pb-2">
                    <strong>Rating: {{ $review->rating }}/5</strong><br>
                    <span>{{ $review->comment }}</span>
                </div>
            @empty
                <div class="text-muted">Belum ada review.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection 