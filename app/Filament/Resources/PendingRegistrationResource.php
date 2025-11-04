<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendingRegistrationResource\Pages;
use App\Models\User;
use App\Models\Account;
use App\Mail\AccountCreatedEmail;
use App\Mail\RegistrationRejected;
use App\Services\IbanGenerator;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PendingRegistrationResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    protected static ?string $navigationGroup = 'Gestion Clients';

    protected static ?string $navigationLabel = 'Inscriptions en attente';

    protected static ?string $modelLabel = 'Inscription en attente';

    protected static ?string $pluralModelLabel = 'Inscriptions en attente';

    protected static ?int $navigationSort = 0; // First in the group

    // Only show pending registrations
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('validation_status', 'pending');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations Personnelles')
                    ->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->label('Prénom')
                            ->disabled(),

                        Forms\Components\TextInput::make('last_name')
                            ->label('Nom')
                            ->disabled(),

                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->disabled(),

                        Forms\Components\TextInput::make('birth_date')
                            ->label('Date de naissance')
                            ->disabled(),

                        Forms\Components\TextInput::make('birth_place')
                            ->label('Lieu de naissance')
                            ->disabled(),

                        Forms\Components\TextInput::make('nationality')
                            ->label('Nationalité')
                            ->disabled(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Coordonnées')
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                            ->label('Téléphone')
                            ->disabled(),

                        Forms\Components\TextInput::make('street')
                            ->label('Rue')
                            ->disabled(),

                        Forms\Components\TextInput::make('postal_code')
                            ->label('Code postal')
                            ->disabled(),

                        Forms\Components\TextInput::make('city')
                            ->label('Ville')
                            ->disabled(),

                        Forms\Components\TextInput::make('country')
                            ->label('Pays')
                            ->disabled(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Informations Professionnelles')
                    ->schema([
                        Forms\Components\TextInput::make('profession')
                            ->label('Profession')
                            ->disabled(),

                        Forms\Components\TextInput::make('employer')
                            ->label('Employeur')
                            ->disabled(),

                        Forms\Components\TextInput::make('annual_income')
                            ->label('Revenu annuel')
                            ->disabled()
                            ->prefix('CHF'),

                        Forms\Components\TextInput::make('funds_source')
                            ->label('Source des fonds')
                            ->disabled(),

                        Forms\Components\Toggle::make('politically_exposed')
                            ->label('Personne politiquement exposée')
                            ->disabled(),

                        Forms\Components\TextInput::make('tax_residence_country')
                            ->label('Pays de résidence fiscale')
                            ->disabled(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Document d\'Identité')
                    ->schema([
                        Forms\Components\TextInput::make('id_document_type')
                            ->label('Type de document')
                            ->disabled(),

                        Forms\Components\TextInput::make('id_document_number')
                            ->label('Numéro du document')
                            ->disabled(),

                        Forms\Components\TextInput::make('id_document_expiry')
                            ->label('Date d\'expiration')
                            ->disabled(),

                        Forms\Components\Placeholder::make('id_document_view')
                            ->label('Document uploadé')
                            ->content(function ($record) {
                                if (!$record || !$record->id_document_path) {
                                    return 'Aucun document';
                                }

                                $url = Storage::url($record->id_document_path);
                                $extension = pathinfo($record->id_document_path, PATHINFO_EXTENSION);

                                if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                                    return new \Illuminate\Support\HtmlString(
                                        '<a href="' . $url . '" target="_blank" class="text-blue-600 hover:underline">
                                            <img src="' . $url . '" class="max-w-md rounded-lg shadow-lg" alt="Document">
                                        </a>'
                                    );
                                }

                                return new \Illuminate\Support\HtmlString(
                                    '<a href="' . $url . '" target="_blank" class="text-blue-600 hover:underline flex items-center gap-2">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                        Télécharger le document (PDF)
                                    </a>'
                                );
                            })
                            ->columnSpanFull(),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Dates')
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Date d\'inscription')
                            ->content(fn ($record) => $record?->created_at?->format('d/m/Y à H:i')),

                        Forms\Components\Placeholder::make('terms_accepted_at')
                            ->label('Conditions acceptées le')
                            ->content(fn ($record) => $record?->terms_accepted_at?->format('d/m/Y à H:i')),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date d\'inscription')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('first_name')
                    ->label('Prénom')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('last_name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Email copié'),

                Tables\Columns\TextColumn::make('nationality')
                    ->label('Nationalité')
                    ->searchable(),

                Tables\Columns\TextColumn::make('profession')
                    ->label('Profession')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('annual_income')
                    ->label('Revenu annuel')
                    ->money('CHF', locale: 'fr_CH')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\IconColumn::make('politically_exposed')
                    ->label('PPE')
                    ->boolean()
                    ->trueIcon('heroicon-o-exclamation-triangle')
                    ->falseIcon('heroicon-o-check-circle')
                    ->trueColor('warning')
                    ->falseColor('success')
                    ->toggleable(),

                Tables\Columns\BadgeColumn::make('validation_status')
                    ->label('Statut')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'validated',
                        'danger' => 'rejected',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'En attente',
                        'validated' => 'Validé',
                        'rejected' => 'Rejeté',
                        default => $state,
                    }),
            ])
            ->filters([
                Tables\Filters\Filter::make('has_document')
                    ->label('Avec document')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('id_document_path'))
                    ->toggle(),

                Tables\Filters\TernaryFilter::make('politically_exposed')
                    ->label('Personne politiquement exposée')
                    ->placeholder('Tous')
                    ->trueLabel('PPE uniquement')
                    ->falseLabel('Non-PPE uniquement'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),

                Tables\Actions\Action::make('validate')
                    ->label('Valider')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
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
                    ->action(function (User $record, array $data) {
                        // Update user validation status
                        $record->update([
                            'validation_status' => 'validated',
                            'validated_at' => now(),
                            'validated_by' => Auth::id(),
                        ]);

                        // Generate IBAN
                        $iban = IbanGenerator::generate();
                        $accountNumber = 'ACC-' . strtoupper(substr(uniqid(), -10));

                        // Create bank account
                        $account = $record->accounts()->create([
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
                        Mail::to($record->email)->send(new AccountCreatedEmail($account));

                        // Show success notification
                        Notification::make()
                            ->success()
                            ->title('Inscription validée')
                            ->body("Le compte de {$record->first_name} {$record->last_name} a été validé et le compte bancaire {$accountNumber} a été créé.")
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Valider l\'inscription')
                    ->modalDescription('Valider cette inscription créera automatiquement un compte bancaire et enverra un email de confirmation au client.')
                    ->modalSubmitActionLabel('Valider et créer le compte'),

                Tables\Actions\Action::make('reject')
                    ->label('Rejeter')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->form([
                        Forms\Components\Textarea::make('rejection_reason')
                            ->label('Motif du rejet (visible par le client)')
                            ->required()
                            ->rows(3)
                            ->placeholder('Expliquez la raison du rejet...')
                            ->helperText('Ce message sera envoyé au client par email'),
                    ])
                    ->action(function (User $record, array $data) {
                        $record->update([
                            'validation_status' => 'rejected',
                            'validated_at' => now(),
                            'validated_by' => Auth::id(),
                            'rejection_reason' => $data['rejection_reason'],
                        ]);

                        // Send rejection email
                        Mail::to($record->email)->send(new RegistrationRejected($record, $data['rejection_reason']));

                        Notification::make()
                            ->warning()
                            ->title('Inscription rejetée')
                            ->body("L'inscription de {$record->first_name} {$record->last_name} a été rejetée. Un email a été envoyé au client.")
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Rejeter l\'inscription')
                    ->modalDescription('Êtes-vous sûr de vouloir rejeter cette inscription ? Le client sera notifié par email.')
                    ->modalSubmitActionLabel('Rejeter l\'inscription'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->poll('30s'); // Auto-refresh every 30 seconds
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPendingRegistrations::route('/'),
            'view' => Pages\ViewPendingRegistration::route('/{record}'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('validation_status', 'pending')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        $count = static::getModel()::where('validation_status', 'pending')->count();

        return match (true) {
            $count > 10 => 'danger',
            $count > 5 => 'warning',
            $count > 0 => 'success',
            default => 'gray',
        };
    }
}
