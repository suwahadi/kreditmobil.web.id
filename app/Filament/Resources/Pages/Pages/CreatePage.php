<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Filament\Resources\Pages\PageResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;

    public function getTitle(): string
    {
        return 'Tambah Data';
    }

    protected function getFormActions(): array
    {
        return [
            Actions\Action::make('create')
                ->label('Tambah Data')
                ->submit('create'),
            Actions\Action::make('cancel')
                ->label(__('filament-panels::resources/pages/create-record.form.actions.cancel.label'))
                ->color('gray')
                ->outlined()
                ->url(static::getResource()::getUrl()),
        ];
    }
}
