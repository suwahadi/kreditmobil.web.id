<?php

namespace App\Filament\Resources\Leads;

use App\Filament\Resources\Leads\Pages\EditLead;
use App\Filament\Resources\Leads\Pages\ListLeads;
use App\Filament\Resources\Leads\Pages\ViewLead;
use App\Filament\Resources\Leads\Widgets\LeadsStatsOverview;
use App\Models\Lead;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Placeholder;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Fieldset;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-user-group';
    protected static \UnitEnum|string|null $navigationGroup = 'Leads';
    protected static ?string $slug = 'leads';
    protected static ?int $navigationSort = 1;

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->can('viewAny', Lead::class) ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        $user = auth()->user();
        $isSales = ($user?->role === 'sales');
        return $schema
            ->components([
                Fieldset::make('Lead Details')
                    ->schema([
                        TextInput::make('lead_code')->label('Lead Code')->disabled(),
                        Select::make('car_type_id')->label('Car Type')->relationship('carType', 'name')->searchable()->required(),
                        TextInput::make('customer_name')->label('Customer Name')->required(),
                        TextInput::make('phone')->label('Phone')->tel()->required(),
                        TextInput::make('source')->label('Source'),
                        TextInput::make('channel')->label('Channel'),
                        Select::make('status')->label('Status')->options([
                            Lead::STATUS_NEW => 'New',
                            Lead::STATUS_ASSIGNED => 'Assigned',
                            Lead::STATUS_FOLLOW_UP => 'Follow Up',
                            Lead::STATUS_NEGOTIATION => 'Negotiation',
                            Lead::STATUS_WON => 'Won',
                            Lead::STATUS_LOST => 'Lost',
                        ])->required(),
                        Select::make('sales_id')
                            ->label('Sales')
                            ->relationship('sales', 'name')
                            ->searchable()
                            ->disabled($isSales)
                            ->default($isSales ? ($user?->id) : null),
                    ])
                    ->columns(2),
                Fieldset::make('Notes')
                    ->schema([
                        Textarea::make('notes')->label('Notes')->rows(4)->columnSpanFull(),
                        Placeholder::make('submitted_at')
                            ->label('Submitted At')
                            ->content(fn ($record) => optional($record?->submitted_at)?->format('d M Y, H:i:s') ?? '-')
                            ->hiddenOn('edit'),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lead_code')->label('Code')->searchable(),
                TextColumn::make('customer_name')->label('Customer')->searchable(),
                TextColumn::make('masked_phone')->label('Phone'),
                TextColumn::make('carType.name')->label('Type')->searchable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => str_replace('_', ' ', (string) $state))
                    ->color(function (string $state): string {
                        return match ($state) {
                            \App\Models\Lead::STATUS_NEW => 'gray',
                            \App\Models\Lead::STATUS_ASSIGNED => 'info',
                            \App\Models\Lead::STATUS_FOLLOW_UP => 'warning',
                            \App\Models\Lead::STATUS_NEGOTIATION => 'secondary',
                            \App\Models\Lead::STATUS_WON => 'success',
                            \App\Models\Lead::STATUS_LOST => 'danger',
                            default => 'gray',
                        };
                    }),
                TextColumn::make('sales.name')->label('Sales')->toggleable(),
                TextColumn::make('submitted_at')->dateTime('d M Y, H:i:s')->sortable(),
                TextColumn::make('created_at')->dateTime('d M Y, H:i:s')->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')->options([
                    Lead::STATUS_NEW => 'New',
                    Lead::STATUS_ASSIGNED => 'Assigned',
                    Lead::STATUS_FOLLOW_UP => 'Follow Up',
                    Lead::STATUS_NEGOTIATION => 'Negotiation',
                    Lead::STATUS_WON => 'Won',
                    Lead::STATUS_LOST => 'Lost',
                ]),
                SelectFilter::make('sales_id')->label('Sales')
                    ->relationship('sales', 'name')->searchable(),
            ])
            ->actions([
                Action::make('view')
                    ->label('View')
                    ->modalHeading('Detail Lead')
                    ->modalSubmitAction(false)
                    ->fillForm(fn ($record) => [
                        'car_type_id' => $record->car_type_id,
                        'customer_name' => $record->customer_name,
                        'phone' => $record->phone,
                        'status' => $record->status,
                        'sales_id' => $record->sales_id,
                        'notes' => $record->notes,
                    ])
                    ->schema([
                        Select::make('car_type_id')->label('Car Type')->relationship('carType','name')->disabled()->dehydrated(false),
                        TextInput::make('customer_name')->label('Customer')->disabled()->dehydrated(false),
                        TextInput::make('phone')->label('Phone')->disabled()->dehydrated(false),
                        TextInput::make('status')->label('Status')->disabled()->dehydrated(false),
                        Select::make('sales_id')->label('Sales')->relationship('sales','name')->disabled()->dehydrated(false),
                        Textarea::make('notes')->label('Notes')->rows(4)->disabled()->dehydrated(false),
                    ])
                    ->visible(fn ($record) => ! (auth()->user()?->can('update', $record) ?? false)),
                EditAction::make()
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
            'index' => ListLeads::route('/'),
            'view' => ViewLead::route('/{record}'),
            'edit' => EditLead::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            LeadsStatsOverview::class,
        ];
    }
}
