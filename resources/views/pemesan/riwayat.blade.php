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
                                        <p class="mb-1"><strong>Harga:</strong> Rp {{ number_format($pesanan->total, 0, ',', '.') }}</p>
                                        <p class="mb-1"><strong>Tanggal:</strong> {{ $pesanan->updated_at }}</p>
                                        @if($pesanan->status == 'pending')
                                            <p class="mb-0"><span class="badge bg-warning text-dark">{{ $pesanan->status }}</span></p>
                                        @else
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <span class="badge bg-danger text-white">{{ $pesanan->status }}</span>
                                                </div>
                                                <div>
                                                    <button class="btn btn-success btn-sm me-1 btn-bayar" 
                                                        data-id="{{ $pesanan->id }}">Bayar</button>
                                                    <form action="{{ route('pemesan.riwayat.destroy', $pesanan->id) }}" method="post" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm btn-delete">Batal</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif
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
                                        <h5 class="card-title">{{ $pesanan->layanan_relasi->nama_layanan ?? 'Layanan Tidak Diketahui' }}</h5>
                                        <p class="mb-1"><strong>Alamat:</strong> {{ $pesanan->alamat }}</p>
                                        <p class="mb-1"><strong>Harga:</strong> Rp {{ number_format($pesanan->total, 0, ',', '.') }}</p>
                                        <p class="mb-1"><strong>Tanggal:</strong> {{ $pesanan->updated_at }}</p>
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
                                        <h5 class="card-title">{{ $pesanan->layanan_relasi->nama_layanan ?? 'Layanan Tidak Diketahui' }}</h5>
                                        <p class="mb-1"><strong>Alamat:</strong> {{ $pesanan->alamat }}</p>
                                        <p class="mb-1"><strong>Harga:</strong> Rp {{ number_format($pesanan->total, 0, ',', '.') }}</p>
                                        <p class="mb-1"><strong>Tanggal:</strong> {{ $pesanan->updated_at }}</p>
                                        <p class="mb-0"><span class="badge bg-success">Selesai</span></p>
                                        @if($pesanan->testimoni_relasi->isEmpty())
                                        <br>
                                            <p class="m-0">Beri ulasan</p>
                                            <form action="{{ route('pemesan.riwayat.ulasan', $pesanan->id) }}" method="post">
                                                @csrf
                                                <div class="d-flex">
                                                    <input type="text" class="form-control me-2" name="komentar" id="komentar" placeholder="Tulis ulasan...">
                                                    <button type="submit" class="btn btn-success btn-sm">Kirim</button>
                                                </div>
                                            </form>
                                        @else
                                            <hr>
                                            <textarea class="form-control" readonly>{{ $pesanan->testimoni_relasi->first()->komentar }}</textarea>
                                        @endif
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
<script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}">
</script>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function () {
    const bayarButtons = document.querySelectorAll('.btn-bayar');

    bayarButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;

            fetch("{{ route('payment.payAgain') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id: id })
            })
            .then(res => res.json())
            .then(data => {
                if (data.snap_token) {
                    window.snap.pay(data.snap_token, {
                        onSuccess: function(result){
                            fetch('{{ route('payment.updateStatus') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    order_id: data.order_id,
                                    status: 'pending'
                                })
                            })
                            .then(() => {
                                alert('Pembayaran berhasil!');
                                window.location.reload();
                            });
                        },
                        onPending: function(result){
                            alert('Menunggu pembayaran...');
                        },
                        onError: function(result){
                            alert('Terjadi kesalahan saat pembayaran.');
                        },
                        onClose: function(){
                            alert('Anda menutup popup tanpa menyelesaikan pembayaran.');
                        }
                    });
                } else {
                    alert('Gagal mendapatkan token pembayaran.');
                }
            })
            .catch(err => console.error(err));
        });
    });
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection
