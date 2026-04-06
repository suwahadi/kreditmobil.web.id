<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->tel(),
                Select::make('role')
                    ->options(function () {
                        $options = [
                            'admin' => 'Admin',
                            'manager' => 'Manager',
                            'sales' => 'Sales',
                        ];
                        if (auth()->user()?->role === 'manager') {
                            unset($options['admin']);
                        }
                        return $options;
                    })
                    ->default('sales')
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->dehydrated(fn ($state) => filled($state))
                    ->nullable(),
                Toggle::make('is_active')
                    ->default(true)
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
