<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = [
        'tanggal',
        'total'
    ];

    public function detail(){
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id');
    }
}
