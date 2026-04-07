<?php

namespace App\Filament\Resources\Pages;

use App\Filament\Resources\Pages\Pages\CreatePage;
use App\Filament\Resources\Pages\Pages\EditPage;
use App\Filament\Resources\Pages\Pages\ListPages;
use App\Models\Page;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-document-text';
    protected static \UnitEnum|string|null $navigationGroup = 'Content';
    protected static ?string $slug = 'pages';
    protected static ?int $navigationSort = 3;

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->can('viewAny', Page::class) ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Fieldset::make('Main')
                ->schema([
                    TextInput::make('title')
                        ->required()
                        ->live(debounce: 500)
                        ->afterStateUpdated(fn (Set $set, $state) => $set('slug', Str::slug((string) $state))),
                    TextInput::make('slug')
                        ->unique(ignoreRecord: true)
                        ->afterStateHydrated(function ($state, Set $set, Get $get) {
                            if (blank($state) && filled($get('title'))) {
                                $set('slug', Str::slug((string) $get('title')));
                            }
                        })
                        ->dehydrated()
                        ->required(),
                    Toggle::make('is_active')->label('Active')->default(true),
                ])->columns(2)->columnSpanFull(),

            Fieldset::make('Content')
                ->schema([
                    RichEditor::make('content')->required()->columnSpanFull(),
                ])->columns(1)->columnSpanFull(),

            Fieldset::make('SEO')
                ->schema([
                    KeyValue::make('meta_seo')
                        ->keyLabel('Key')
                        ->valueLabel('Value')
                        ->reorderable(false),
                ])->columns(1)->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Title')->searchable(),
                TextColumn::make('slug')->label('Slug'),
                BooleanColumn::make('is_active')->label('Active')->sortable(),
                TextColumn::make('created_at')->dateTime('d M Y, H:i:s')->sortable(),
                TextColumn::make('updated_at')->dateTime('d M Y, H:i:s'),
            ])
            ->defaultSort('created_at', 'asc')
            ->filters([
                SelectFilter::make('is_active')->options([
                    1 => 'Active',
                    0 => 'Inactive',
                ]),
            ])
            ->actions([
                Action::make('view')
                    ->label('View')
                    ->modalHeading('Detail Page')
                    ->modalSubmitAction(false)
                    ->fillForm(fn ($record) => [
                        'title' => $record->title,
                        'slug' => $record->slug,
                        'content' => $record->content,
                        'is_active' => $record->is_active,
                    ])
                    ->schema([
                        TextInput::make('title')->disabled()->dehydrated(false),
                        TextInput::make('slug')->disabled()->dehydrated(false),
                        RichEditor::make('content')->disabled()->dehydrated(false),
                        Toggle::make('is_active')->label('Active')->disabled()->dehydrated(false),
                    ])
                    ->visible(fn ($record) => ! (auth()->user()?->can('update', $record) ?? false)),
                EditAction::make()
                    ->visible(fn ($record) => auth()->user()?->can('update', $record) ?? false),
                \Filament\Actions\DeleteAction::make()
                    ->visible(fn ($record) => auth()->user()?->can('delete', $record) ?? false),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPages::route('/'),
            'create' => CreatePage::route('/create'),
            'edit' => EditPage::route('/{record}/edit'),
        ];
    }
}
