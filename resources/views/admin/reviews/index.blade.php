@extends('admin.layout')
@section('content')
<h2>Daftar Review</h2>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>User</th>
            <th>Destinasi</th>
            <th>Rating</th>
            <th>Komentar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reviews as $rev)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $rev->user->name }}</td>
            <td>{{ $rev->destination->name }}</td>
            <td>{{ $rev->rating }}</td>
            <td>{{ $rev->comment }}</td>
            <td>
                <form action="{{ route('reviews.destroy', $rev->id) }}" method="POST" style="display:inline;">
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