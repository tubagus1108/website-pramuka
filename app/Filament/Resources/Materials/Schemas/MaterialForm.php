<?php

namespace App\Filament\Resources\Materials\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class MaterialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Materi')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $state, callable $set) => $set('slug', Str::slug($state)))
                    ->columnSpanFull(),
                
                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->helperText('URL-friendly versi dari judul')
                    ->columnSpanFull(),
                
                Textarea::make('description')
                    ->label('Deskripsi Singkat')
                    ->rows(3)
                    ->helperText('Ringkasan singkat tentang materi ini')
                    ->columnSpanFull(),
                
                RichEditor::make('content')
                    ->label('Konten Materi')
                    ->required()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'bulletList',
                        'orderedList',
                        'h2',
                        'h3',
                        'link',
                        'blockquote',
                        'codeBlock',
                    ])
                    ->columnSpanFull(),
                
                Select::make('category')
                    ->label('Kategori')
                    ->required()
                    ->options([
                        'Siaga' => 'Siaga',
                        'Penggalang' => 'Penggalang',
                        'Penegak' => 'Penegak',
                        'Pandega' => 'Pandega',
                        'Umum' => 'Umum',
                        'Pembina' => 'Pembina',
                    ])
                    ->native(false),
                
                Select::make('level')
                    ->label('Tingkat Kesulitan')
                    ->options([
                        'Dasar' => 'Dasar',
                        'Menengah' => 'Menengah',
                        'Lanjutan' => 'Lanjutan',
                    ])
                    ->native(false),
                
                TextInput::make('author')
                    ->label('Penulis')
                    ->maxLength(255),
                
                TagsInput::make('tags')
                    ->label('Tag')
                    ->separator(',')
                    ->helperText('Pisahkan dengan koma'),
                
                FileUpload::make('image')
                    ->label('Gambar Utama')
                    ->image()
                    ->disk('public')
                    ->maxSize(2048)
                    ->directory('materials/images')
                    ->visibility('public')
                    ->imageEditor()
                    ->helperText('Maksimal 2MB'),
                
                FileUpload::make('file_attachment')
                    ->label('File Lampiran (PDF/DOC)')
                    ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                    ->disk('public')
                    ->maxSize(5120)
                    ->directory('materials/files')
                    ->visibility('public')
                    ->helperText('Maksimal 5MB - Format: PDF, DOC, DOCX'),
                
                DateTimePicker::make('published_at')
                    ->label('Tanggal Publikasi')
                    ->default(now())
                    ->native(false),
                
                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->inline(false)
                    ->helperText('Tampilkan di website'),
            ]);
    }
}
