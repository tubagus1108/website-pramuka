<?php

namespace App\Filament\Resources\OrganizationMenus\Pages;

use App\Filament\Resources\OrganizationMenus\OrganizationMenuResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOrganizationMenus extends ListRecords
{
    protected static string $resource = OrganizationMenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
