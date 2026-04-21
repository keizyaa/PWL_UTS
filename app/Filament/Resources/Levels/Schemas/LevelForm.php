<?php

namespace App\Filament\Resources\Levels\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;

class LevelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                    Forms\Components\TextInput::make('level_kode')
                        ->required()
                        ->maxLength(10),

                    Forms\Components\TextInput::make('level_nama')
                        ->required()
                        ->maxLength(100),

            ]);
    }
}
