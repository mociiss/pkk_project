<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notification = Notification::orderBy('created_at', 'desc')->get();
        return view('notifikasi.index', compact('notification'));
    }

    public function markAsRead($id){
        $notif = Notification::findOrFail($id);
        $notif->delete();

        return redirect()->route('notifikasi.index')->with('success', 'Pesanan telah dibuat.');
    }

    public function destroy($id){
        $notif = Notification::findOrFail($id);
        $notif->delete();

        return redirect()->route('notifikasi.index')->with('success', 'Pesanan dibatalkan.');
    }
}
