<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawan';

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'alamat',
        'no_telp'
    ];

    public function transaksi(){
        return $this->hasMany(Transaksi::class, 'karyawan_id');
    }

    public function user(){
        return $this->belongsTo(user::class);
    }
}
    
