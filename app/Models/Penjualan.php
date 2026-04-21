<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    //
    protected $table = 't_penjualan';
    protected $primaryKey = 'penjualan_id';

    protected $fillable = [
        'user_id',
        'pembeli',
        'penjualan_kode',
        'penjualan_tanggal',
        'total_harga',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function detail()
    {
        return $this->hasMany(DetailPenjualan::class, 'penjualan_id');
    }

    protected static function booted()
    {
        static::saved(function ($penjualan) {
            $total = $penjualan->detail->sum(function ($d) {
                return $d->jumlah * $d->harga;
            });

            $penjualan->updateQuietly([
                'total_harga' => $total
            ]);
        });
    }
    
}
