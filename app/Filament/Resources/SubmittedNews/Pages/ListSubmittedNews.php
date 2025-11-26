<?php

namespace App\Filament\Resources\SubmittedNews\Pages;

use App\Filament\Resources\SubmittedNews\SubmittedNewsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSubmittedNews extends ListRecords
{
    protected static string $resource = SubmittedNewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
