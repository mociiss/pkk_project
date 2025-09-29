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
        <h1>Edit Produk</h1>
        <form action="{{ route('produk.update', $produk) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            {{-- Nama Produk --}}
            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" value="{{ $produk->nama_produk }}" required>
            </div>

            {{-- Gambar --}}
            <div class="form-group">
                <label>Gambar Produk</label><br>
                @if ($produk->gambar)
                    <img src="{{ asset('storage/'.$produk->gambar) }}" width="120" class="preview-img"><br>
                @endif
                <input type="file" name="gambar">
            </div>

            {{-- Harga --}}
            <div class="form-group">
                <label>Harga (Rp)</label>
                <input type="number" name="harga" value="{{ $produk->harga }}" required>
            </div>

            {{-- Deskripsi --}}
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" rows="4" required>{{ $produk->deskripsi }}</textarea>
            </div>

            {{-- Tombol --}}
            <div class="btn-group">
                <a href="{{ route('produk.index') }}" class="btn btn-secondary">⬅️ Kembali</a>
                <button type="submit" class="btn btn-success">💾 Update Produk</button>
            </div>
        </form>
    </div>
</div>


@endsection
