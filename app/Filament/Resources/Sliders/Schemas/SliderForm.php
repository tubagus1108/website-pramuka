<?php

namespace App\Filament\Resources\Sliders\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SliderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(3)
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->label('Gambar Slider')
                    ->image()
                    ->required()
                    ->disk('public')
                    ->directory('sliders')
                    ->visibility('public')
                    ->imageEditor()
                    ->maxSize(2048)
                    ->helperText('Ukuran maksimal 2MB. Rasio yang disarankan 16:9 atau 21:9')
                    ->columnSpanFull(),
                TextInput::make('link')
                    ->label('Link/URL')
                    ->url()
                    ->placeholder('https://example.com')
                    ->maxLength(255),
                TextInput::make('order')
                    ->label('Urutan')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->helperText('Angka lebih kecil akan ditampilkan lebih dulu'),
                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->inline(false)
                    ->helperText('Slider yang aktif akan ditampilkan di halaman utama'),
            ]);
    }
}
