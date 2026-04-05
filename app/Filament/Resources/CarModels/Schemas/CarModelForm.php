<?php

namespace App\Filament\Resources\CarModels\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CarModelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug((string) $state))),
                TextInput::make('slug')
                    ->unique(ignoreRecord: true)
                    ->required(),
                Toggle::make('is_active')
                    ->default(true)
                    ->required(),
                RichEditor::make('description')
                    ->nullable()
                    ->columnSpanFull(),
                FileUpload::make('main_image')
                    ->label('Main image')
                    ->image()
                    ->directory('cars/models')
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
                        $path = 'cars/models/' . $filename;
                        $full = Storage::disk('public')->path($path);
                        if (! is_dir(dirname($full))) {
                            mkdir(dirname($full), 0775, true);
                        }
                        // Compress quality 80
                        if (! imagewebp($image, $full, 80)) {
                            imagedestroy($image);
                            throw new \RuntimeException('Failed to encode image as WebP.');
                        }
                        imagedestroy($image);
                        return $path;
                    })
                    ->dehydrated(true)
                    ->required(fn (string $context) => $context === 'create')->columnSpanFull(),
            ]);
    }
}
