<?php

namespace App\Filament\Resources\CarTypes\Pages;

use App\Filament\Resources\CarTypes\CarTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCarType extends CreateRecord
{
    protected static string $resource = CarTypeResource::class;

    public function hasCreateAnother(): bool
    {
        return false;
    }
}
