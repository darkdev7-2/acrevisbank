<?php

namespace App\Filament\Resources\SuspiciousActivityResource\Pages;

use App\Filament\Resources\SuspiciousActivityResource;
use App\Services\SuspiciousActivityDetectionService;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms;
use Filament\Notifications\Notification;

class ViewSuspiciousActivity extends ViewRecord
{
    protected static string $resource = SuspiciousActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('resolve')
                ->label('Résoudre l\'activité')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->form([
                    Forms\Components\Textarea::make('resolution_notes')
                        ->label('Notes de résolution')
                        ->required()
                        ->rows(4)
                        ->placeholder('Décrivez les actions prises et la conclusion...'),
                    Forms\Components\Toggle::make('false_positive')
                        ->label('Marquer comme faux positif')
                        ->helperText('Si cette activité n\'était pas réellement suspecte'),
                ])
                ->action(function (array $data) {
                    $service = app(SuspiciousActivityDetectionService::class);
                    $service->resolve(
                        $this->record,
                        auth()->user(),
                        $data['resolution_notes'],
                        $data['false_positive'] ?? false
                    );

                    Notification::make()
                        ->title('Activité suspecte résolue')
                        ->body('L\'activité a été marquée comme résolue avec succès.')
                        ->success()
                        ->send();

                    return redirect()->route('filament.admin.resources.suspicious-activities.index');
                })
                ->visible(fn () => !$this->record->is_resolved),

            Actions\Action::make('view_user')
                ->label('Voir l\'utilisateur')
                ->icon('heroicon-o-user')
                ->color('info')
                ->url(fn () => $this->record->user_id
                    ? route('filament.admin.resources.users.view', ['record' => $this->record->user_id])
                    : null)
                ->visible(fn () => $this->record->user_id !== null),
        ];
    }
}
