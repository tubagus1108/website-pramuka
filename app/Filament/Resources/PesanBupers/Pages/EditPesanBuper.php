<?php

namespace App\Filament\Resources\PesanBupers\Pages;

use App\Filament\Resources\PesanBupers\PesanBuperResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPesanBuper extends EditRecord
{
    protected static string $resource = PesanBuperResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
