<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function laporanHarian()
    {
        $today = Carbon::today();
        $transaksi = Transaksi::whereDate('tanggal', $today)->get();
        $totalSemua = $transaksi->sum('total');

        // Ringkasan per status
        $ringkasan = $transaksi->groupBy('status')->map(function ($item) {
            return [
                'jumlah' => $item->count(),
                'total' => $item->sum('total'),
            ];
        });

        $pdf = Pdf::loadView('laporan.template', [
            'judul' => 'Laporan Penjualan Harian - ' . $today->translatedFormat('d F Y'),
            'transaksi' => $transaksi,
            'totalSemua' => $totalSemua,
            'ringkasan' => $ringkasan,
        ]);
        return $pdf->stream('laporan-harian.pdf');
    }

    public function laporanMingguan()
    {
        $start = Carbon::now()->startOfWeek();
        $end = Carbon::now()->endOfWeek();
        $transaksi = Transaksi::whereBetween('tanggal', [$start, $end])->get();
        $totalSemua = $transaksi->sum('total');

        $ringkasan = $transaksi->groupBy('status')->map(function ($item) {
            return [
                'jumlah' => $item->count(),
                'total' => $item->sum('total'),
            ];
        });

        $pdf = Pdf::loadView('laporan.template', [
            'judul' => 'Laporan Penjualan Mingguan (' . $start->format('d M') . ' - ' . $end->format('d M Y') . ')',
            'transaksi' => $transaksi,
            'totalSemua' => $totalSemua,
            'ringkasan' => $ringkasan,
        ]);
        return $pdf->stream('laporan-mingguan.pdf');
    }

    public function laporanBulanan()
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        $transaksi = Transaksi::whereMonth('tanggal', $month)->whereYear('tanggal', $year)->get();
        $totalSemua = $transaksi->sum('total');

        $ringkasan = $transaksi->groupBy('status')->map(function ($item) {
            return [
                'jumlah' => $item->count(),
                'total' => $item->sum('total'),
            ];
        });

        $pdf = Pdf::loadView('laporan.template', [
            'judul' => 'Laporan Penjualan Bulanan - ' . Carbon::now()->translatedFormat('F Y'),
            'transaksi' => $transaksi,
            'totalSemua' => $totalSemua,
            'ringkasan' => $ringkasan,
        ]);
        return $pdf->stream('laporan-bulanan.pdf');
    }
}
