<?php

namespace App\Filament\Resources\News\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class NewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
                    ->size(80),
                \Filament\Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('category')
                    ->label('Kategori'),
                \Filament\Tables\Columns\TextColumn::make('tags')
                    ->label('Tags'),
                \Filament\Tables\Columns\TextColumn::make('published_at')
                    ->label('Publish')
                    ->dateTime(),
                \Filament\Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
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
