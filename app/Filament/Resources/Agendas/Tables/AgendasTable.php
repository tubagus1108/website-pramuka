<?php

namespace App\Filament\Resources\Agendas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class AgendasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('title')
                    ->label('Judul Agenda')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('date')
                    ->label('Tanggal & Waktu')
                    ->dateTime(),
                \Filament\Tables\Columns\TextColumn::make('google_calendar_url')
                    ->label('Google Calendar URL')
                    ->url(fn($record) => $record->google_calendar_url),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
