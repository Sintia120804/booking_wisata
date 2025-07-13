@extends('frontend.layout')

@section('content')
<div class="container my-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fa fa-ticket-alt me-2"></i>Detail Booking</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            @if($booking->destination->image)
                                <img src="{{ asset('storage/'.$booking->destination->image) }}" 
                                     class="img-fluid rounded shadow" alt="{{ $booking->destination->name }}">
                            @else
                                <div class="bg-secondary d-flex align-items-center justify-content-center rounded" style="height:200px;">
                                    <span class="text-white">Tidak ada gambar</span>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h5 class="fw-bold text-primary">{{ $booking->destination->name }}</h5>
                            <p class="text-muted mb-2">
                                <i class="fa fa-map-marker-alt me-1"></i>
                                {{ $booking->destination->location }}
                            </p>
                            <p class="text-muted mb-2">
                                <i class="fa fa-tag me-1"></i>
                                {{ $booking->destination->category->name }}
                            </p>
                            <h6 class="text-success fw-bold">
                                Rp{{ number_format($booking->destination->price,0,',','.') }} / orang
                            </h6>
                            <div class="mt-4">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-2"><span class="fw-bold">Tanggal Booking:</span><br>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d F Y') }}</div>
                                        <div class="mb-2"><span class="fw-bold">Jumlah Orang:</span><br>{{ $booking->total_person }} orang</div>
                                        <div class="mb-2"><span class="fw-bold">Total Harga:</span><br><span class="text-success fw-bold">Rp{{ number_format($booking->destination->price * $booking->total_person,0,',','.') }}</span></div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2"><span class="fw-bold">Status:</span><br>
                                            @if($booking->status == 'pending')
                                                <span class="badge bg-warning text-dark fs-6">Pending</span>
                                            @elseif($booking->status == 'confirmed')
                                                <span class="badge bg-success fs-6">Confirmed</span>
                                            @else
                                                <span class="badge bg-danger fs-6">Cancelled</span>
                                            @endif
                                        </div>
                                        <div class="mb-2"><span class="fw-bold">Tanggal Dibuat:</span><br>{{ \Carbon\Carbon::parse($booking->created_at)->format('d F Y H:i') }}</div>
                                        <div class="mb-2"><span class="fw-bold">Bukti Pembayaran:</span><br>
                                            @if($booking->payment_proof)
                                                @if(Str::endsWith($booking->payment_proof, ['.jpg','.jpeg','.png']))
                                                    <a href="{{ asset('storage/'.$booking->payment_proof) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                        <i class="fa fa-image me-1"></i>Lihat Gambar
                                                    </a>
                                                @else
                                                    <a href="{{ asset('storage/'.$booking->payment_proof) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                        <i class="fa fa-file me-1"></i>Lihat File
                                                    </a>
                                                @endif
                                            @else
                                                <span class="text-muted">Belum diupload</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    @if($booking->status == 'confirmed')
                                        <a href="{{ route('my.bookings.print', $booking->id) }}" 
                                           class="btn btn-success w-100 mb-2" target="_blank">
                                            <i class="fa fa-print me-2"></i>Cetak Bukti Booking
                                        </a>
                                    @endif
                                    @if($booking->status == 'pending')
                                        <form action="{{ route('my.bookings.cancel', $booking->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-danger w-100 mb-2" 
                                                    onclick="return confirm('Yakin ingin membatalkan booking ini?')">
                                                <i class="fa fa-times me-2"></i>Batalkan Booking
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('my.bookings') }}" class="btn btn-secondary w-100 mb-2">
                                        <i class="fa fa-arrow-left me-2"></i>Kembali ke Daftar
                                    </a>
                                    <a href="{{ route('destinations.detail', $booking->destination->id) }}" class="btn btn-outline-primary w-100">
                                        <i class="fa fa-eye me-2"></i>Lihat Destinasi
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 