<?php

namespace App\Filament\Resources\Customers;

use App\Filament\Resources\Customers\Pages\EditCustomer;
use App\Filament\Resources\Customers\Pages\ListCustomers;
use App\Filament\Resources\Customers\Pages\ViewCustomer;
use App\Models\Customer;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Fieldset;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static \UnitEnum|string|null $navigationGroup = 'Leads';

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-identification';

    protected static ?int $navigationSort = 2;

    public static function shouldRegisterNavigation(): bool
    {
        $user = auth()->user();
        return $user ? $user->can('viewAny', Customer::class) : false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Fieldset::make('Customer Details')
                ->schema([
                    TextInput::make('name')->label('Name')->required(),
                    Select::make('gender')->label('Gender')->options(['L' => 'Laki-laki', 'P' => 'Perempuan'])->required(),
                ])->columns(2),

            Fieldset::make('Identification')
                ->schema([
                    TextInput::make('nik')
                        ->label('NIK')
                        ->length(16)
                        ->unique(ignoreRecord: true)
                        ->required(),
                    Select::make('lead_id')
                        ->label('Lead')
                        ->relationship('lead', 'lead_code')
                        ->searchable()
                        ->nullable()
                        ->disabled()
                        ->dehydrated(false),
                ])->columns(2),

            Fieldset::make('Contact')
                ->schema([
                    TextInput::make('phone')->label('Phone')->tel()->required(),
                    TextInput::make('email')->label('Email')->email()->nullable(),
                ])->columns(2),

            Fieldset::make('Address')
                ->schema([
                    Textarea::make('address')->label('Address')->rows(3)->nullable()->columnSpanFull(),
                    TextInput::make('city')->label('City')->required(),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lead.lead_code')->label('Lead Code')->searchable(),
                TextColumn::make('name')->label('Name')->searchable(),
                TextColumn::make('nik')->label('NIK')->searchable(),
                TextColumn::make('gender')
                    ->label('Gender')
                    ->badge()
                    ->formatStateUsing(fn ($state) => in_array(strtoupper((string) $state), ['L','P'], true) ? strtoupper((string) $state) : '-')
                    ->color(function ($state): string {
                        return match (strtoupper((string) $state)) {
                            'L' => 'info',
                            'P' => 'danger',
                            default => 'gray',
                        };
                    }),
                TextColumn::make('phone')->label('Phone'),
                TextColumn::make('city')->label('City')->searchable(),
                TextColumn::make('created_at')->dateTime('d M Y, H:i:s')->sortable(),
                TextColumn::make('updated_at')->dateTime('d M Y, H:i:s')->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('gender')->options(['L' => 'Laki-laki', 'P' => 'Perempuan']),
                SelectFilter::make('city')->options(fn () => Customer::query()->orderBy('city')->pluck('city', 'city')->toArray()),
            ])
            ->actions([
                \Filament\Actions\Action::make('view')
                    ->label('View')
                    ->modalHeading('Detail Customer')
                    ->modalSubmitAction(false)
                    ->fillForm(fn ($record) => [
                        'lead_id' => $record->lead_id,
                        'nik' => $record->nik,
                        'name' => $record->name,
                        'gender' => $record->gender,
                        'phone' => $record->phone,
                        'email' => $record->email,
                        'address' => $record->address,
                        'city' => $record->city,
                    ])
                    ->schema([
                        Select::make('lead_id')->label('Lead')->relationship('lead','lead_code')->disabled()->dehydrated(false),
                        TextInput::make('nik')->label('NIK')->disabled()->dehydrated(false),
                        TextInput::make('name')->label('Name')->disabled()->dehydrated(false),
                        TextInput::make('gender')->label('Gender')->disabled()->dehydrated(false),
                        TextInput::make('phone')->label('Phone')->disabled()->dehydrated(false),
                        TextInput::make('email')->label('Email')->disabled()->dehydrated(false),
                        Textarea::make('address')->label('Address')->rows(3)->disabled()->dehydrated(false),
                        TextInput::make('city')->label('City')->disabled()->dehydrated(false),
                    ])
                    ->visible(fn ($record) => ! (auth()->user()?->can('update', $record) ?? false)),
                \Filament\Actions\EditAction::make()
                    ->visible(fn ($record) => auth()->user()?->can('update', $record) ?? false),
                \Filament\Actions\DeleteAction::make()
                    ->visible(fn ($record) => auth()->user()?->can('delete', $record) ?? false),
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCustomers::route('/'),
            'view' => ViewCustomer::route('/{record}'),
            'edit' => EditCustomer::route('/{record}/edit'),
        ];
    }
}
