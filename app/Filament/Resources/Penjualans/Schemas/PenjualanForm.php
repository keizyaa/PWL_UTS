<?php

namespace App\Filament\Resources\Penjualans\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;

class PenjualanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),

                TextInput::make('pembeli')->required(),
                TextInput::make('penjualan_kode')->required(),

                DateTimePicker::make('penjualan_tanggal')
                    ->required(),
            ]);
    }
}
