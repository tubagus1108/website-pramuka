<?php

namespace App\Filament\Resources\SubmittedNews\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SubmittedNewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Pengirim')
                    ->disabled()
                    ->columnSpan(1),
                TextInput::make('email')
                    ->label('Email')
                    ->disabled()
                    ->columnSpan(1),
                TextInput::make('phone')
                    ->label('No. HP')
                    ->disabled()
                    ->columnSpan(1),
                Placeholder::make('created_at')
                    ->label('Dikirim Pada')
                    ->content(fn ($record) => $record?->created_at?->format('d M Y, H:i'))
                    ->columnSpan(1),
                TextInput::make('title')
                    ->label('Judul Berita')
                    ->disabled()
                    ->columnSpanFull(),
                Textarea::make('content')
                    ->label('Isi Berita')
                    ->disabled()
                    ->rows(8)
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->label('Gambar')
                    ->image()
                    ->disk('public')
                    ->directory('submitted-news')
                    ->visibility('public')
                    ->disabled()
                    ->columnSpanFull(),
                Select::make('status')
                    ->label('Status Moderasi')
                    ->options([
                        'pending' => 'Pending Review',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                    ])
                    ->required()
                    ->default('pending')
                    ->columnSpan(1),
                Textarea::make('admin_notes')
                    ->label('Catatan Admin')
                    ->rows(3)
                    ->placeholder('Tuliskan alasan atau catatan untuk keputusan moderasi')
                    ->columnSpan(1),
            ]);
    }
}
