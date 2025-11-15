<?php

namespace App\Filament\Resources\PendingRegistrationResource\Pages;

use App\Filament\Resources\PendingRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPendingRegistrations extends ListRecords
{
    protected static string $resource = PendingRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('refresh')
                ->label('Actualiser')
                ->icon('heroicon-o-arrow-path')
                ->action(fn () => $this->redirect(request()->header('Referer'))),
        ];
    }
}
