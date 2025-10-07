@extends('layouts.app')

@section('content')
<style>
    .container {
        display: flex;
        justify-content: center;
        padding: 30px;
    }
    .form-wrapper {
        width: 100%;
        max-width: 600px;
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .form-wrapper h1 {
        margin-bottom: 20px;
        font-size: 24px;
        color: #333;
        text-align: center;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-group label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        color: #444;
    }
    .form-group input, 
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
        outline: none;
        transition: border-color 0.3s;
        font-size: 14px;
    }
    .form-group input:focus, 
    .form-group textarea:focus {
        border-color: #007bff;
    }
    .preview-img {
        display: block;
        margin-bottom: 10px;
        border-radius: 6px;
    }
    .btn-group {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }
    .btn {
        padding: 10px 18px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        text-align: center;
        cursor: pointer;
        transition: background 0.3s;
    }
    .btn-secondary {
        background: #6c757d;
        color: white;
    }
    .btn-secondary:hover {
        background: #5a6268;
    }
    .btn-success {
        background: #28a745;
        color: white;
        border: none;
    }
    .btn-success:hover {
        background: #218838;
    }
</style>
<div class="container">
    <div class="form-wrapper">
        <h1>Edit Data</h1>
        <form action="{{ route('pelanggan.update', $pelanggan) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="form-group">
                <label>Nama Pelanggan</label>
                <input type="text" name="nama" value="{{ $pelanggan->nama }}" required>
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" rows="4" required>{{ $pelanggan->alamat }}</textarea>
            </div>

            <div class="form-group">
                <label>No Telepon</label>
                <input type="number" name="no_telp" value="{{ $pelanggan->no_telp }}" required>
            </div>

            <div class="btn-group">
                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-success">Edit Data</button>
            </div>
        </form>
    </div>
</div>


@endsection
