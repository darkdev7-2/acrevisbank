<?php

namespace App\Filament\Resources\CreditRequestResource\Pages;

use App\Filament\Resources\CreditRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCreditRequest extends EditRecord
{
    protected static string $resource = CreditRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
