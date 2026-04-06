<?php

namespace App\Filament\Resources\CarColors\Pages;

use App\Filament\Resources\CarColors\CarColorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCarColors extends ListRecords
{
    protected static string $resource = CarColorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->createAnother(false)
                ->visible(fn () => auth()->user()?->can('create', \App\Models\CarColor::class) ?? false)
                ->label('Tambah Data')
                ->modalHeading('Tambah Data')
                ->modalSubmitActionLabel('Tambah Data'),
        ];
    }
}
