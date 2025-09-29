<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = 'produk';
    protected $fillable = [
        'nama_produk',
        'gambar',
        'harga',
        'deskripsi'
    ];
}
