<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProdukTerjual = DB::table('transaksi_detail as td')
            ->join('transaksi as t', 't.id', '=', 'td.transaksi_id')
            ->where('t.status', '!=', 'Dibatalkan')
            ->sum('td.jumlah');

        $totalPenjualan = DB::table('transaksi_detail as td')
            ->join('transaksi as t', 't.id', '=', 'td.transaksi_id')
            ->where('t.status', '!=', 'Dibatalkan')
            ->sum('td.subtotal');

        $totalHariIni = DB::table('transaksi as t')
            ->join('transaksi_detail as d', 't.id', '=', 'd.transaksi_id')
            ->whereDate('t.created_at', Carbon::today())
            ->where('t.status', '!=', 'Dibatalkan')
            ->sum('d.subtotal');

        $totalMingguIni = DB::table('transaksi as t')
            ->join('transaksi_detail as d', 't.id', '=', 'd.transaksi_id')
            ->whereBetween('t.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->where('t.status', '!=', 'Dibatalkan')
            ->sum('d.subtotal');

        $totalBulanIni = DB::table('transaksi as t')
            ->join('transaksi_detail as d', 't.id', '=', 'd.transaksi_id')
            ->whereMonth('t.created_at', Carbon::now()->month)
            ->where('t.status', '!=', 'Dibatalkan')
            ->sum('d.subtotal');

        $penjualanPerBulan = DB::table('transaksi as t')
            ->join('transaksi_detail as d', 't.id', '=', 'd.transaksi_id')
            ->where('t.status', '!=', 'Dibatalkan')
            ->select(
                DB::raw('MONTH(t.created_at) as bulan'),
                DB::raw('SUM(d.subtotal) as total')
            )
            ->groupBy(DB::raw('MONTH(t.created_at)'))
            ->get();

        return view('dashboard', compact(
            'totalPenjualan',
            'totalHariIni',
            'totalMingguIni',
            'totalBulanIni',
            'penjualanPerBulan',
            'totalProdukTerjual'
        ));
    }
}
