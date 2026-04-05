<?php

namespace App\Filament\Resources\Leasings\Pages;

use App\Filament\Resources\Leasings\LeasingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLeasing extends EditRecord
{
    protected static string $resource = LeasingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
