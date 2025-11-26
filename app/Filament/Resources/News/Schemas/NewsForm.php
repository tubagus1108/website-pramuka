<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Illuminate\Support\Str;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Berita')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state)))
                    ->columnSpanFull(),
                TextInput::make('slug')
                    ->label('Slug (URL)')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->helperText('Otomatis diisi dari judul, bisa diedit manual')
                    ->columnSpanFull(),
                Textarea::make('excerpt')
                    ->label('Ringkasan')
                    ->rows(3)
                    ->helperText('Ringkasan singkat berita untuk preview')
                    ->columnSpanFull(),
                RichEditor::make('content')
                    ->label('Isi Berita')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->label('Gambar Berita')
                    ->image()
                    ->disk('public')
                    ->directory('news')
                    ->visibility('public')
                    ->imageEditor()
                    ->maxSize(2048),
                Select::make('category')
                    ->label('Kategori')
                    ->options([
                        'BERITA' => 'Berita',
                        'ARTIKEL' => 'Artikel',
                        'PENGUMUMAN' => 'Pengumuman',
                        'KEGIATAN' => 'Kegiatan',
                    ])
                    ->default('BERITA'),
                TextInput::make('tags')
                    ->label('Tags (pisahkan dengan koma)')
                    ->placeholder('pramuka, kegiatan, penggalang')
                    ->helperText('Contoh: pramuka, kegiatan, DIY'),
                TextInput::make('author')
                    ->label('Penulis')
                    ->default('Admin Pramuka DIY'),
                DateTimePicker::make('published_at')
                    ->label('Tanggal Publish')
                    ->default(now()),
                Toggle::make('is_active')
                    ->label('Aktif?')
                    ->default(true)
                    ->inline(false),
            ]);
    }
}
