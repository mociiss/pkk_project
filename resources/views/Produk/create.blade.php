@extends('layouts.app')

@section('content')
<style>
    .custom-container {
        background-color: #f8f9fa;
        padding: 30px;
        border-radius: 8px;
        max-width: 600px;
        margin: 30px auto;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .custom-container h1 {
        text-align: center;
        margin-bottom: 25px;
        color: #333;
    }

    .custom-form label {
        font-weight: 600;
        margin-bottom: 6px;
        display: block;
    }

    .custom-form .form-control {
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ced4da;
    }

    .custom-form .btn-success {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        font-weight: bold;
        border-radius: 5px;
        background-color: #28a745;
        border: none;
    }

    .custom-form .btn-success:hover {
        background-color: #218838;
    }
</style>

<div class="custom-container">
    <h1>Tambah Produk</h1>
    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="custom-form">
        @csrf
        <div>
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" required>
        </div>
        <div>
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>
        <div>
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <div>
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
