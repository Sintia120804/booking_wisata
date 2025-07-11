@extends('frontend.layout')

@section('content')
<h1 class="mb-4">Daftar Destinasi Wisata</h1>
<div class="row">
    @foreach($destinations as $destination)
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">{{ $destination->name }}</h5>
                <p class="card-text">Kategori: {{ $destination->category->name }}</p>
                <p class="card-text">Lokasi: {{ $destination->location }}</p>
                <p class="card-text">Harga: Rp{{ number_format($destination->price,0,',','.') }}</p>
                <a href="{{ route('destinations.detail', $destination->id) }}" class="btn btn-primary">Detail</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection 