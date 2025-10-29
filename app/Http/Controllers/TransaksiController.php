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
        $query = Transaksi::with(['karyawan', 'pelanggan', 'detail.produk']);

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $transaksi = $query->orderBy('tanggal', 'desc')->get();

        if ($request->ajax()) {
            return view('transaksi.table', compact('transaksi'))->render();
        }

        return view('transaksi.index', compact('transaksi'));
    }

    public function create(){
        $produk = Product::all();
        $pelanggan = Pelanggan::orderBy('nama')->get();
        $karyawan = Auth::user();
        return view('transaksi.create', compact('produk', 'pelanggan', 'karyawan'));
    }


    public function store(Request $request){
        $request->validate([
            'metode_pembayaran' => 'required'   
        ]);

        $karyawan = Karyawan::where('user_id', Auth::id())->first();

        if(!$karyawan){
            return back()->with('error', 'Data karyawan tidak ditemukan untuk pengguna ini.');
        }

        $transaksi = Transaksi::create([
            'karyawan_id' => $karyawan->id,
            'pelanggan_id' => $request->pelanggan_id,
            'tanggal' => now(),
            'tanggal_pengiriman' => $request->tanggal_pengiriman,
            'waktu_pengiriman' => $request->waktu_pengiriman,
            'total' => 0,
            'status' => 'Belum Selesai',
            'metode_pembayaran' => $request->metode_pembayaran,
            'jumlah_bayar' => $request->jumlah_bayar ?? 0,
            'status_pembayaran' => $request->metode_pembayaran === 'Cash' ? 'Belum Dibayar' : 'Menunggu Konfirmasi',
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
            'title' => 'Pesanan ' . ($pelanggan->nama ?? 'Tanpa Nama'),
            'message' => "• Total: Rp " . number_format($total, 0, ',', '.') .
                    "\n• Pembayaran: " . $request->metode_pembayaran .
                    ($request->metode_pembayaran == 'E-Wallet' ? ' (Scan saat antar)' : '') .
                    "\n• Pengantaran: " .
                    \Carbon\Carbon::parse($request->tanggal_pengiriman)->translatedFormat('d F Y') .
                    ', pukul ' . ($request->waktu_pengiriman ?? '-')
    ]);

    $kembalian = 0;
    if ($request->metode_pembayaran === 'Cash') {
        $bayar = $request->jumlah_bayar ?? 0;
        $kembalian = max($bayar - $total, 0);
    }

    $transaksi->update([
        'total' => $total,
        'kembalian' => $kembalian,
    ]);


        return redirect()->route('transaksi.index')->with('Success', 'Data Transaksi Berhasil Dikirim!');
    }

    public function konfirmasi($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update(['status_pembayaran' => 'Lunas']);

        return back()->with('success', 'Pembayaran E-Wallet telah dikonfirmasi.');
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
