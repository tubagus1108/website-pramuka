<?php

namespace App\Filament\Resources\OrganizationMenus;

use App\Filament\Resources\OrganizationMenus\Pages\CreateOrganizationMenu;
use App\Filament\Resources\OrganizationMenus\Pages\EditOrganizationMenu;
use App\Filament\Resources\OrganizationMenus\Pages\ListOrganizationMenus;
use App\Filament\Resources\OrganizationMenus\Schemas\OrganizationMenuForm;
use App\Filament\Resources\OrganizationMenus\Tables\OrganizationMenusTable;
use App\Models\OrganizationMenu;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OrganizationMenuResource extends Resource
{
    protected static ?string $model = OrganizationMenu::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return OrganizationMenuForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrganizationMenusTable::configure($table);
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
            'index' => ListOrganizationMenus::route('/'),
            'create' => CreateOrganizationMenu::route('/create'),
            'edit' => EditOrganizationMenu::route('/{record}/edit'),
        ];
    }
}
