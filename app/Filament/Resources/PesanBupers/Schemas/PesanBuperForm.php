<?php

namespace App\Filament\Resources\PesanBupers\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PesanBuperForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Pesan')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('excerpt')
                    ->label('Ringkasan')
                    ->rows(3)
                    ->helperText('Ringkasan singkat untuk preview')
                    ->columnSpanFull(),
                RichEditor::make('content')
                    ->label('Isi Pesan')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('author')
                    ->label('Nama Penulis')
                    ->default('Ketua Umum')
                    ->required()
                    ->columnSpan(1),
                TextInput::make('author_title')
                    ->label('Jabatan')
                    ->placeholder('Ketua Umum Kwarcab DIY')
                    ->columnSpan(1),
                FileUpload::make('author_photo')
                    ->label('Foto Penulis')
                    ->image()
                    ->disk('public')
                    ->directory('authors')
                    ->visibility('public')
                    ->imageEditor()
                    ->maxSize(1024)
                    ->columnSpan(1),
                DatePicker::make('published_at')
                    ->label('Tanggal Publish')
                    ->default(now())
                    ->columnSpan(1),
                Toggle::make('is_active')
                    ->label('Aktif?')
                    ->default(true)
                    ->inline(false)
                    ->columnSpan(1),
                Toggle::make('is_featured')
                    ->label('Tampilkan di Beranda?')
                    ->default(false)
                    ->inline(false)
                    ->helperText('Pesan akan ditampilkan di halaman utama')
                    ->columnSpan(1),
            ]);
    }
}
