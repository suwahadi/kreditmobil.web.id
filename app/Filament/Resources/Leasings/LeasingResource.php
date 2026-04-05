<?php

namespace App\Filament\Resources\Leasings;

use App\Filament\Resources\Leasings\Pages\ListLeasings;
use App\Filament\Resources\Leasings\Schemas\LeasingForm;
use App\Filament\Resources\Leasings\Tables\LeasingsTable;
use App\Models\Leasing;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LeasingResource extends Resource
{
    protected static ?string $model = Leasing::class;

    protected static string|\UnitEnum|null $navigationGroup = 'Management';

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-credit-card';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return LeasingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LeasingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLeasings::route('/'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        $user = auth()->user();
        return $user ? $user->can('viewAny', Leasing::class) : false;
    }
}
