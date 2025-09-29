@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f6f9;
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
        background: #007bff;
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
</style>

<div class="container">
    <h1>Daftar Produk</h1>
    <a href="{{ route('produk.create') }}" class="btn-add">+ Tambah Produk</a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Gambar</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($produk as $index => $p)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $p->nama_produk }}</td>
                <td>
                    @if ($p->gambar)
                    <img src="{{ asset('images/' . $p->gambar) }}" alt="Gambar Barang" width="50">
                    @endif
                </td>
                <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                <td>{{ $p->deskripsi }}</td>
                <td>
                    <a href="{{ route('produk.edit', $p) }}" class="btn-edit">Edit</a>
                    <form action="{{ route('produk.destroy', $p) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-delete" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
