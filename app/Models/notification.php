<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    protected $fillable = [
    'transaksi_id',
    'title',
    'message',
    'is_read'
    ];

    protected $table = 'notification';

    public function transaksi(){
        return $this->belongsTo(Transaksi::class);
    }
}
