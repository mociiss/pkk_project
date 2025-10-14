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
        $totalUsers = User::count();
        $recentUsers = User::latest()->take(5)->get();
        // Total semua penjualan

        $totalProdukTerjual = DB::table('transaksi_detail')->sum('jumlah');

        $totalPenjualan = DB::table('transaksi_detail')->sum('subtotal');

        // Total hari ini
        $totalHariIni = DB::table('transaksi as t')
            ->join('transaksi_detail as d', 't.id', '=', 'd.transaksi_id')
            ->whereDate('t.created_at', Carbon::today())
            ->sum('d.subtotal');

        // Total minggu ini
        $totalMingguIni = DB::table('transaksi as t')
            ->join('transaksi_detail as d', 't.id', '=', 'd.transaksi_id')
            ->whereBetween('t.created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum('d.subtotal');

        // Total bulan ini
        $totalBulanIni = DB::table('transaksi as t')
            ->join('transaksi_detail as d', 't.id', '=', 'd.transaksi_id')
            ->whereMonth('t.created_at', Carbon::now()->month)
            ->sum('d.subtotal');

        // Data untuk grafik (misalnya penjualan per bulan)
        $penjualanPerBulan = DB::table('transaksi as t')
            ->join('transaksi_detail as d', 't.id', '=', 'd.transaksi_id')
            ->select(DB::raw('MONTH(t.created_at) as bulan'), DB::raw('SUM(d.subtotal) as total'))
            ->groupBy(DB::raw('MONTH(t.created_at)'))
            ->get();

        return view('dashboard', compact(
        'totalUsers',
        'recentUsers',
        'totalPenjualan',
        'totalHariIni',
        'totalMingguIni',
        'totalBulanIni',
        'penjualanPerBulan',
        'totalProdukTerjual'));
}
}