<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Clients';
    protected static ?string $modelLabel = 'Client';
    protected static ?string $pluralModelLabel = 'Clients';
    protected static ?string $navigationGroup = 'Gestion Clients';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations Personnelles')
                    ->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->label('Prénom')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('last_name')
                            ->label('Nom')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Forms\Components\DatePicker::make('birth_date')
                            ->label('Date de naissance'),

                        Forms\Components\Select::make('account_type')
                            ->label('Type de compte')
                            ->options([
                                'individual' => 'Particulier',
                                'business' => 'Entreprise',
                            ])
                            ->default('individual'),

                        Forms\Components\Select::make('customer_segment')
                            ->label('Segment')
                            ->options([
                                'privat' => 'Privé',
                                'business' => 'Entreprise',
                            ])
                            ->default('privat'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Coordonnées')
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                            ->label('Téléphone')
                            ->tel()
                            ->maxLength(50),

                        Forms\Components\TextInput::make('whatsapp')
                            ->label('WhatsApp')
                            ->tel()
                            ->maxLength(50),

                        Forms\Components\TextInput::make('country')
                            ->label('Pays')
                            ->maxLength(100),

                        Forms\Components\TextInput::make('city')
                            ->label('Ville')
                            ->maxLength(100),

                        Forms\Components\Textarea::make('address')
                            ->label('Adresse')
                            ->maxLength(500)
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Préférences')
                    ->schema([
                        Forms\Components\Select::make('preferred_language')
                            ->label('Langue préférée')
                            ->options([
                                'fr' => 'Français',
                                'de' => 'Allemand',
                                'en' => 'Anglais',
                                'es' => 'Espagnol',
                            ])
                            ->default('fr'),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Compte actif')
                            ->default(true),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Sécurité')
                    ->schema([
                        Forms\Components\TextInput::make('password')
                            ->label('Mot de passe')
                            ->password()
                            ->dehydrateStateUsing(fn ($state) => bcrypt($state))
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create')
                            ->maxLength(255),
                    ])
                    ->visibleOn('create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
                    ->icon('heroicon-m-envelope')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Téléphone')
                    ->icon('heroicon-m-phone')
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('customer_segment')
                    ->label('Segment')
                    ->colors([
                        'primary' => 'privat',
                        'success' => 'business',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'privat' => 'Privé',
                        'business' => 'Entreprise',
                        default => $state,
                    }),

                Tables\Columns\BadgeColumn::make('account_type')
                    ->label('Type')
                    ->colors([
                        'info' => 'individual',
                        'warning' => 'business',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'individual' => 'Particulier',
                        'business' => 'Entreprise',
                        default => $state,
                    }),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Actif')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\IconColumn::make('has_account')
                    ->label('Compte Bancaire')
                    ->boolean()
                    ->getStateUsing(fn (User $record): bool => $record->accounts()->count() > 0)
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('last_login_at')
                    ->label('Dernière connexion')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('customer_segment')
                    ->label('Segment')
                    ->options([
                        'privat' => 'Privé',
                        'business' => 'Entreprise',
                    ]),

                Tables\Filters\SelectFilter::make('account_type')
                    ->label('Type de compte')
                    ->options([
                        'individual' => 'Particulier',
                        'business' => 'Entreprise',
                    ]),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Compte actif')
                    ->placeholder('Tous')
                    ->trueLabel('Actifs uniquement')
                    ->falseLabel('Inactifs uniquement'),

                Tables\Filters\Filter::make('has_bank_account')
                    ->label('Compte bancaire')
                    ->query(fn (Builder $query): Builder => $query->has('accounts'))
                    ->toggle(),

                Tables\Filters\Filter::make('no_bank_account')
                    ->label('Sans compte bancaire')
                    ->query(fn (Builder $query): Builder => $query->doesntHave('accounts'))
                    ->toggle(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('create_account')
                    ->label('Créer Compte Bancaire')
                    ->icon('heroicon-o-plus-circle')
                    ->color('success')
                    ->visible(fn (User $record): bool => $record->accounts()->count() === 0)
                    ->form([
                        Forms\Components\Select::make('account_type')
                            ->label('Type de Compte')
                            ->options([
                                'Compte Courant' => 'Compte Courant',
                                'Compte Épargne' => 'Compte Épargne',
                                'Compte Joint' => 'Compte Joint',
                                'Compte Entreprise' => 'Compte Entreprise',
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
                            ->label('Solde Initial')
                            ->numeric()
                            ->default(0)
                            ->minValue(0)
                            ->suffix('CHF'),
                    ])
                    ->action(function (User $record, array $data) {
                        // Generate IBAN
                        $iban = \App\Services\IbanGenerator::generate();

                        // Generate account number
                        $accountNumber = 'ACC-' . strtoupper(substr(uniqid(), -10));

                        // Create account
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

                        // Send email notification
                        \Illuminate\Support\Facades\Mail::to($record->email)
                            ->send(new \App\Mail\AccountCreatedEmail($account));

                        // Show success notification
                        \Filament\Notifications\Notification::make()
                            ->success()
                            ->title('Compte bancaire créé')
                            ->body("Le compte {$accountNumber} a été créé avec succès. IBAN: {$iban}")
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Créer un compte bancaire')
                    ->modalDescription('Créer un nouveau compte bancaire pour ce client. Un IBAN sera généré automatiquement.')
                    ->modalSubmitActionLabel('Créer le compte'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('activate')
                        ->label('Activer')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn ($records) => $records->each->update(['is_active' => true]))
                        ->deselectRecordsAfterCompletion(),
                    Tables\Actions\BulkAction::make('deactivate')
                        ->label('Désactiver')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(fn ($records) => $records->each->update(['is_active' => false]))
                        ->deselectRecordsAfterCompletion(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
