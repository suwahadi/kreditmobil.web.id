<?php

namespace App\Filament\Resources\CarTypes\Pages;

use App\Filament\Resources\CarTypes\CarTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCarTypes extends ListRecords
{
    protected static string $resource = CarTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->createAnother(false)
                ->visible(fn () => auth()->user()?->can('create', \App\Models\CarType::class) ?? false),
        ];
    }
}
