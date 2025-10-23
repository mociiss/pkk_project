<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::with(['detail.produk', 'pelanggan'])->orderBy('created_at', 'desc')->take(20)->get();
        return view('notifikasi.index', compact('transaksiBaru'));
    }
}
