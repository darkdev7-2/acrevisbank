<?php

namespace App\Filament\Resources\PendingRegistrationResource\Pages;

use App\Filament\Resources\PendingRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Models\Account;
use App\Mail\AccountCreatedEmail;
use App\Services\IbanGenerator;
use Filament\Forms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class ViewPendingRegistration extends ViewRecord
{
    protected static string $resource = PendingRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('validate')
                ->label('Valider l\'inscription')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn () => $this->record->validation_status === 'pending')
                ->form([
                    Forms\Components\Select::make('account_type')
                        ->label('Type de compte')
                        ->options([
                            'Compte Courant' => 'Compte Courant',
                            'Compte Épargne' => 'Compte Épargne',
                        ])
                        ->required()
                        ->default('Compte Courant'),

                    Forms\Components\Select::make('currency')
                        ->label('Devise')
                        ->options([
                            'CHF' => 'CHF (Franc Suisse)',
                            'EUR' => 'EUR (Euro)',
                            'USD' => 'USD (Dollar US)',
                            'GBP' => 'GBP (Livre Sterling)',
                        ])
                        ->required()
                        ->default('CHF'),

                    Forms\Components\TextInput::make('initial_balance')
                        ->label('Solde initial (optionnel)')
                        ->numeric()
                        ->default(0)
                        ->minValue(0)
                        ->suffix('CHF'),
                ])
                ->action(function (array $data) {
                    // Update user validation status
                    $this->record->update([
                        'validation_status' => 'validated',
                        'validated_at' => now(),
                        'validated_by' => Auth::id(),
                    ]);

                    // Generate IBAN
                    $iban = IbanGenerator::generate();
                    $accountNumber = 'ACC-' . strtoupper(substr(uniqid(), -10));

                    // Create bank account
                    $account = $this->record->accounts()->create([
                        'account_number' => $accountNumber,
                        'iban' => $iban,
                        'account_type' => $data['account_type'],
                        'currency' => $data['currency'],
                        'balance' => $data['initial_balance'] ?? 0,
                        'available_balance' => $data['initial_balance'] ?? 0,
                        'is_active' => true,
                        'opened_at' => now(),
                    ]);

                    // Send email to client
                    Mail::to($this->record->email)->send(new AccountCreatedEmail($account));

                    // Show success notification
                    Notification::make()
                        ->success()
                        ->title('Inscription validée')
                        ->body("Le compte de {$this->record->first_name} {$this->record->last_name} a été validé et le compte bancaire {$accountNumber} a été créé.")
                        ->send();

                    // Redirect to list
                    return redirect()->route('filament.admin.resources.pending-registrations.index');
                })
                ->requiresConfirmation()
                ->modalHeading('Valider l\'inscription')
                ->modalDescription('Valider cette inscription créera automatiquement un compte bancaire et enverra un email de confirmation au client.')
                ->modalSubmitActionLabel('Valider et créer le compte'),

            Actions\Action::make('reject')
                ->label('Rejeter')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->visible(fn () => $this->record->validation_status === 'pending')
                ->form([
                    Forms\Components\Textarea::make('rejection_reason')
                        ->label('Motif du rejet')
                        ->required()
                        ->rows(3)
                        ->placeholder('Expliquez la raison du rejet...'),
                ])
                ->action(function (array $data) {
                    $this->record->update([
                        'validation_status' => 'rejected',
                        'validated_at' => now(),
                        'validated_by' => Auth::id(),
                        'rejection_reason' => $data['rejection_reason'],
                    ]);

                    Notification::make()
                        ->warning()
                        ->title('Inscription rejetée')
                        ->body("L'inscription de {$this->record->first_name} {$this->record->last_name} a été rejetée.")
                        ->send();

                    // Redirect to list
                    return redirect()->route('filament.admin.resources.pending-registrations.index');
                })
                ->requiresConfirmation()
                ->modalHeading('Rejeter l\'inscription')
                ->modalDescription('Êtes-vous sûr de vouloir rejeter cette inscription ? Le client sera notifié.')
                ->modalSubmitActionLabel('Rejeter l\'inscription'),

            Actions\Action::make('back')
                ->label('Retour à la liste')
                ->icon('heroicon-o-arrow-left')
                ->url(fn () => route('filament.admin.resources.pending-registrations.index')),
        ];
    }
}
