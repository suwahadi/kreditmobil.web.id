<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->live(debounce: 500)
                    ->afterStateUpdated(fn (Set $set, $state) => $set('slug', Str::slug((string) $state))),
                TextInput::make('slug')
                    ->unique(ignoreRecord: true)
                    ->afterStateHydrated(function ($state, Set $set, Get $get) {
                        if (blank($state) && filled($get('name'))) {
                            $set('slug', Str::slug((string) $get('name')));
                        }
                    })
                    ->dehydrated()
                    ->required(),
            ]);
    }
}
