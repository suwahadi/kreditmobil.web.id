<?php

namespace App\Filament\Resources\CarTypes\Pages;

use App\Filament\Resources\CarTypes\CarTypeResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions;

class CreateCarType extends CreateRecord
{
    protected static string $resource = CarTypeResource::class;

    public function getTitle(): string
    {
        return 'Tambah Data';
    }

    protected function getFormActions(): array
    {
        return [
            Actions\Action::make('create')
                ->label(__('filament-panels::resources/pages/create-record.form.actions.create.label'))
                ->submit('create'),
            Actions\Action::make('cancel')
                ->label(__('filament-panels::resources/pages/create-record.form.actions.cancel.label'))
                ->color('gray')
                ->outlined()
                ->url(static::getResource()::getUrl()),
        ];
    }
}
