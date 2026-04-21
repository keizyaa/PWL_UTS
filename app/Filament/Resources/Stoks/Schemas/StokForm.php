<?php

namespace App\Filament\Resources\Stoks\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class StokForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            Select::make('barang_id')
                ->relationship('barang', 'barang_nama')
                ->required(),

            TextInput::make('stok_jumlah')
                ->numeric()
                ->required(),
            ]);
    }
}
