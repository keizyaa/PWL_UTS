<?php

namespace App\Filament\Resources\Stoks\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;

class StokForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            Select::make('supplier_id')
                ->relationship('supplier', 'supplier_nama')
                ->required(),

            Select::make('barang_id')
                ->relationship('barang', 'barang_nama')
                ->required(),

            Select::make('user_id')
                ->relationship('user', 'name')
                ->required(),

            DateTimePicker::make('stok_tanggal')
                ->required(),

            TextInput::make('stok_jumlah')
                ->numeric()
                ->required(),
                
            ]);
    }
}
