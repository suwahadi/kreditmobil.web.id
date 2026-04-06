<?php

namespace App\Filament\Resources\News;

use App\Filament\Resources\News\Pages\CreateNews;
use App\Filament\Resources\News\Pages\EditNews;
use App\Filament\Resources\News\Pages\ListNews;
use App\Models\News;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-newspaper';
    protected static \UnitEnum|string|null $navigationGroup = 'Content';
    protected static ?string $slug = 'news';
    protected static ?int $navigationSort = 1;

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->can('viewAny', News::class) ?? false;
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

            Fieldset::make('Media')
                ->schema([
                    FileUpload::make('thumbnail')
                        ->label('Thumbnail')
                        ->image()
                        ->directory('news')
                        ->disk('public')
                        ->openable()
                        ->acceptedFileTypes(['image/jpeg','image/png','image/webp'])
                        ->saveUploadedFileUsing(function (TemporaryUploadedFile $file, $record): string {
                            $contents = file_get_contents($file->getRealPath());
                            if ($contents === false) {
                                throw new \RuntimeException('Failed to read uploaded image.');
                            }
                            $image = @imagecreatefromstring($contents);
                            if (! $image) {
                                throw new \RuntimeException('Unsupported image format.');
                            }
                            imagepalettetotruecolor($image);
                            imagealphablending($image, true);
                            imagesavealpha($image, true);
                            $filename = Str::uuid()->toString() . '.webp';
                            $path = 'news/' . $filename;
                            $full = Storage::disk('public')->path($path);
                            if (! is_dir(dirname($full))) {
                                mkdir(dirname($full), 0775, true);
                            }
                            if (! imagewebp($image, $full, 80)) {
                                imagedestroy($image);
                                throw new \RuntimeException('Failed to encode image as WebP.');
                            }
                            imagedestroy($image);
                            return $path;
                        })
                        ->dehydrated(true),
                ])->columns(1)->columnSpanFull(),

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
                ImageColumn::make('thumbnail')->label('Thumb')->disk('public')->square()->size(40),
                TextColumn::make('title')->label('Title')->searchable(),
                TextColumn::make('author.name')->label('Author')->toggleable(),
                BooleanColumn::make('is_active')->label('Active')->sortable(),
                TextColumn::make('created_at')->dateTime('d M Y, H:i:s')->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('is_active')->options([
                    1 => 'Active',
                    0 => 'Inactive',
                ]),
            ])
            ->actions([
                Action::make('view')
                    ->label('View')
                    ->modalHeading('Detail News')
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
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListNews::route('/'),
            'create' => CreateNews::route('/create'),
            'edit' => EditNews::route('/{record}/edit'),
        ];
    }
}
