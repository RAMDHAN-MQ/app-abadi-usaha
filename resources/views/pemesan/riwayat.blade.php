@extends('layouts.master')

@section('title', 'Riwayat Pesanan')

@section('content')
<style>
    body {
        background-color: #313473;
    }
    .nav-tabs .nav-link {
        color: #313473;
        font-weight: 600;
    }
    .nav-tabs .nav-link.active {
        background-color: #313473;
        color: #fff !important;
        border-radius: 8px 8px 0 0;
    }
    .card {
        border-radius: 10px;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body">
                    <h4 class="fw-bold text-center mb-4" style="color: #313473;">Riwayat Pesanan</h4>

                    <!-- Navigasi Tabs -->
                    <ul class="nav nav-tabs justify-content-center mb-4" id="statusTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab">Pending</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="proses-tab" data-bs-toggle="tab" data-bs-target="#proses" type="button" role="tab">Proses</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="selesai-tab" data-bs-toggle="tab" data-bs-target="#selesai" type="button" role="tab">Selesai</button>
                        </li>
                    </ul>

                    <!-- Konten Tab -->
                    <div class="tab-content" id="statusTabsContent">
                        <!-- Pending -->
                        <div class="tab-pane fade show active" id="pending" role="tabpanel">
                            @forelse($pesananPending as $pesanan)
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $pesanan->layanan_relasi->nama_layanan ?? 'Layanan Tidak Diketahui' }}</h5>
                                        <p class="mb-1"><strong>Alamat:</strong> {{ $pesanan->alamat }}</p>
                                        <p class="mb-1"><strong>Harga:</strong> Rp {{ number_format($pesanan->harga, 0, ',', '.') }}</p>
                                        <p class="mb-0"><span class="badge bg-warning text-dark">Pending</span></p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center text-muted">Tidak ada pesanan pending.</p>
                            @endforelse
                        </div>

                        <!-- Proses -->
                        <div class="tab-pane fade" id="proses" role="tabpanel">
                            @forelse($pesananProses as $pesanan)
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $pesanan->layanan->nama_layanan ?? 'Layanan Tidak Diketahui' }}</h5>
                                        <p class="mb-1"><strong>Alamat:</strong> {{ $pesanan->alamat }}</p>
                                        <p class="mb-1"><strong>Harga:</strong> Rp {{ number_format($pesanan->harga, 0, ',', '.') }}</p>
                                        <p class="mb-0"><span class="badge bg-primary">Proses</span></p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center text-muted">Tidak ada pesanan dalam proses.</p>
                            @endforelse
                        </div>

                        <!-- Selesai -->
                        <div class="tab-pane fade" id="selesai" role="tabpanel">
                            @forelse($pesananSelesai as $pesanan)
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $pesanan->layanan->nama_layanan ?? 'Layanan Tidak Diketahui' }}</h5>
                                        <p class="mb-1"><strong>Alamat:</strong> {{ $pesanan->alamat }}</p>
                                        <p class="mb-1"><strong>Harga:</strong> Rp {{ number_format($pesanan->harga, 0, ',', '.') }}</p>
                                        <p class="mb-0"><span class="badge bg-success">Selesai</span></p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center text-muted">Tidak ada pesanan selesai.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('pemesan.beranda') }}" class="btn btn-link">Kembali ke Beranda</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
