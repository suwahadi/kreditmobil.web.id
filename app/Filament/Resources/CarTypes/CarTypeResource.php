<?php

namespace App\Filament\Resources\CarTypes;

use App\Filament\Resources\CarTypes\Pages\CreateCarType;
use App\Filament\Resources\CarTypes\Pages\EditCarType;
use App\Filament\Resources\CarTypes\Pages\ListCarTypes;
use App\Filament\Resources\CarTypes\Schemas\CarTypeForm;
use App\Filament\Resources\CarTypes\Tables\CarTypesTable;
use App\Models\CarType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CarTypeResource extends Resource
{
    protected static ?string $model = CarType::class;

    protected static string|\UnitEnum|null $navigationGroup = 'Car';

    protected static ?string $navigationLabel = 'Type';

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return CarTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CarTypesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCarTypes::route('/'),
            'create' => CreateCarType::route('/create'),
            'edit' => EditCarType::route('/{record}/edit'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        $user = auth()->user();
        return $user ? $user->can('viewAny', CarType::class) : false;
    }
}
