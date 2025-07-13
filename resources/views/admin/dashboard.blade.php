@extends('admin.layout')

@section('content')
<div class="container-fluid px-0">
    <!-- Hero Section -->
    <div class="mb-4 p-4 rounded-4 shadow-sm position-relative overflow-hidden" style="background: linear-gradient(120deg, #0d8ddb 60%, #3ec6e0 100%); min-height: 140px;">
        <div class="row align-items-center">
            <div class="col-md-9">
                <h1 class="fw-bold text-white mb-2" style="font-size:2.3rem; text-shadow:0 2px 8px rgba(0,0,0,0.10)"><i class="fa fa-tachometer-alt me-2"></i>Admin Panel</h1>
                <p class="text-white fs-5 mb-0" style="text-shadow:0 1px 4px rgba(0,0,0,0.10)">Kelola data destinasi, user, booking, dan review wisata dengan mudah dan cepat.</p>
            </div>
            <div class="col-md-3 d-none d-md-block text-end">
                <img src="https://img.icons8.com/color/120/000000/dashboard-layout.png" alt="Admin" style="max-width:90px; filter:drop-shadow(0 4px 16px rgba(0,0,0,0.10));">
            </div>
        </div>
    </div>
    <!-- Statistik Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card shadow border-0 rounded-4 bg-light-blue-gradient">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <span class="fs-3 me-2 text-success"><i class="fa fa-calendar-check"></i></span>
                        <span class="fw-bold">Total Booking</span>
                    </div>
                    <div class="fs-4 fw-bold">{{ $totalBooking }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow border-0 rounded-4 bg-light-green-gradient">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <span class="fs-3 me-2 text-primary"><i class="fa fa-users"></i></span>
                        <span class="fw-bold">Total User</span>
                    </div>
                    <div class="fs-4 fw-bold">{{ $totalUser }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow border-0 rounded-4 bg-light-yellow-gradient">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <span class="fs-3 me-2 text-warning"><i class="fa fa-map-marker-alt"></i></span>
                        <span class="fw-bold">Total Destinasi</span>
                    </div>
                    <div class="fs-4 fw-bold">{{ $totalDestination }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow border-0 rounded-4 bg-light-purple-gradient">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <span class="fs-3 me-2 text-info"><i class="fa fa-star"></i></span>
                        <span class="fw-bold">Total Review</span>
                    </div>
                    <div class="fs-4 fw-bold">{{ $totalReview }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="card shadow border-0 rounded-4 mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-bold">Booking per Bulan</span>
                    </div>
                    <canvas id="bookingChart" height="90"></canvas>
                </div>
            </div>
            <div class="card shadow border-0 rounded-4">
                <div class="card-body">
                    <div class="fw-bold mb-3">Booking History</div>
                    <div class="table-responsive">
                        <table class="table table-sm align-middle">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User</th>
                                    <th>Destinasi</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookingHistory as $i => $b)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $b->user->name ?? '-' }}</td>
                                    <td>{{ $b->destination->name ?? '-' }}</td>
                                    <td>{{ $b->booking_date }}</td>
                                    <td>
                                        @if($b->status=='pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($b->status=='confirmed')
                                            <span class="badge bg-success">Confirmed</span>
                                        @else
                                            <span class="badge bg-danger">Cancelled</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow border-0 rounded-4 mb-4">
                <div class="card-body">
                    <div class="fw-bold mb-2">Destinasi Populer</div>
                    @foreach($popularDestinations as $dest)
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-1">
                                @if($dest->image)
                                    <img src="{{ asset('storage/'.$dest->image) }}" alt="{{ $dest->name }}" width="40" height="40" class="rounded me-2" style="object-fit:cover;">
                                @else
                                    <div class="bg-secondary rounded me-2" style="width:40px;height:40px;"></div>
                                @endif
                                <span class="fw-semibold">{{ $dest->name }}</span>
                                <span class="ms-auto small text-muted">{{ $dest->bookings_count }} booking</span>
                            </div>
                            <div class="progress" style="height:6px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $totalBooking ? round($dest->bookings_count/$totalBooking*100) : 0 }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card shadow border-0 rounded-4">
                <div class="card-body">
                    <div class="fw-bold mb-2">Statistik Booking</div>
                    <div class="mb-2">Pending: <span class="badge bg-warning text-dark">{{ $bookingPending }}</span></div>
                    <div class="mb-2">Confirmed: <span class="badge bg-success">{{ $bookingConfirmed }}</span></div>
                    <div class="mb-2">Cancelled: <span class="badge bg-danger">{{ $bookingCancelled }}</span></div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('bookingChart').getContext('2d');
const bookingChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Booking',
            data: @json($chartData),
            backgroundColor: '#4f8cff',
            borderRadius: 6,
            maxBarThickness: 32
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1 } }
        }
    }
});
</script>
@endpush
<style>
.bg-light-blue-gradient {
    background: linear-gradient(120deg, #e3f0ff 60%, #c6e6ff 100%) !important;
}
.bg-light-green-gradient {
    background: linear-gradient(120deg, #e6fff2 60%, #c6ffe6 100%) !important;
}
.bg-light-yellow-gradient {
    background: linear-gradient(120deg, #fffbe6 60%, #fff7c6 100%) !important;
}
.bg-light-purple-gradient {
    background: linear-gradient(120deg, #f3e6ff 60%, #e6c6ff 100%) !important;
}
</style>
@endsection 