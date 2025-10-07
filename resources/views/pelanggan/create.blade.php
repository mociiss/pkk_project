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
    <h1>Tambah Data Pelanggan</h1>
    <form action="{{ route('pelanggan.store') }}" method="POST" enctype="multipart/form-data" class="custom-form">
        @csrf
        <div>
            <label>Nama Pelanggan</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div>
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required></textarea>
        </div>
        <div>
            <label>No Telepon</label>
            <input type="number" name="no_telp" class="form-control">
        </div>
        <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
