<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaksidetail extends Model
{
    protected $table = 'transaksi_detail';

    protected $fillable = [
        'transaksi_id',
        'produk_id',
        'jumlah',
        'harga',
        'subtotal'
    ];

    public function produk(){
        return $this->belongsTo(Product::class, 'produk_id');
    }
}
