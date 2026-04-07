<?php

namespace App\Filament\Resources\CarModels\Tables;

use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class CarModelsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('main_image')
                    ->label('Image')
                    ->formatStateUsing(function ($state) {
                        if (!$state) {
                            return '<img src="https://placehold.net/80x80/e5e7eb/9ca3af?text=No+Image" alt="No Image" class="rounded-lg shadow-sm" style="width: 100px; object-fit: cover; display: block;" loading="lazy">';
                        }
                        return sprintf(
                            '<img src="%s" alt="Model Image" class="rounded-lg shadow-sm" style="width: 100px; object-fit: cover; display: block;" loading="lazy">',
                            asset('storage/' . $state)
                        );
                    })
                    ->html(),
                TextColumn::make('category.name')->label('Category')->searchable(),
                IconColumn::make('is_active')->boolean(),
                TextColumn::make('created_at')->dateTime('d M Y, H:i:s')->sortable(),
            ])
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
                    ->modalHeading('Detail Model')
                    ->modalSubmitAction(false)
                    ->fillForm(fn ($record) => [
                        'category_id' => $record->category_id,
                        'name' => $record->name,
                        'slug' => $record->slug,
                        'is_active' => (bool) $record->is_active,
                    ])
                    ->schema([
                        Select::make('category_id')->label('Category')->relationship('category','name')->disabled()->dehydrated(false),
                        TextInput::make('name')->disabled()->dehydrated(false),
                        TextInput::make('slug')->disabled()->dehydrated(false),
                        Toggle::make('is_active')->disabled()->dehydrated(false),
                    ])
                    ->visible(fn ($record) => ! (auth()->user()?->can('update', $record) ?? false)),
                EditAction::make()
                    ->visible(fn ($record) => auth()->user()?->can('update', $record) ?? false),
                \Filament\Actions\DeleteAction::make()
                    ->visible(fn ($record) => auth()->user()?->can('delete', $record) ?? false),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
