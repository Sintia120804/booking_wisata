@extends('admin.layout')
@section('content')
<h2>Edit Destinasi</h2>
<form method="POST" action="{{ route('admin.destinations.update', $destination->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Nama Destinasi</label>
        <input type="text" class="form-control" name="name" value="{{ $destination->name }}" required>
    </div>
    <div class="mb-3">
        <label for="category_id" class="form-label">Kategori</label>
        <select class="form-control" name="category_id" required>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @if($destination->category_id == $cat->id) selected @endif>{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="location" class="form-label">Lokasi</label>
        <input type="text" class="form-control" name="location" value="{{ $destination->location }}" required>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Harga</label>
        <input type="number" class="form-control" name="price" min="0" value="{{ $destination->price }}" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea class="form-control" name="description" required>{{ $destination->description }}</textarea>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Foto Wisata (jpg/png, opsional)</label>
        @if($destination->image)
            <div class="mb-2">
                <img src="{{ asset('storage/'.$destination->image) }}" alt="Foto" width="120">
            </div>
        @endif
        <input type="file" class="form-control" name="image" accept="image/*">
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('admin.destinations.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection 