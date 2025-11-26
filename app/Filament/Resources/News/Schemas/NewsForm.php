<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Toggle;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Berita')
                    ->required(),
                RichEditor::make('content')
                    ->label('Isi Berita')
                    ->required(),
                FileUpload::make('image')
                    ->label('Gambar Berita')
                    ->image()
                    ->directory('news-images')
                    ->required(false),
                TextInput::make('category')
                    ->label('Kategori')
                    ->required(false),
                TextInput::make('tags')
                    ->label('Tags (pisahkan dengan koma)')
                    ->required(false),
                DateTimePicker::make('published_at')
                    ->label('Tanggal Publish')
                    ->required(false),
                Toggle::make('is_active')
                    ->label('Aktif?')
                    ->inline(false),
            ]);
    }
}
