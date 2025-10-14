<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $table = 'kategori';

    protected $fillable = [
        'nama_kategori',
        'keterangan'
    ];

    public function produk(){
        return $this->hasMany(Product::class, 'kategori_id');
    }
}
