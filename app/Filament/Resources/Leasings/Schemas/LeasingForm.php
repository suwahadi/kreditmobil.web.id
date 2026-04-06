<?php

namespace App\Filament\Resources\Leasings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LeasingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
