<?php

namespace App\Filament\Resources\ProfileMenus\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProfileMenuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Submenu')
                    ->required(),
                RichEditor::make('content')
                    ->label('Isi Konten')
                    ->required(false),
                \Filament\Forms\Components\Toggle::make('is_active')
                    ->label('Aktif?')
                    ->inline(false),
            ]);
    }
}
