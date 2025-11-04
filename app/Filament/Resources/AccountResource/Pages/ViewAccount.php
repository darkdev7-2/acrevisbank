<?php

namespace App\Filament\Resources\AccountResource\Pages;

use App\Filament\Resources\AccountResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAccount extends ViewRecord
{
    protected static string $resource = AccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('activate')
                ->label('Activer le compte')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn () => !$this->record->is_active)
                ->action(function () {
                    $this->record->update(['is_active' => true]);
                })
                ->requiresConfirmation()
                ->modalHeading('Activer le compte')
                ->modalDescription('Confirmer l\'activation de ce compte bancaire ?'),

            Actions\Action::make('deactivate')
                ->label('Désactiver le compte')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->visible(fn () => $this->record->is_active)
                ->action(function () {
                    $this->record->update(['is_active' => false]);
                })
                ->requiresConfirmation()
                ->modalHeading('Désactiver le compte')
                ->modalDescription('Attention : désactiver ce compte empêchera toutes les transactions. Continuer ?'),

            Actions\EditAction::make(),

            Actions\DeleteAction::make()
                ->requiresConfirmation()
                ->modalHeading('Supprimer le compte')
                ->modalDescription('Attention : cette action est irréversible. Toutes les transactions liées seront affectées.')
                ->visible(fn () => !$this->record->is_active && $this->record->balance == 0),

            Actions\Action::make('back')
                ->label('Retour à la liste')
                ->icon('heroicon-o-arrow-left')
                ->url(fn () => route('filament.admin.resources.accounts.index')),
        ];
    }
}
