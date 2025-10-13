@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<style>
    .stat-card {
        background-color: #E0E0E0;
        border-radius: 12px;
        padding: 25px;
        text-align: center;
        height: 160px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .stat-title {
        font-weight: 600;
        color: #222;
        font-size: 16px;
    }

    .stat-number {
        font-weight: 800;
        font-size: 48px;
        margin: 8px 0 2px;
    }

    .stat-sub {
        color: #555;
        font-size: 14px;
    }

    .recent-bar {
        background-color: #E0E0E0;
        border-radius: 12px;
        padding: 15px 20px;
        font-weight: 600;
        margin: 30px 0 20px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .chart-box {
        background-color: #E0E0E0;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        height: 300px;
    }

    .chart-title {
        font-weight: 600;
        margin-bottom: 10px;
        color: #222;
    }
</style>


<div class="container-fluid mt-4 px-5">
    <div class="row g-3 align-items-stretch mb-3">
        <div class="col-lg-4 col-md-6">
            <div class="stat-card">
                <div class="stat-title">Pemesanan Hari ini</div>
                <div class="stat-number">0</div>
                <div class="stat-sub">Pesanan</div>
            </div>
        </div>

        <div class="col-lg-8 col-md-6">
            <div class="stat-card">
                <div class="stat-title">Pendapatan Hari ini</div>
                <div class="stat-number">Rp.0,-</div>
            </div>
        </div>
    </div>

    <div class="recent-bar">
        Pemesanan Terbaru
    </div>

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="chart-box">
                <div class="chart-title">Keuntungan Perbulan</div>
                <canvas id="chartKeuntungan" height="120"></canvas>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="chart-box">
                <div class="chart-title">Layanan Sering Dipesan</div>
                <canvas id="chartLayanan" height="120"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection