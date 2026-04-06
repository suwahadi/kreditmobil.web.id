<?php

namespace App\Filament\Resources\CarTypes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CarTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make('Main')
                    ->schema([
                        Select::make('car_model_id')
                            ->relationship('carModel', 'name')
                            ->label('Model')
                            ->required(),
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
                        Select::make('transmission')
                            ->options([
                                'MT' => 'Manual',
                                'AT' => 'Otomatis',
                                'CVT' => 'CVT',
                            ])
                            ->required(),
                        TextInput::make('price_otr')
                            ->label('Harga OTR')
                            ->numeric()
                            ->required(),
                        Toggle::make('is_active')
                            ->default(true)
                            ->required(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Fieldset::make('Specifications')
                    ->statePath('specifications')
                    ->schema([
                        Fieldset::make('Engine')
                            ->schema([
                                TextInput::make('engine.type')->label('Type'),
                                TextInput::make('engine.power')->label('Power (hp)')->numeric(),
                                TextInput::make('engine.torque')->label('Torque (Nm)')->numeric(),
                                TextInput::make('engine.capacity')->label('Capacity (cc)')->numeric(),
                            ]),
                        Fieldset::make('Dimensions')
                            ->schema([
                                TextInput::make('dimensions.length')->label('Length (mm)')->numeric(),
                                TextInput::make('dimensions.width')->label('Width (mm)')->numeric(),
                                TextInput::make('dimensions.height')->label('Height (mm)')->numeric(),
                                TextInput::make('dimensions.wheelbase')->label('Wheelbase (mm)')->numeric(),
                                TextInput::make('dimensions.ground_clearance')->label('Ground Clearance (mm)')->numeric(),
                            ]),
                        Fieldset::make('Capacity')
                            ->schema([
                                TextInput::make('capacity.seats')->label('Seats')->numeric(),
                                TextInput::make('capacity.fuel_tank')->label('Fuel Tank (L)')->numeric(),
                            ]),
                        Fieldset::make('Features')
                            ->schema([
                                Toggle::make('features.abs')->label('ABS'),
                                Toggle::make('features.airbags')->label('Airbags'),
                                Toggle::make('features.esp')->label('ESP'),
                                Toggle::make('features.hsa')->label('Hill Start Assist'),
                            ]),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
