<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = [
        'karyawan_id',
        'pelanggan_id',
        'tanggal',
        'tanggal_pengiriman',
        'waktu_pengiriman',
        'total',
        'status',
        'metode_pembayaran',
        'jumlah_pembayaran',
        'kembalian',
        'status_pembayaran'
    ];

    public function detail(){
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id');
    }

    public function karyawan(){
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }
}
