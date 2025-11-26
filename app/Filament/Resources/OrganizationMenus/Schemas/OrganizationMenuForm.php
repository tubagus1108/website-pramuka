<?php

namespace App\Filament\Resources\OrganizationMenus\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class OrganizationMenuForm
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
                Toggle::make('is_active')
                    ->label('Aktif?')
                    ->inline(false),
            ]);
    }
}
