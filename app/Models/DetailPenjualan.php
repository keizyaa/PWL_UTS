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
        // saat create
        static::created(function ($detail) {
            $detail->updateStok(-$detail->jumlah);
            $detail->updateTotalPenjualan();
        });

        // sebelum update
        static::updating(function ($detail) {
            $oldJumlah = $detail->getOriginal('jumlah');
            $newJumlah = $detail->jumlah;

            $selisih = $oldJumlah - $newJumlah;

            $detail->updateStok($selisih);
        });

        // setelah update
        static::updated(function ($detail) {
            $detail->updateTotalPenjualan();
        });

        // saat delete
        static::deleted(function ($detail) {
            $detail->updateStok($detail->jumlah);
            $detail->updateTotalPenjualan();
        });
    }

    // 🔹 UPDATE STOK
    public function updateStok($jumlah)
    {
        $stok = Stok::where('barang_id', $this->barang_id)->first();

        if (!$stok) {
            throw new \Exception('Data stok tidak ditemukan!');
        }

        $stokBaru = $stok->stok_jumlah + $jumlah;

        if ($stokBaru < 0) {
            throw new \Exception('Stok tidak mencukupi!');
        }

        $stok->update([
            'stok_jumlah' => $stokBaru
        ]);
    }

    // update penjualan
    public function updateTotalPenjualan()
    {
        $penjualan = $this->penjualan;

        if ($penjualan) {
            $total = $penjualan->detail()
                ->selectRaw('SUM(jumlah * harga) as total')
                ->value('total') ?? 0;

            $penjualan->updateQuietly([
                'total_harga' => $total
            ]);
        }
    }
}