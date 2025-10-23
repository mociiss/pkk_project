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
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }
    table th, table td {
        border-bottom: 1px solid #d7ccc8;
        padding: 8px;
        text-align: left;
    }
    table th {
        color: #6d4c41;
        font-size: 14px;
    }
    table td {
        color: #3e2723;
        font-size: 14px;
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

        <div class="chart-container">
            <canvas id="chartPenjualan"></canvas>
        </div>
    </div>


{{-- Chart.js --}}
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
