@extends('frontend.layout')
@section('content')
<div class="container my-5">
    <div class="row mb-4">
        <div class="col-md-6">
            @if($destination->image)
                <img src="{{ asset('storage/'.$destination->image) }}" class="img-fluid rounded shadow mb-3" alt="{{ $destination->name }}">
            @endif
            <h2 class="fw-bold">{{ $destination->name }}</h2>
            <div class="mb-2"><span class="badge bg-primary">{{ $destination->category->name }}</span></div>
            <div class="mb-2"><i class="fa fa-map-marker-alt me-1"></i> {{ $destination->location }}</div>
            <div class="mb-2 text-primary fw-bold fs-4">Rp{{ number_format($destination->price,0,',','.') }}</div>
            <p>{{ $destination->description }}</p>
        </div>
        <div class="col-md-6">
            <div class="card card-body">
                <h4 class="mb-3">Tulis Review</h4>
                @if($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif
                <form action="{{ route('reviews.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="destination_id" value="{{ $destination->id }}">
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <select name="rating" class="form-control" required>
                            <option value="">Pilih rating</option>
                            @for($i=1;$i<=5;$i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Komentar</label>
                        <textarea name="comment" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Review</button>
                    <a href="{{ route('destinations.detail', $destination->id) }}" class="btn btn-secondary ms-2">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 