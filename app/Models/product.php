<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogActivity;
use Spatie\Activitylog\LogOptions;

class product extends Model
{
    protected $table = 'produk';
    protected $fillable = [
        'nama_produk',
        'gambar',
        'harga',
        'deskripsi',
        'stok',
        'kategori_id'
    ];

    public function kategori(){
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function getActivitylogOptions(): LogOptions{
        return LogOptions::defaults()
        ->useLogName('produk')
        ->logOnly([
            'nama_produk',
            'gambar',
            'harga',
            'deskripsi',
            'stok',
            'kategori_id'
        ])
        ->logOnlyDirty()
        ->dontSubmitEmptyLogs();
    }
}
