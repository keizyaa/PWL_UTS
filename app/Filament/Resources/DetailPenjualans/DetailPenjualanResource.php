<?php

namespace App\Filament\Resources\DetailPenjualans;

use App\Filament\Resources\DetailPenjualans\Pages\CreateDetailPenjualan;
use App\Filament\Resources\DetailPenjualans\Pages\EditDetailPenjualan;
use App\Filament\Resources\DetailPenjualans\Pages\ListDetailPenjualans;
use App\Filament\Resources\DetailPenjualans\Schemas\DetailPenjualanForm;
use App\Filament\Resources\DetailPenjualans\Tables\DetailPenjualansTable;
use App\Models\DetailPenjualan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DetailPenjualanResource extends Resource
{
    protected static ?string $model = DetailPenjualan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'detail_id';

    public static function form(Schema $schema): Schema
    {
        return DetailPenjualanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DetailPenjualansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDetailPenjualans::route('/'),
            'create' => CreateDetailPenjualan::route('/create'),
            'edit' => EditDetailPenjualan::route('/{record}/edit'),
        ];
    }
}
