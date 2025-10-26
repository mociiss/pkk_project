<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\TransaksiDetail;
use App\Models\Transaksi;
use App\Models\Product;
use App\Models\Pelanggan;
use App\Models\Karyawan;
use App\Models\User;
use App\Models\Notification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index(Request $request){
        $status = $request->get('status'); 

    if ($status) {
        $transaksi = Transaksi::with(['detail.produk','karyawan','pelanggan'])
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->get();
    } else {
        $transaksi = Transaksi::with(['detail.produk','karyawan','pelanggan'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    return view('transaksi.index', compact('transaksi', 'status'));
    }

    public function create(){
        $produk = Product::all();
        $pelanggan = Pelanggan::orderBy('nama')->get();
        $karyawan = Auth::user();
        return view('transaksi.create', compact('produk', 'pelanggan', 'karyawan'));
    }


    public function store(Request $request){
        $transaksi = Transaksi::create([
            'karyawan_id' => $request->karyawan_id,
            'pelanggan_id' => $request->pelanggan_id,
            'tanggal' => now(),
            'tanggal_pengiriman' => $request->tanggal_pengiriman,
            'waktu_pengiriman' => $request->waktu_pengiriman,
            'total' => 0,
            'status' => 'Belum Selesai'
        ]);

        $total = 0;
        foreach($request->produk_id as $key => $id){
            $produk = Product::findOrFail($id);
            $jumlah = $request->jumlah[$key];
            $harga = $produk->harga;
            $subtotal = $harga * $jumlah;

            TransaksiDetail::create([
                'transaksi_id' => $transaksi->id,
                'produk_id' => $id,
                'jumlah' => $jumlah,
                'harga' => $harga,
                'subtotal' => $subtotal
            ]);

            $produk->decrement('stok', $jumlah);
            $total += $subtotal;

        }

        $transaksi->update(['total' => $total]);

        $pelanggan = Pelanggan::find($request->pelanggan_id);
        $produkItem = TransaksiDetail::where('transaksi_id', $transaksi->id)
        ->with('produk')->get()->map(function ($item){
            return $item->produk->nama_produk . ' (x' . $item->jumlah . ')';
        })
        ->implode(', ');

        Notification::create([
            'transaksi_id' => $transaksi->id,
            'title' => 'Pesanan ' . ($pelanggan->nama ?? 'Pelanggan tidak ada dalam data.'),
            'message' => "• " . $produkItem . 
            "\n• Total: Rp " . number_format($total, 0, ',', '.') . 
            "\n• Pengantaran: " . 
            \Carbon\Carbon::parse($request->tanggal_pengiriman)->translatedFormat('d F Y') . 
            ', pukul ' . ($request->waktu_pengiriman ?? '-')

        ]);

        return redirect()->route('transaksi.index')->with('Success', 'Data Transaksi Berhasil Dikirim!');
    }

    public function selesai($id)
{
    $transaksi = Transaksi::findOrFail($id);
    $transaksi->update(['status' => 'Selesai']);

    // Hapus notifikasi terkait transaksi ini
    Notification::where('transaksi_id', $id)->delete();

    return redirect()->route('transaksi.index')->with('success', 'Pesanan telah diselesaikan dan notifikasi dihapus.');
}


    public function cetakStruk($id){
        $transaksi = Transaksi::with('detail.produk')->findOrFail($id);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('transaksi.struk', compact('transaksi'))->setPaper([0,0,226.77,600], 'potrait');

        return $pdf->stream('struk-thermal-'.$transaksi->id.'.pdf');
    }
}
