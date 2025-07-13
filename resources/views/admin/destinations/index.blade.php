@extends('admin.layout')
@section('content')
<h2>Daftar Destinasi Wisata</h2>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<a href="{{ route('admin.destinations.create') }}" class="btn btn-primary mb-4">Tambah Destinasi</a>
<div class="row g-4">
    @foreach($destinations as $dest)
    <div class="col-12 col-md-6 mx-auto">
        <div class="card shadow-sm border-0 rounded-4 p-3 d-flex flex-row align-items-stretch" style="min-height:170px;">
            <div class="flex-shrink-0" style="width:150px;">
                @if($dest->image)
                    <img src="{{ asset('storage/'.$dest->image) }}" alt="Gambar" class="rounded-4" style="object-fit:cover; width:100%; height:140px;">
                @else
                    <div class="bg-secondary d-flex align-items-center justify-content-center rounded-4" style="height:140px; width:100%;">
                        <span class="text-white">Tidak ada gambar</span>
                    </div>
                @endif
            </div>
            <div class="flex-grow-1 ps-4 d-flex flex-column justify-content-between">
                <div>
                    <h5 class="fw-bold mb-1">{{ $dest->name }}</h5>
                    <div class="mb-1"><span class="badge bg-primary">{{ $dest->category->name }}</span></div>
                    <div class="mb-1 text-muted"><i class="fa fa-map-marker-alt me-1"></i> {{ $dest->location }}</div>
                    @if($dest->description)
                        <div class="mb-1 text-truncate-2" style="max-width:100%; color:#555;">{{ Str::limit($dest->description, 80) }}</div>
                    @endif
                </div>
                <div class="d-flex flex-wrap align-items-center mb-2 mt-2">
                    <div class="me-4 text-success fw-bold">Harga: Rp{{ number_format($dest->price,0,',','.') }}</div>
                </div>
                <div class="d-flex align-items-stretch gap-2 mt-2" style="max-width:260px;">
                    <a href="{{ route('admin.destinations.edit', $dest->id) }}" class="btn btn-warning btn-sm flex-fill" style="min-width:90px;">Edit</a>
                    <form action="{{ route('admin.destinations.destroy', $dest->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')" class="m-0 p-0 flex-fill">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm flex-fill" style="min-width:90px;">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
<style>
.text-truncate-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
}
</style> 