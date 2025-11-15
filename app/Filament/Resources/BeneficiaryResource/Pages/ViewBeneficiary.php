<?php

namespace App\Filament\Resources\BeneficiaryResource\Pages;

use App\Filament\Resources\BeneficiaryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBeneficiary extends ViewRecord
{
    protected static string $resource = BeneficiaryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('activate')
                ->label('Activer le bénéficiaire')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn () => !$this->record->is_active)
                ->action(function () {
                    $this->record->update(['is_active' => true]);
                })
                ->requiresConfirmation()
                ->modalHeading('Activer le bénéficiaire')
                ->modalDescription('Confirmer l\'activation de ce bénéficiaire ?'),

            Actions\Action::make('deactivate')
                ->label('Désactiver le bénéficiaire')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->visible(fn () => $this->record->is_active)
                ->action(function () {
                    $this->record->update(['is_active' => false]);
                })
                ->requiresConfirmation()
                ->modalHeading('Désactiver le bénéficiaire')
                ->modalDescription('Désactiver ce bénéficiaire empêchera les virements vers lui.'),

            Actions\EditAction::make(),

            Actions\DeleteAction::make()
                ->requiresConfirmation()
                ->modalHeading('Supprimer le bénéficiaire')
                ->modalDescription('Confirmer la suppression de ce bénéficiaire ?'),

            Actions\Action::make('back')
                ->label('Retour à la liste')
                ->icon('heroicon-o-arrow-left')
                ->url(fn () => route('filament.admin.resources.beneficiaries.index')),
        ];
    }
}
