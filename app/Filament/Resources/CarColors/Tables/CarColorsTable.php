<?php

namespace App\Filament\Resources\CarColors\Tables;

use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Grouping\Group;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class CarColorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('carModel.name')->label('Model')->searchable(),
                TextColumn::make('color_name')->label('Color')->searchable(),
                TextColumn::make('hex_code')
                    ->label('Preview')
                    ->formatStateUsing(function ($state) {
                        $raw = trim((string) ($state ?? ''));
                        if ($raw === '') return '';
                        if (! str_starts_with(strtolower($raw), 'rgb') && ! str_starts_with(strtolower($raw), 'hsl')) {
                            $raw = ltrim($raw, '#');
                            if (in_array(strlen($raw), [3, 6], true)) {
                                $raw = '#' . $raw;
                            }
                        }
                        $color = e($raw);
                        return '<span style="display:inline-block;width:18px;height:18px;border-radius:50%;background:' . $color . ';border:1px solid #cccccc;"></span>';
                    })
                    ->html()
                    ->sortable(false),
                // TextColumn::make('image_path')
                //     ->label('Image')
                //     ->formatStateUsing(fn ($state) => $state ? '<img src="' . asset('storage/' . $state) . '" class="rounded" style="max-width: 100px; height: auto; object-fit: cover;" />' : '')
                //     ->html(),
                TextColumn::make('created_at')->dateTime('d M Y, H:i:s')->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->dateTime('d M Y, H:i:s')->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->groups([
                Group::make('carModel.name')
                    ->label('Model')
                    ->collapsible(false),
            ])
            ->defaultGroup('carModel.name')
            ->groupingSettingsHidden()
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('view')
                    ->label('View')
                    ->modalHeading('Detail Color')
                    ->modalSubmitAction(false)
                    ->fillForm(fn ($record) => [
                        'car_model_id' => $record->car_model_id,
                        'color_name' => $record->color_name,
                        'hex_code' => $record->hex_code,
                        'image_path' => $record->image_path,
                    ])
                    ->schema([
                        Select::make('car_model_id')->label('Model')->relationship('carModel','name')->disabled()->dehydrated(false),
                        TextInput::make('color_name')->label('Color')->disabled()->dehydrated(false),
                        ColorPicker::make('hex_code')->label('Hex')->disabled()->dehydrated(false),
                        TextInput::make('image_path')->label('Image path')->disabled()->dehydrated(false),
                    ])
                    ->visible(fn ($record) => ! (auth()->user()?->can('update', $record) ?? false)),
                EditAction::make()
                    ->visible(fn ($record) => auth()->user()?->can('update', $record) ?? false),
                \Filament\Actions\DeleteAction::make()
                    ->visible(fn ($record) => auth()->user()?->can('delete', $record) ?? false),
            ]);
    }
}
