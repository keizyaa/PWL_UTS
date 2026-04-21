<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'm_barang';
    protected $primaryKey = 'barang_id';

    protected $fillable = [
        'kategori_id',
        'supplier_id',
        'barang_kode',
        'barang_nama',
        'harga_beli',
        'harga_jual',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'supplier_id');
    }
}