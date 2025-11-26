<?php

namespace App\Filament\Resources\ProfileMenus;

use App\Filament\Resources\ProfileMenus\Pages\CreateProfileMenu;
use App\Filament\Resources\ProfileMenus\Pages\EditProfileMenu;
use App\Filament\Resources\ProfileMenus\Pages\ListProfileMenus;
use App\Filament\Resources\ProfileMenus\Schemas\ProfileMenuForm;
use App\Filament\Resources\ProfileMenus\Tables\ProfileMenusTable;
use App\Models\ProfileMenu;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProfileMenuResource extends Resource
{
    protected static ?string $model = ProfileMenu::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ProfileMenuForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProfileMenusTable::configure($table);
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
            'index' => ListProfileMenus::route('/'),
            'create' => CreateProfileMenu::route('/create'),
            'edit' => EditProfileMenu::route('/{record}/edit'),
        ];
    }
}
