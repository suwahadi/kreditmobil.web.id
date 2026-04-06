<?php

namespace App\Filament\Resources\Leasings\Pages;

use App\Filament\Resources\Leasings\LeasingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLeasings extends ListRecords
{
    protected static string $resource = LeasingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->createAnother(false)
                ->visible(fn () => auth()->user()?->can('create', \App\Models\Leasing::class) ?? false)
                ->label('Tambah Data')
                ->modalHeading('Tambah Data')
                ->modalSubmitActionLabel('Tambah Data'),
        ];
    }
}
