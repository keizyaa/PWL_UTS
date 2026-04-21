<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    //
    protected $table = 't_stok';
    protected $primaryKey = 'stok_id';

    protected $fillable = [
    'supplier_id',
    'barang_id',
    'user_id',
    'stok_tanggal',
    'stok_jumlah',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
