<?php

namespace App\Filament\Resources\SubmittedNews\Pages;

use App\Filament\Resources\SubmittedNews\SubmittedNewsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSubmittedNews extends EditRecord
{
    protected static string $resource = SubmittedNewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
