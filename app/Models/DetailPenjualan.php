<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Stok;

class DetailPenjualan extends Model
{
    protected $table = 't_penjualan_detail';
    protected $primaryKey = 'detail_id';

    protected $fillable = [
        'penjualan_id',
        'barang_id',
        'jumlah',
        'harga',
    ];

    // 🔹 RELASI
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    // 🔹 EVENT
    protected static function booted()
    {
        // buat detail 
        static::created(function ($detail) {
            $detail->updateStok(-$detail->jumlah);
            $detail->updateTotalPenjualan();
        });

        // update detail
        static::updating(function ($detail) {
            $oldJumlah = $detail->getOriginal('jumlah');
            $newJumlah = $detail->jumlah;

            $selisih = $oldJumlah - $newJumlah;

            $detail->updateStok($selisih);
        });

        // hasil setelah di update
        static::updated(function ($detail) {
            $detail->updateTotalPenjualan();
        });

        // saat dihapus
        static::deleted(function ($detail) {
            $detail->updateStok($detail->jumlah);
            $detail->updateTotalPenjualan();
        });
    }

    // function update stok  
    public function updateStok($jumlah)
    {
        $stok = Stok::where('barang_id', $this->barang_id)->first();

        if ($stok) {
            $stok->stok_jumlah += $jumlah;
            $stok->save();
        }
    }

    // function update total
    public function updateTotalPenjualan()
    {
        $penjualan = $this->penjualan;

        if ($penjualan) {
            $total = $penjualan->detail->sum(function ($d) {
                return $d->jumlah * $d->harga;
            });

            $penjualan->updateQuietly([
                'total_harga' => $total
            ]);
        }
    }
}