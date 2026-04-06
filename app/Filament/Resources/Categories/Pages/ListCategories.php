<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->createAnother(false)
                ->visible(fn () => auth()->user()?->can('create', \App\Models\Category::class) ?? false)
                ->label('Tambah Data')
                ->modalHeading('Tambah Data')
                ->modalSubmitActionLabel('Tambah Data'),
        ];
    }
}
