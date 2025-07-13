<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Booking #{{ $booking->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none !important; }
            .print-only { display: block !important; }
            body { margin: 0; padding: 20px; }
            .card { border: 1px solid #000 !important; box-shadow: none !important; }
        }
        .print-only { display: none; }
        .border-dashed { border-style: dashed !important; }
        .text-center { text-align: center !important; }
        .fw-bold { font-weight: bold !important; }
        .text-primary { color: #0d6efd !important; }
        .text-success { color: #198754 !important; }
        .bg-light { background-color: #f8f9fa !important; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold text-primary mb-1">BUKTI BOOKING WISATA</h2>
                <h4 class="text-muted mb-0">Booking Wisata Sintia</h4>
                <p class="text-muted mb-0">Jl. Wisata No. 123, Padang</p>
                <p class="text-muted">Telp: 082286904493 | Email: info@bookingwisata.com</p>
            </div>
        </div>

        <!-- Booking Info -->
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="card border-dashed">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fa fa-ticket-alt me-2"></i>INFORMASI BOOKING</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="fw-bold">Tanggal Booking:</td>
                                        <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Jumlah Orang:</td>
                                        <td>{{ $booking->total_person }} orang</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Status:</td>
                                        <td><span class="badge bg-success fs-6">CONFIRMED</span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="fw-bold">Nama Pemesan:</td>
                                        <td>{{ $booking->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Email:</td>
                                        <td>{{ $booking->user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Tanggal Cetak:</td>
                                        <td>{{ \Carbon\Carbon::now()->format('d F Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Total Harga:</td>
                                        <td class="text-success fw-bold">
                                            Rp{{ number_format($booking->destination->price * $booking->total_person,0,',','.') }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-dashed">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">DESTINASI WISATA</h6>
                    </div>
                    <div class="card-body text-center">
                        @if($booking->destination->image)
                            <img src="{{ asset('storage/'.$booking->destination->image) }}" 
                                 class="img-fluid rounded mb-2" style="max-height: 120px;" alt="{{ $booking->destination->name }}">
                        @endif
                        <h6 class="fw-bold text-primary">{{ $booking->destination->name }}</h6>
                        <p class="text-muted mb-1">
                            <i class="fa fa-map-marker-alt me-1"></i>
                            {{ $booking->destination->location }}
                        </p>
                        <p class="text-muted mb-1">
                            <i class="fa fa-tag me-1"></i>
                            {{ $booking->destination->category->name }}
                        </p>
                        <h6 class="text-success fw-bold">
                            Rp{{ number_format($booking->destination->price,0,',','.') }} / orang
                        </h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Proof & Terms (Side by Side) -->
        @if($booking->payment_proof)
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card border-dashed h-100">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fa fa-money-check-alt me-2"></i>BUKTI PEMBAYARAN</h5>
                    </div>
                    <div class="card-body text-center">
                        @if(Str::endsWith($booking->payment_proof, ['.jpg','.jpeg','.png']))
                            <img src="{{ asset('storage/'.$booking->payment_proof) }}" 
                                 class="img-fluid rounded mb-2" style="max-height: 200px;" alt="Bukti Pembayaran">
                        @else
                            <div class="alert alert-info d-inline-block">
                                <i class="fa fa-file-pdf me-2"></i>
                                Bukti pembayaran tersedia dalam format PDF
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-dashed h-100">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fa fa-info-circle me-2"></i>SYARAT & KETENTUAN</h5>
                    </div>
                    <div class="card-body">
                        <ol class="mb-0">
                            <li>Bukti booking ini wajib dibawa saat check-in di destinasi wisata.</li>
                            <li>Booking dapat dibatalkan maksimal 24 jam sebelum tanggal keberangkatan.</li>
                            <li>Pembayaran dilakukan di tempat atau sesuai instruksi yang diberikan.</li>
                            <li>Harga sudah termasuk tiket masuk destinasi wisata.</li>
                            <li>Transportasi dan akomodasi tidak termasuk dalam paket ini.</li>
                            <li>Booking Wisata Sintia tidak bertanggung jawab atas kehilangan atau kerusakan barang pribadi.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        @else
        <!-- Only Terms if no Payment Proof -->
        <div class="row mb-4">
            <div class="col-md-8 mx-auto">
                <div class="card border-dashed">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fa fa-info-circle me-2"></i>SYARAT & KETENTUAN</h5>
                    </div>
                    <div class="card-body">
                        <ol class="mb-0">
                            <li>Bukti booking ini wajib dibawa saat check-in di destinasi wisata.</li>
                            <li>Booking dapat dibatalkan maksimal 24 jam sebelum tanggal keberangkatan.</li>
                            <li>Pembayaran dilakukan di tempat atau sesuai instruksi yang diberikan.</li>
                            <li>Harga sudah termasuk tiket masuk destinasi wisata.</li>
                            <li>Transportasi dan akomodasi tidak termasuk dalam paket ini.</li>
                            <li>Booking Wisata Sintia tidak bertanggung jawab atas kehilangan atau kerusakan barang pribadi.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Footer -->
        <div class="row">
            <div class="col-12 text-center">
                <div class="border-top pt-3">
                    <p class="text-muted mb-1">Terima kasih telah memilih Booking Wisata Sintia</p>
                    <p class="text-muted mb-0">Selamat menikmati perjalanan wisata Anda!</p>
                </div>
            </div>
        </div>

        <!-- Print Button -->
        <div class="row mt-4 no-print">
            <div class="col-12 text-center">
                <button onclick="window.print()" class="btn btn-primary btn-lg">
                    <i class="fa fa-print me-2"></i>Cetak Bukti Booking
                </button>
                <a href="{{ route('my.bookings.detail', $booking->id) }}" class="btn btn-secondary btn-lg ms-2">
                    <i class="fa fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 