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
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
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
        box-shadow: 0 3px 8px rgba(0,0,0,0.05);
        color: #333;
    }

    .chart-box {
        background-color: #ffffff;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        height: 350px;
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

    /* Warna khusus statistik */
    .bg-blue { background: linear-gradient(135deg, #0984e3, #74b9ff); color: #fff; }
    .bg-green { background: linear-gradient(135deg, #00b894, #55efc4); color: #fff; }
    .bg-orange { background: linear-gradient(135deg, #fdcb6e, #e17055); color: #fff; }
</style>

<div class="container-fluid mt-4 px-5">
    <h3 class="fw-bold mb-4 text-secondary">Dashboard Layanan Sedot WC</h3>

    <div class="row g-3 align-items-stretch mb-4">
        <div class="col-lg-4 col-md-6">
            <div class="stat-card bg-blue">
                <div class="stat-title">Pemesanan Hari Ini</div>
                <div class="stat-number">{{ $todayOrders }}</div>
                <div class="stat-sub">Pesanan Masuk</div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="stat-card bg-green">
                <div class="stat-title">Pendapatan Hari Ini</div>
                <div class="stat-number">Rp.{{$todayIncome}}</div>
                <div class="stat-sub">Dari 8 layanan</div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12">
            <div class="stat-card bg-orange">
                <div class="stat-title">Total Pelanggan</div>
                <div class="stat-number">{{ $totalCustomers }}</div>
                <div class="stat-sub">Pelanggan Terdaftar</div>
            </div>
        </div>
    </div>

    <div class="recent-bar">
        Pemesanan Terbaru
    </div>

    <div class="table-responsive mb-5">
        <table class="table table-hover align-middle bg-white rounded shadow-sm">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama Pemesan</th>
                    <th>Layanan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Budi Santoso</td>
                    <td>Sedot WC Rumah Tangga</td>
                    <td>20 Okt 2025</td>
                    <td><span class="badge bg-success">Selesai</span></td>
                    <td>Rp 250.000</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Ayu Lestari</td>
                    <td>Sedot WC Restoran</td>
                    <td>20 Okt 2025</td>
                    <td><span class="badge bg-warning text-dark">Proses</span></td>
                    <td>Rp 350.000</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Reza Maulana</td>
                    <td>Perawatan Septic Tank</td>
                    <td>19 Okt 2025</td>
                    <td><span class="badge bg-danger">Batal</span></td>
                    <td>Rp 200.000</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="chart-box">
                <div class="chart-title">Pendapatan Perbulan</div>
                <canvas id="chartKeuntungan" height="120"></canvas>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="chart-box">
                <div class="chart-title">Layanan Paling Dipesan</div>
                <canvas id="chartLayanan" height="120"></canvas>
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
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt'],
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: [1800000, 2200000, 2500000, 2100000, 2700000, 3000000, 3200000, 3500000, 3800000, 4200000],
                borderColor: '#00b894',
                backgroundColor: 'rgba(0, 184, 148, 0.2)',
                borderWidth: 3,
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true } },
            plugins: { legend: { display: false } }
        }
    });

    const ctx2 = document.getElementById('chartLayanan').getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Sedot WC Rumah', 'Sedot WC Restoran', 'Perawatan Septic Tank', 'Pembersihan Saluran'],
            datasets: [{
                data: [50, 30, 15, 5],
                backgroundColor: ['#00b894', '#0984e3', '#fdcb6e', '#e17055'],
                hoverOffset: 10
            }]
        },
        options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
    });
</script>

@endsection
