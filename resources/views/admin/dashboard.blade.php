@extends('layouts.admin')

@section('title', 'Dashboard Sedot WC')

@section('content')
<style>
    body {
        background-color: #f5f6fa;
    }

    .stat-card {
        background: linear-gradient(145deg, #ffffff, #f1f1f1);
        border-radius: 16px;
        padding: 25px;
        text-align: center;
        height: 160px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .stat-title {
        font-weight: 600;
        color: #444;
        font-size: 15px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-number {
        font-weight: 800;
        font-size: 44px;
        margin: 8px 0 5px;
        color: #2f3640;
    }

    .stat-sub {
        color: #777;
        font-size: 14px;
    }

    .recent-bar {
        background-color: #ffffff;
        border-left: 5px solid #00b894;
        border-radius: 10px;
        padding: 15px 20px;
        font-weight: 600;
        margin: 40px 0 25px;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
        color: #333;
    }

    .chart-box {
        background-color: #ffffff;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        height: 450px;
        transition: all 0.3s ease;
    }

    .chart-box:hover {
        transform: translateY(-3px);
    }

    .chart-title {
        font-weight: 600;
        margin-bottom: 15px;
        color: #333;
    }

    .chart-box canvas {
        width: 100% !important;
        height: 90% !important;
    }


    /* Warna khusus statistik */
    .bg-blue {
        background: linear-gradient(135deg, #0984e3, #74b9ff);
        color: #fff;
    }

    .bg-green {
        background: linear-gradient(135deg, #00b894, #55efc4);
        color: #fff;
    }

    .bg-orange {
        background: linear-gradient(135deg, #fdcb6e, #e17055);
        color: #fff;
    }
</style>

<div class="container-fluid mt-4 px-5">
    <div class="row g-3 align-items-stretch mb-4">
        <div class="col-lg-4 col-md-6">
            <div class="stat-card bg-blue">
                <div class="stat-title">Pemesanan Hari Ini</div>
                <div class="stat-number">{{ $todayOrders }}</div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="stat-card bg-green">
                <div class="stat-title">Pendapatan Hari Ini</div>
                <div class="stat-number">Rp.{{$todayIncome}}</div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12">
            <div class="stat-card bg-orange">
                <div class="stat-title">Total Pelanggan</div>
                <div class="stat-number">{{ $totalCustomers }}</div>
            </div>
        </div>
    </div>

    <div class="recent-bar">
        Pemesanan Terbaru


        <div class="table-responsive">
            <table class="table table-hover align-middle bg-white rounded shadow-sm">
                <thead class="table-light">
                    <tr>
                        <th>Nama Pemesan</th>
                        <th>Layanan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="cursor: pointer;" onclick="window.location='{{ route('admin.pemesanan.show', $pemesanTerbaru->id) }}'">
                        <td class="text-center">{{ $pemesanTerbaru->nama_pemesan }}</td>
                        <td class="text-center">{{ $pemesanTerbaru->layanan_relasi->nama_layanan }}</td>
                        <td class="text-center">{{ $pemesanTerbaru->created_at }}</td>
                        <td class="text-center">
                            @if($pemesanTerbaru->status == 'selesai')
                            <span class="badge bg-success">{{ $pemesanTerbaru->status }}</span>
                            @elseif($pemesanTerbaru->status == 'proses')
                            <span class="badge bg-warning text-dark">{{ $pemesanTerbaru->status }}</span>
                            @else
                            <span class="badge bg-secondary">{{ $pemesanTerbaru->status }}</span>
                            @endif
                        </td>
                        <td class="text-end">Rp {{ number_format($pemesanTerbaru->harga + $pemesanTerbaru->ongkir, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="chart-box">
                <div class="chart-title">Pendapatan Perbulan</div>
                <canvas id="chartKeuntungan"></canvas>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="chart-box">
                <div class="chart-title">Layanan Paling Dipesan</div>
                <canvas id="chartLayanan"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx1 = document.getElementById('chartKeuntungan').getContext('2d');
new Chart(ctx1, {
    type: 'line',
    data: {
        labels: @json($bulanArray),
        datasets: [{
            label: 'Pendapatan (Rp)',
            data: @json($pendapatanArray),
            borderColor: '#00b894',
            backgroundColor: 'rgba(0,184,148,0.2)',
            borderWidth: 3,
            fill: true,
            tension: 0.3,
            pointRadius: 5
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: { mode: 'nearest', intersect: false },
        plugins: { tooltip: { enabled: true }, legend: { display: false } },
        scales: { y: { beginAtZero: true } }
    }
});
</script>

<script>
    const ctx2 = document.getElementById('chartLayanan').getContext('2d');
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: @json($labelsLayanan),
            datasets: [{
                label: 'Jumlah Pesanan',
                data: @json($totalsLayanan),
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true
                },
                tooltip: {
                    enabled: true
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
</script>


@endsection