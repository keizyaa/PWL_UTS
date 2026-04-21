<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('level_id')
                    ->relationship('level', 'level_nama')
                    ->required(),

                TextInput::make('username')
                    ->required(),
                    
                TextInput::make('nama')
                    ->required(),

                TextInput::make('password')
                    ->password()
                    ->required(),
            ]);
    }
}
