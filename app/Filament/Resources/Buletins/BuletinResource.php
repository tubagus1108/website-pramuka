<?php

namespace App\Filament\Resources\Buletins;

use App\Filament\Resources\Buletins\Pages\CreateBuletin;
use App\Filament\Resources\Buletins\Pages\EditBuletin;
use App\Filament\Resources\Buletins\Pages\ListBuletins;
use App\Filament\Resources\Buletins\Schemas\BuletinForm;
use App\Filament\Resources\Buletins\Tables\BuletinsTable;
use App\Models\Buletin;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BuletinResource extends Resource
{
    protected static ?string $model = Buletin::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Buletin';

    protected static ?string $modelLabel = 'Buletin';

    protected static ?string $pluralModelLabel = 'Buletin';

    public static function form(Schema $schema): Schema
    {
        return BuletinForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BuletinsTable::configure($table);
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
            'index' => ListBuletins::route('/'),
            'create' => CreateBuletin::route('/create'),
            'edit' => EditBuletin::route('/{record}/edit'),
        ];
    }
}
