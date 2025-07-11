@extends('admin.layout')
@section('content')
<h2>Daftar Destinasi Wisata</h2>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<a href="{{ route('admin.destinations.create') }}" class="btn btn-primary mb-3">Tambah Destinasi</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Lokasi</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($destinations as $dest)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $dest->name }}</td>
            <td>{{ $dest->category->name }}</td>
            <td>{{ $dest->location }}</td>
            <td>Rp{{ number_format($dest->price,0,',','.') }}</td>
            <td>
                <a href="{{ route('admin.destinations.edit', $dest->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.destinations.destroy', $dest->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection 