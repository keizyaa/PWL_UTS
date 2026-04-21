<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    //
    protected $table = 't_stok';
    protected $primaryKey = 'stok_id';

    protected $fillable = [
        'barang_id',
        'stok_jumlah',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'barang_id');
    }
}
