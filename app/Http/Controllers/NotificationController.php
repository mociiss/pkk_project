<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;
use App\Models\Transaksi;

class NotificationController extends Controller
{
    public function index()
    {
        $notification = Notification::where('is_read', false)->orderBy('created_at', 'desc')->get();
        return view('notifikasi.index', compact('notification'));
    }

    public function markAsRead(Request $request,$id){
        $notif = Notification::findOrFail($id);
        $notif->update(['is_read' => true]);

        if($notif->transaksi_id){
            $transaksi = Transaksi::find($notif->transaksi_id);
            if($transaksi){
                $transaksi->update(['status' => 'Selesai']);
            }
        }

        return redirect()->route('notifikasi.index')->with('success', 'Pesanan telah diselesaikan.');
    }

    public function destroy($id){
        $notif = Notification::findOrFail($id);

        if($notif->transaksi_id){
            $transaksi = Transaksi::find($notif->transaksi_id);
            if($transaksi){
                $transaksi->update(['status' => 'Dibatalkan']);

                DB::table('transaksi_detail')
                ->where('transaksi_id', $transaksi->id)
                ->update(['subtotal' => 0]);
            }
        }
        $notif->delete();

        return redirect()->route('notifikasi.index')->with('success', 'Pesanan dibatalkan.');
    }
}
