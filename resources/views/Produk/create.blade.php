@extends('layouts.app')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,500;1,500&family=Licorice&family=Rowdies:wght@300;400;700&display=swap" rel="stylesheet">

<style>
    
    .custom-container {
        background-color: #f8f9fa;
        padding: 30px;
        border-radius: 8px;
        max-width: 600px;
        margin: 30px auto;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        font-family: "Karla", sans-serif;
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
        width: -webkit-fill-available;
    }

    .container-button .btn-success {
        width: 50%;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        background-color: #885621ff;
        font-family: "Karla", sans-serif;
        border: none;
        color: white;
    }

    .container-button .btn-success:hover {
        background-color: #885621ff;
    }

    .container-button{
        display: flex;
        justify-content: space-between;
    }

    .container-button a{
        display: block;
        width: 50%;
        color: white;
        padding: 10px;
        text-align: center;
        font-family: "Karla", sans-serif;
        border-radius: 5px;
        font-size: 16px;
        text-decoration: none;
        margin-bottom: 10px;
        background: #885621ff;
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
        <div>
            <label for="">Stok</label>
            <input type="number" name="stok" class="form-control" required>
        </div>
        <div>
            <label for="">Kategori</label>
            <select name="kategori_id" id="" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $k)
                <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        <div class="container-button">
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('produk.index') }}">Kembali</a>
        </div>
    </form>
</div>
@endsection
