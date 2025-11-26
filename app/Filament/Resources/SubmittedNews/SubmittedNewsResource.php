<?php

namespace App\Filament\Resources\SubmittedNews;

use App\Filament\Resources\SubmittedNews\Pages\CreateSubmittedNews;
use App\Filament\Resources\SubmittedNews\Pages\EditSubmittedNews;
use App\Filament\Resources\SubmittedNews\Pages\ListSubmittedNews;
use App\Filament\Resources\SubmittedNews\Schemas\SubmittedNewsForm;
use App\Filament\Resources\SubmittedNews\Tables\SubmittedNewsTable;
use App\Models\SubmittedNews;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SubmittedNewsResource extends Resource
{
    protected static ?string $model = SubmittedNews::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Kirim Berita';

    protected static ?string $modelLabel = 'Berita Terkirim';

    protected static ?string $pluralModelLabel = 'Berita Terkirim';

    public static function form(Schema $schema): Schema
    {
        return SubmittedNewsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SubmittedNewsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSubmittedNews::route('/'),
            'create' => CreateSubmittedNews::route('/create'),
            'edit' => EditSubmittedNews::route('/{record}/edit'),
        ];
    }
}
