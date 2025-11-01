<?php

namespace App\Filament\Resources\CreditRequestResource\Pages;

use App\Filament\Resources\CreditRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCreditRequests extends ListRecords
{
    protected static string $resource = CreditRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
