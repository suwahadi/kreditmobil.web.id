<?php

namespace App\Filament\Resources\CarColors;

use App\Filament\Resources\CarColors\Pages\ListCarColors;
use App\Filament\Resources\CarColors\Schemas\CarColorForm;
use App\Filament\Resources\CarColors\Tables\CarColorsTable;
use App\Models\CarColor;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CarColorResource extends Resource
{
    protected static ?string $model = CarColor::class;

    protected static string|\UnitEnum|null $navigationGroup = 'Car';

    protected static ?string $navigationLabel = 'Color';

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-swatch';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return CarColorForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CarColorsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCarColors::route('/'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        $user = auth()->user();
        return $user ? $user->can('viewAny', CarColor::class) : false;
    }
}
