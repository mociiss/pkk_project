<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\TransaksiDetail;
use App\Models\Transaksi;
use App\Models\Product;
use App\Models\Pelanggan;
use App\Models\Karyawan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index(){
        $transaksi = Transaksi::with('detail.produk')->get();
        return view('transaksi.index', compact('transaksi'));
    }

    public function create(){
        $produk = Product::all();
        $pelanggan = Pelanggan::orderBy('nama')->get();
        $karyawan = Auth::user();
        return view('transaksi.create', compact('produk', 'pelanggan', 'karyawan'));
    }

    public function store(Request $request){
        DB::beginTransaction();
        try{
            $transaksi = Transaksi::create([
                'karyawan_id' => $request->karyawan_id,
                'pelanggan_id' => $request->pelanggan_id,
                'tanggal' => now(),
                'total' => 0
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

                $total += $subtotal;
            }

            $transaksi->update(['total' => $total]);

            DB::commit();
            return redirect()->route('transaksi.index')->with('success', 'Transaksi telah disimpan');
        }
        catch(\Exception $e){
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function cetakStruk($id){
        $transaksi = Transaksi::with('detail.produk')->findOrFail($id);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('transaksi.struk', compact('transaksi'))->setPaper([0,0,226.77,600], 'potrait');

        return $pdf->stream('struk-thermal-'.$transaksi->$id.'.pdf');
    }
}
