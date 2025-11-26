<?php

namespace App\Filament\Resources\ProfileMenus\Pages;

use App\Filament\Resources\ProfileMenus\ProfileMenuResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProfileMenu extends EditRecord
{
    protected static string $resource = ProfileMenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
