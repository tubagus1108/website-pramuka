<?php

namespace App\Filament\Resources\ProfileMenus\Pages;

use App\Filament\Resources\ProfileMenus\ProfileMenuResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProfileMenus extends ListRecords
{
    protected static string $resource = ProfileMenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
