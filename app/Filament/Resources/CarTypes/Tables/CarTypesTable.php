<?php

namespace App\Filament\Resources\CarTypes\Tables;

use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class CarTypesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('carModel.name')->label('Model')->searchable(),
                TextColumn::make('transmission')->badge(),
                TextColumn::make('price_otr')->label('Harga OTR')->money('IDR', locale: 'id')->sortable(),
                IconColumn::make('is_active')->boolean(),
                TextColumn::make('created_at')->dateTime('d M Y, H:i:s')->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->groups([
                Group::make('carModel.name')
                    ->label('Model')
                    ->collapsible(false),
            ])
            ->defaultGroup('carModel.name')
            ->groupingSettingsHidden()
            ->filters([
                SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([1 => 'Aktif', 0 => 'Nonaktif'])
                    ->query(function ($query, $state) {
                        if ($state === null || $state === '') return $query;
                        return $query->where('is_active', (bool) $state);
                    }),
            ])
            ->recordActions([
                Action::make('view')
                    ->label('View')
                    ->modalHeading('Detail Type')
                    ->modalSubmitAction(false)
                    ->fillForm(fn ($record) => [
                        'car_model_id' => $record->car_model_id,
                        'name' => $record->name,
                        'slug' => $record->slug,
                        'transmission' => $record->transmission,
                        'price_otr' => $record->price_otr,
                        'is_active' => (bool) $record->is_active,
                    ])
                    ->schema([
                        Select::make('car_model_id')->label('Model')->relationship('carModel','name')->disabled()->dehydrated(false),
                        TextInput::make('name')->disabled()->dehydrated(false),
                        TextInput::make('slug')->disabled()->dehydrated(false),
                        TextInput::make('transmission')->disabled()->dehydrated(false),
                        TextInput::make('price_otr')->disabled()->dehydrated(false),
                        Toggle::make('is_active')->disabled()->dehydrated(false),
                    ])
                    ->visible(fn ($record) => ! (auth()->user()?->can('update', $record) ?? false)),
                EditAction::make()
                    ->visible(fn ($record) => auth()->user()?->can('update', $record) ?? false),
                \Filament\Actions\DeleteAction::make()
                    ->visible(fn ($record) => auth()->user()?->can('delete', $record) ?? false),
            ]);
    }
}
