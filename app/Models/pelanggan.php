<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pelanggan extends Model
{
    protected $table = 'pelanggan';

    protected $fillable = [
        'nama',
        'alamat',
        'no_telp'
    ];

    public function transaksi(){
        return $this->hasMany(Transaksi::class, 'pelanggan_id');
    }
}
