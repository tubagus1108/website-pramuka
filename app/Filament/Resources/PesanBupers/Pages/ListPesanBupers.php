<?php

namespace App\Filament\Resources\PesanBupers\Pages;

use App\Filament\Resources\PesanBupers\PesanBuperResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPesanBupers extends ListRecords
{
    protected static string $resource = PesanBuperResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
