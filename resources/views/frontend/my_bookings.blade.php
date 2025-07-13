@extends('frontend.layout')
@section('content')
<h2>Booking Saya</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Gambar</th>
            <th>Destinasi</th>
            <th>Tanggal</th>
            <th>Jumlah Orang</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($bookings as $book)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                @if($book->destination->image)
                    <img src="{{ asset('storage/'.$book->destination->image) }}" alt="Gambar" width="60">
                @else
                    <span class="text-muted">-</span>
                @endif
            </td>
            <td>{{ $book->destination->name }}</td>
            <td>{{ $book->booking_date }}</td>
            <td>{{ $book->total_person }}</td>
            <td>
                @if($book->status == 'pending')
                    <span class="badge bg-warning text-dark">Pending</span>
                @elseif($book->status == 'confirmed')
                    <span class="badge bg-success">Confirmed</span>
                @else
                    <span class="badge bg-danger">Cancelled</span>
                @endif
            </td>
            <td>
                @if($book->status == 'pending')
                    <form action="{{ route('my.bookings.cancel', $book->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Batalkan booking ini?')">Batalkan</button>
                    </form>
                @else
                    <span class="text-muted">-</span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">Belum ada booking.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection 