<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTransaction extends ViewRecord
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->visible(fn () => $this->record->status !== 'completed'),

            Actions\Action::make('complete')
                ->label('Marquer comme complété')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn () => $this->record->status === 'pending')
                ->action(function () {
                    $this->record->update(['status' => 'completed']);
                })
                ->requiresConfirmation(),

            Actions\DeleteAction::make()
                ->visible(fn () => $this->record->status !== 'completed'),

            Actions\Action::make('back')
                ->label('Retour à la liste')
                ->icon('heroicon-o-arrow-left')
                ->url(fn () => route('filament.admin.resources.transactions.index')),
        ];
    }
}
