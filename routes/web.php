<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function (){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
});

Route::middleware(['auth', 'role:Admin'])->group(function (){
    Route::resource('produk', ProductController::class);
    Route::resource('karyawan', KaryawanController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::get('/transaksi/{id}/cetak', [TransaksiController::class, 'cetakStruk'])->name('transaksi.cetak');
    Route::post('/transaksi/{id}/selesai', [TransaksiController::class, 'selesai'])->name('transaksi.selesai');
    Route::post('/transaksi/{id}/konfirmasi', [TransaksiController::class, 'konfirmasi'])->name('transaksi.konfirmasi');
    Route::get('/notifikasi', [NotificationController::class, 'index'])->name('notifikasi.index');
    Route::post('/notifikasi/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifikasi.markAsRead');
    Route::delete('/notifikasi/{id}', [NotificationController::class, 'destroy'])->name('notifikasi.destroy');
});

Route::middleware(['auth', 'role:Kasir'])->group(function (){
    Route::resource('produk', ProductController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/{id}/cetak', [TransaksiController::class, 'cetakStruk'])->name('transaksi.cetak');
    Route::post('/transaksi/{id}/selesai', [TransaksiController::class, 'selesai'])->name('transaksi.selesai');
});

Route::middleware(['auth', 'role:Koki'])->group(function (){
    Route::get('/notifikasi', [NotificationController::class, 'index'])->name('notifikasi.index');
    Route::post('/notifikasi/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifikasi.markAsRead');
    Route::delete('/notifikasi/{id}', [NotificationController::class, 'destroy'])->name('notifikasi.destroy');
    Route::resource('produk', ProductController::class);
    Route::resource('transaksi', TransaksiController::class);
});

Route::middleware(['auth', 'role:Owner'])->group(function (){
    Route::resource('produk', ProductController::class);
    Route::resource('karyawan', KaryawanController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::get('/transaksi/{id}/cetak', [TransaksiController::class, 'cetakStruk'])->name('transaksi.cetak');
    Route::post('/transaksi/{id}/selesai', [TransaksiController::class, 'selesai'])->name('transaksi.selesai');
    Route::get('/notifikasi', [NotificationController::class, 'index'])->name('notifikasi.index');
    Route::post('/notifikasi/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifikasi.markAsRead');
    Route::delete('/notifikasi/{id}', [NotificationController::class, 'destroy'])->name('notifikasi.destroy');
    Route::get('/laporan/penjualan', [App\Http\Controllers\LaporanController::class, 'penjualan'])->name('laporan.penjualan');   
    Route::get('/laporan/harian', [LaporanController::class, 'laporanHarian'])->name('laporan.harian');
    Route::get('/laporan/mingguan', [LaporanController::class, 'laporanMingguan'])->name('laporan.mingguan');
    Route::get('/laporan/bulanan', [LaporanController::class, 'laporanBulanan'])->name('laporan.bulanan');
});

Route::middleware(['auth', 'role:Kurir'])->group(function (){
    Route::get('/notifikasi', [NotificationController::class, 'index'])->name('notifikasi.index');
    Route::post('/notifikasi/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifikasi.markAsRead');
    Route::delete('/notifikasi/{id}', [NotificationController::class, 'destroy'])->name('notifikasi.destroy');
});

