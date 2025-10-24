@extends('layouts.app')

@section('title', 'Notifikasi Transaksi')

@section('content')
<style>
    body {
        background-color: white;
        font-family: 'Poppins', sans-serif;
    }

    .notif-container {
        background: #8C623B;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        max-width: 850px;
        margin: 40px auto;
    }

    .notif-header {
        font-weight: bolder;
        font-size: 20px;
        color: white;
        border-bottom: 2px solid #ffffffff;
        padding-bottom: 10px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .notif-header img {
        width: 28px;
        height: 28px;
    }

    .list-group-item {
        border: none;
        border-bottom: 1px solid #eee;
        transition: all 0.2s ease;
        padding: 15px 12px;
        margin: 5px;
        border-radius: 8px;
    }

    .list-group-item:last-child {
        border-bottom: none;
    }

    .list-group-item.bg-light {
        background-color: white !important;
    }

    .list-group-item:hover {
        transform: translateY(-2px);
    }

    .fw-bold {
        font-weight: 600 !important;
        color: #222;
    }

    .text-muted.small {
        font-size: 13px;
        color: #888;
    }

    .btn-confirm{
        display: flex;
    }

    .btn {
        font-size: 13px;
        border-radius: 6px;
        padding: 6px 10px;
        font-family: 'Poppins', sans-serif;
        color: white;
        margin: 5px 5px 5px 0px;
    }

    .btn-primary {
        background-color: #0d6efd;
        border: none;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
    }

    .btn-danger:hover {
        background-color: #bb2d3b;
    }

    .no-notif {
        text-align: center;
        background: #fff8e1;
        padding: 25px;
        border-radius: 10px;
        color: #8b6b00;
        font-weight: 500;
    }
</style>

<div class="notif-container">
    <div class="notif-header">
        <img src="{{ asset('images/Notification_48px.png') }}" alt="Notif Icon">
        <h4 class="m-0">Notifikasi Transaksi</h4>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($notification->isEmpty())
        <div class="no-notif">
            Belum ada notifikasi untuk saat ini.
        </div>
    @else
        <div class="list-group">
            @foreach($notification as $notif)
                <div class="list-group-item d-flex justify-content-between align-items-start {{ $notif->is_read ? '' : 'bg-light' }}">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">{{ $notif->title }}</div>
                        {{ $notif->message }}
                        <div class="text-muted small">{{ $notif->created_at->diffForHumans() }}</div>
                    </div>
                    <div class="btn-confirm">
                        @if(!$notif->is_read)
                            <form action="{{ route('notifikasi.read', $notif->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-sm btn-primary">Pesanan Selesai</button>
                            </form>
                        @endif
                        <form action="{{ route('notifikasi.destroy', $notif->id) }}" method="POST" onsubmit="return confirm('Batalkan pesanan ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Batalkan Pesanan</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
