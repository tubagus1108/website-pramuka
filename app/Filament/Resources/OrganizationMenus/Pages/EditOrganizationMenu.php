<?php

namespace App\Filament\Resources\OrganizationMenus\Pages;

use App\Filament\Resources\OrganizationMenus\OrganizationMenuResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOrganizationMenu extends EditRecord
{
    protected static string $resource = OrganizationMenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
