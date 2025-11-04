<?php

namespace App\Filament\Resources\ContactFormSubmissionResource\Pages;

use App\Filament\Resources\ContactFormSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewContactFormSubmission extends ViewRecord
{
    protected static string $resource = ContactFormSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('mark_as_read')
                ->label('Marquer comme lu')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn () => $this->record->status === 'new')
                ->action(function () {
                    $this->record->update([
                        'status' => 'processed',
                        'replied_at' => now(),
                    ]);
                })
                ->requiresConfirmation()
                ->modalHeading('Marquer comme lu')
                ->modalDescription('Confirmer que ce message a été traité ?'),

            Actions\Action::make('mark_as_unread')
                ->label('Marquer comme non lu')
                ->icon('heroicon-o-envelope')
                ->color('warning')
                ->visible(fn () => $this->record->status === 'processed')
                ->action(function () {
                    $this->record->update([
                        'status' => 'new',
                        'replied_at' => null,
                    ]);
                }),

            Actions\DeleteAction::make(),

            Actions\Action::make('back')
                ->label('Retour à la liste')
                ->icon('heroicon-o-arrow-left')
                ->url(fn () => route('filament.admin.resources.contact-form-submissions.index')),
        ];
    }
}
