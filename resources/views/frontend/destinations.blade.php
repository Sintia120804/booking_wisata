@extends('frontend.layout')

@section('content')
<!-- Hero Section -->
<div class="hero-section text-white mb-5" style="background: linear-gradient(135deg, #0077b6 0%, #48cae4 100%); min-height: 280px; position: relative;">
    <div class="container py-5">
        <h1 class="display-4 fw-bold">Destinasi Wisata</h1>
        <p class="lead">Temukan dan booking destinasi wisata lokal terbaik untuk liburanmu!</p>
    </div>
</div>
<!-- Grid Card Section -->
<div class="container">
    <div class="row g-4">
        @foreach($destinations as $destination)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                @if($destination->image)
                    <img src="{{ asset('storage/'.$destination->image) }}" class="card-img-top" alt="{{ $destination->name }}" style="height:180px;object-fit:cover;">
                @else
                    <div class="bg-secondary d-flex align-items-center justify-content-center" style="height:180px;">
                        <span class="text-white">Tidak ada gambar</span>
                    </div>
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $destination->name }}</h5>
                    <div class="mb-2 text-primary fw-bold">Rp{{ number_format($destination->price,0,',','.') }}</div>
                    <p class="card-text flex-grow-1">{{ Str::limit($destination->description, 80) }}</p>
                    <a href="{{ route('destinations.detail', $destination->id) }}" class="btn btn-outline-primary mt-auto">Detail</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@push('styles')
<style>
.hero-section {
    border-bottom-left-radius: 60px;
    border-bottom-right-radius: 60px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.08);
}
</style>
@endpush 