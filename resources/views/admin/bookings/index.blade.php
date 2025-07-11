@extends('admin.layout')
@section('content')
<h2>Daftar Booking</h2>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>User</th>
            <th>Destinasi</th>
            <th>Tanggal</th>
            <th>Jumlah Orang</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $book)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $book->user->name }}</td>
            <td>{{ $book->destination->name }}</td>
            <td>{{ $book->booking_date }}</td>
            <td>{{ $book->total_person }}</td>
            <td>{{ ucfirst($book->status) }}</td>
            <td>
                <a href="{{ route('bookings.show', $book->id) }}" class="btn btn-info btn-sm">Detail/Ubah Status</a>
                <form action="{{ route('bookings.destroy', $book->id) }}" method="POST" style="display:inline;">
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