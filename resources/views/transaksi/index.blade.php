@extends('layouts.app')

@section('title', 'CatatYuk - Data Transaksi')

@section('content')
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #fff7f2;
        margin: 0;
        padding: 0;
    }
    .container {
        padding: 20px;
    }
    h1 {
        margin-bottom: 20px;
        color: #333;
    }
    .btn-add {
        background: #28a745;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 6px;
        text-decoration: none;
        font-size: 14px;
        transition: background 0.3s;
    }
    .btn-add:hover {
        background: #218838;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    table thead {
        background: #8C623B;
        color: #fff;
    }
    table th, table td {
        padding: 12px 15px;
        text-align: left;
    }
    table tbody tr:nth-child(even) {
        background: #f9f9f9;
    }
    img {
        border-radius: 6px;
    }
    .btn-edit {
        background: #ffc107;
        color: #000;
        padding: 6px 10px;
        border: none;
        border-radius: 4px;
        font-size: 12px;
        text-decoration: none;
        cursor: pointer;
    }
    .btn-edit:hover {
        background: #e0a800;
    }
    .btn-delete {
        background: #dc3545;
        color: #fff;
        padding: 6px 10px;
        border: none;
        border-radius: 4px;
        font-size: 12px;
        cursor: pointer;
    }
    .btn-delete:hover {
        background: #c82333;
    }
    .btn-primary {
        background-color: #8C623B;
        border: none;
    }
    .btn-primary:hover {
        background-color: #A27E59;
    }
    .form-select {
        border-radius: 8px;
    }
    .table {
        border-radius: 10px;
        overflow: hidden;
    }
    .filter-card {
        background: #fff;
        border-radius: 12px;
        padding: 16px 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 25px;
        transition: 0.3s;
        border-left: 6px solid #8C623B;
    }

    .filter-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .filter-header h5 {
        margin: 0;
        font-size: 16px;
        color: #8C623B;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .filter-body {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-select {
        width: 250px;
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 8px 12px;
        font-size: 18px;
        transition: 0.3s;
    }

    .filter-select:focus {
        border-color: #8C623B;
        box-shadow: 0 0 5px rgba(140,98,59,0.3);
    }
</style>

<div class="container">
    <h1>Data Transaksi</h1>

    <a href="{{ route('transaksi.create') }}" class="btn-add">+ Tambah Data Transaksi</a>

    <div class="filter-card">
        <div class="filter-header">
        <h5>Status Transaksi</h5>
        <select id="status" class="form-select filter-select">
            <option value="">Semua</option>
            <option value="Selesai">Selesai</option>
            <option value="Belum selesai">Belum Selesai</option>
            <option value="Dibatalkan">Dibatalkan</option>
        </select>
</div>
    </div>

    <div id="table-container">
        @include('transaksi.table', ['transaksi' => $transaksi])
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusFilter = document.getElementById('status');
    const tableContainer = document.getElementById('table-container');

    statusFilter.addEventListener('change', function() {
        const status = this.value;
        fetch(`{{ route('transaksi.index') }}?status=${status}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.text())
        .then(html => {
            tableContainer.innerHTML = html;
        })
        .catch(error => console.error('Error:', error));
    });
});
</script>
@endsection
