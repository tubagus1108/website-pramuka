<?php

namespace App\Filament\Resources\PesanBupers;

use App\Filament\Resources\PesanBupers\Pages\CreatePesanBuper;
use App\Filament\Resources\PesanBupers\Pages\EditPesanBuper;
use App\Filament\Resources\PesanBupers\Pages\ListPesanBupers;
use App\Filament\Resources\PesanBupers\Schemas\PesanBuperForm;
use App\Filament\Resources\PesanBupers\Tables\PesanBupersTable;
use App\Models\PesanBuper;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PesanBuperResource extends Resource
{
    protected static ?string $model = PesanBuper::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Pesan Buper';

    protected static ?string $modelLabel = 'Pesan Buper';

    protected static ?string $pluralModelLabel = 'Pesan Buper';

    public static function form(Schema $schema): Schema
    {
        return PesanBuperForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PesanBupersTable::configure($table);
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
            'index' => ListPesanBupers::route('/'),
            'create' => CreatePesanBuper::route('/create'),
            'edit' => EditPesanBuper::route('/{record}/edit'),
        ];
    }
}
