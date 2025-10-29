@extends('layouts.app')

@section('title', 'CatatYuk - Meryta Cookies')

@section('content')
<style>
    body {
        background-color: #f6f2ee;
        font-family: 'Poppins', sans-serif;
        color: #4e342e;
    }
    .card {
        margin-top: 30px;
        background: #fff7f2;
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(120, 80, 50, 0.1);
    }
    .card h3 {
        font-size: 18px;
        margin-bottom: 10px;
        color: #3e2723;
    }
    .highlight {
        font-size: 30px;
        font-weight: bold;
        color: #5d4037;
    }
    .mini-cards {
        display: flex;
        flex-wrap: wrap;
        margin-top: 15px;
    }
    .mini-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 15px;
        width: 48%;
        margin: 10px 10px 25px 10px;
        text-align: center;
        box-shadow: 0 2px 5px rgba(100, 60, 40, 0.1);
        transition: 0.3s;
    }
    .mini-card:hover {
        background-color: #efebe9;
        transform: translateY(-3px);
    }
    .mini-card h4 {
        color: #6d4c41;
        font-size: 14px;
    }
    .mini-card p {
        font-weight: bold;
        color: #4e342e;
        font-size: 16px;
    }
    .chart-container {
        width: 100%;
        height: 30rem;
    }
    .btn-group-laporan {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin: 20px;
    }
    .btn-laporan {
        background-color: #8C623B;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        text-decoration: none;
        transition: 0.3s;
    }
    .btn-laporan:hover {
        background-color: #A27E59;
        transform: translateY(-3px);
    }
</style>

<div class="card">
    <h3>Aktivitas Penjualan Kue - Meryta Cookies</h3>
    <div class="highlight">Rp {{ number_format($totalPenjualan ?? 0, 0, ',', '.') }}</div>
    <p style="color:#795548;">Total pendapatan dari seluruh penjualan.</p>

    <div class="mini-cards">
        <div class="mini-card">
            <h4>Hari Ini</h4>
            <p>Rp {{ number_format($totalHariIni ?? 0, 0, ',', '.') }}</p>
        </div>
        <div class="mini-card">
            <h4>Minggu Ini</h4>
            <p>Rp {{ number_format($totalMingguIni ?? 0, 0, ',', '.') }}</p>
        </div>
        <div class="mini-card">
            <h4>Bulan Ini</h4>
            <p>Rp {{ number_format($totalBulanIni ?? 0, 0, ',', '.') }}</p>
        </div>
        <div class="mini-card">
            <h4>Total Produk Terjual</h4>
            <p>{{ $totalProdukTerjual }}</p>
        </div>
    </div>

    <div class="btn-group-laporan">
        <a href="{{ route('laporan.harian') }}" target="_blank" class="btn-laporan">Cetak Laporan Harian</a>
        <a href="{{ route('laporan.mingguan') }}" target="_blank" class="btn-laporan">Cetak Laporan Mingguan</a>
        <a href="{{ route('laporan.bulanan') }}" target="_blank" class="btn-laporan">Cetak Laporan Bulanan</a>
    </div>

    <div class="chart-container">
        <canvas id="chartPenjualan"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chartPenjualan');
const chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: {!! json_encode($penjualanPerBulan->pluck('bulan') ?? []) !!},
        datasets: [{
            label: 'Penjualan per Bulan',
            data: {!! json_encode($penjualanPerBulan->pluck('total') ?? []) !!},
            borderColor: '#6d4c41',
            backgroundColor: '#d7ccc8',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
@endsection
