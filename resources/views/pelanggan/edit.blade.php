@extends('layouts.app')

@section('content')
<style>
  body {
      background-color: #fff8f1;
      font-family: "Karla", sans-serif;
  }

  .custom-container {
    background-color: #fffdfa;
    padding: 35px;
    border-radius: 20px;
    max-width: 650px;
    margin: 40px auto;
    box-shadow: 0 6px 20px rgba(139, 90, 43, 0.15);
    border: 1px solid #f0e4d7;
    }

  .custom-container h1 {
      text-align: center;
      margin-bottom: 25px;
      color: #6b3e18;
      font-family: "Pacifico", cursive;
      font-size: 36px;
      letter-spacing: 1px;
  }

  .custom-form label {
      font-weight: 600;
      color: #5c3c1d;
      margin-bottom: 8px;
      display: block;
  }

  .custom-form .form-control {
      border-radius: 10px;
      padding: 10px 15px;
      margin-bottom: 18px;
      border: 1.5px solid #d5bfa3;
      width: 100%;
      background-color: #fffaf4;
      transition: all 0.3s ease;
  }

  .custom-form .form-control:focus {
      border-color: #c27a3f;
      box-shadow: 0 0 6px rgba(194, 122, 63, 0.3);
      outline: none;
  }

  .container-button {
      display: flex;
      justify-content: space-between;
      gap: 10px;
      margin-top: 20px;
  }

  .container-button .btn-success,
  .container-button a {
      flex: 1;
      text-align: center;
      padding: 12px;
      border-radius: 10px;
      font-size: 16px;
      font-weight: 600;
      text-decoration: none;
      border: none;
      font-family: "Karla", sans-serif;
      transition: all 0.3s ease;
  }

  .container-button .btn-success {
      background-color: #b46a2b;
      color: #fffdfa;
  }

  .container-button .btn-success:hover {
      background-color: #d47f3d;
      transform: translateY(-2px);
  }

  .container-button a {
      background-color: #e5c8a8;
      color: #5a3a1b;
  }

  .container-button a:hover {
      background-color: #f1d3b0;
      transform: translateY(-2px);
  }

    .custom-container {
    animation: fadeIn 0.6s ease;
    }

    @keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
    }
</style>
<div class="custom-container">
    <h1>Edit Data</h1>
    <form action="{{ route('pelanggan.update', $pelanggan) }}" method="POST" enctype="multipart/form-data" class="custom-form">
        @csrf @method('PUT')
        <div>
            <label>Nama Lengkap</label>
            <input type="text" name="nama" value="{{ $pelanggan->nama }}" class="form-control" required>
        </div>
        <div>    
            <label>Alamat</label>
            <textarea name="alamat" rows="4" class="form-control" required>{{ $pelanggan->alamat }}</textarea>
        </div>
        <div>
            <label>No Telepon</label>
            <input type="number" name="no_telp" value="{{ $pelanggan->no_telp }}" class="form-control">
        </div>
        <div class="container-button">
            <button type="submit" class="btn btn-success">🍪 Simpan</button>
            <a href="{{ route('karyawan.index') }}">Kembali</a>
        </div>
    </form>
</div>
@endsection