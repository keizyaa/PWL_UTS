<?php

namespace App\Filament\Resources\DetailPenjualans\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class DetailPenjualanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                Select::make('penjualan_id')
                    ->relationship('penjualan', 'penjualan_kode')
                    ->required(),

                Select::make('barang_id')
                    ->relationship('barang', 'barang_nama')
                    ->required(),

                TextInput::make('jumlah')
                    ->numeric()
                    ->required(),

                TextInput::make('harga')
                    ->numeric()
                    ->required(),
            ]);
    }
}
