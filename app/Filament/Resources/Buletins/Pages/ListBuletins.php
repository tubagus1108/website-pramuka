<?php

namespace App\Filament\Resources\Buletins\Pages;

use App\Filament\Resources\Buletins\BuletinResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBuletins extends ListRecords
{
    protected static string $resource = BuletinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
