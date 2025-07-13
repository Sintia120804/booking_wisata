@extends('frontend.layout')

@section('content')
<!-- Hero Section -->
<div class="position-relative mb-0" style="min-height:320px;">
    <div style="background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=80') center center/cover no-repeat; min-height:320px; width:100%; position:absolute; top:0; left:0; right:0; bottom:0; z-index:1;"></div>
    <div style="position:absolute; top:0; left:0; right:0; bottom:0; background: linear-gradient(120deg,rgba(0,60,120,0.7) 60%,rgba(0,180,220,0.5) 100%); z-index:2;"></div>
    <div class="container position-relative" style="z-index:3; min-height:320px; display:flex; align-items:center; justify-content:center;">
        <div class="w-100 text-center py-5">
            <h1 class="display-2 fw-bold text-white mb-3" style="text-shadow:0 2px 8px rgba(0,0,0,0.25)">Destinasi Wisata</h1>
            <p class="fs-3 text-white mb-0" style="text-shadow:0 1px 4px rgba(0,0,0,0.18)">Temukan dan booking destinasi wisata lokal terbaik, mulai dari pantai, gunung, hingga taman hiburan favoritmu.<br>Liburan seru, mudah, dan hemat hanya di sini!</p>
        </div>
    </div>
</div>
<h2 class="fw-bold mb-4 mt-3 text-center" style="font-size:2.2rem;">Daftar Destinasi Wisata</h2>
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