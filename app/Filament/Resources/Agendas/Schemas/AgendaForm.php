<?php

namespace App\Filament\Resources\Agendas\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;

class AgendaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Agenda')
                    ->required(),
                DateTimePicker::make('date')
                    ->label('Tanggal & Waktu')
                    ->required(),
                RichEditor::make('description')
                    ->label('Deskripsi')
                    ->required(false),
                TextInput::make('google_calendar_url')
                    ->label('Google Calendar URL')
                    ->url()
                    ->required(false),
            ]);
    }
}
