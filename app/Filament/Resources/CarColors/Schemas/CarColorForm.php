<?php

namespace App\Filament\Resources\CarColors\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CarColorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('car_model_id')
                    ->relationship('carModel', 'name')
                    ->label('Model')
                    ->searchable()
                    ->required(),
                TextInput::make('color_name')
                    ->label('Color name')
                    ->required(),
                ColorPicker::make('hex_code')
                    ->label('Hex')
                    ->required(),
                FileUpload::make('image_path')
                    ->label('Image')
                    ->image()
                    ->directory('cars/colors')
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
                        $path = 'cars/colors/' . $filename;
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
                    ->dehydrated(true)
                    ->nullable(),
            ]);
    }
}
