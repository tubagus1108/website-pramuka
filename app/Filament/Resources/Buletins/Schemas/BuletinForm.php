<?php

namespace App\Filament\Resources\Buletins\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BuletinForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Buletin')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state)))
                    ->columnSpanFull(),
                TextInput::make('slug')
                    ->label('Slug (URL)')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->helperText('Otomatis diisi dari judul')
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(3)
                    ->columnSpanFull(),
                FileUpload::make('cover_image')
                    ->label('Gambar Cover')
                    ->image()
                    ->disk('public')
                    ->directory('buletins/covers')
                    ->visibility('public')
                    ->imageEditor()
                    ->maxSize(2048)
                    ->columnSpan(1),
                FileUpload::make('file_pdf')
                    ->label('File PDF')
                    ->acceptedFileTypes(['application/pdf'])
                    ->disk('public')
                    ->directory('buletins/files')
                    ->visibility('public')
                    ->maxSize(10240)
                    ->columnSpan(1),
                TextInput::make('edition')
                    ->label('Edisi')
                    ->placeholder('Edisi 01')
                    ->columnSpan(1),
                Select::make('month')
                    ->label('Bulan')
                    ->options([
                        1 => 'Januari',
                        2 => 'Februari',
                        3 => 'Maret',
                        4 => 'April',
                        5 => 'Mei',
                        6 => 'Juni',
                        7 => 'Juli',
                        8 => 'Agustus',
                        9 => 'September',
                        10 => 'Oktober',
                        11 => 'November',
                        12 => 'Desember',
                    ])
                    ->required()
                    ->columnSpan(1),
                TextInput::make('year')
                    ->label('Tahun')
                    ->numeric()
                    ->default(date('Y'))
                    ->required()
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
            ]);
    }
}
