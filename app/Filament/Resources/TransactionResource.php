<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use App\Models\Account;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path';

    protected static ?string $navigationGroup = 'Opérations Bancaires';

    protected static ?string $navigationLabel = 'Transactions';

    protected static ?string $modelLabel = 'Transaction';

    protected static ?string $pluralModelLabel = 'Transactions';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations de la Transaction')
                    ->schema([
                        Forms\Components\Select::make('account_id')
                            ->label('Compte')
                            ->relationship('account', 'account_number')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live()
                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                if ($state) {
                                    $account = Account::find($state);
                                    if ($account) {
                                        $set('current_balance', $account->available_balance);
                                    }
                                }
                            })
                            ->columnSpanFull(),

                        Forms\Components\Select::make('type')
                            ->label('Type de Transaction')
                            ->options([
                                'credit' => 'Crédit (Entrée)',
                                'debit' => 'Débit (Sortie)',
                            ])
                            ->required()
                            ->live()
                            ->default('debit'),

                        Forms\Components\Select::make('category')
                            ->label('Catégorie')
                            ->options([
                                'Virement' => 'Virement',
                                'Prélèvement' => 'Prélèvement',
                                'Carte Bancaire' => 'Carte Bancaire',
                                'Chèque' => 'Chèque',
                                'Frais Bancaires' => 'Frais Bancaires',
                                'Intérêts' => 'Intérêts',
                                'Salaire' => 'Salaire',
                                'Autre' => 'Autre',
                            ])
                            ->required()
                            ->default('Virement'),

                        Forms\Components\Select::make('status')
                            ->label('Statut')
                            ->options([
                                'pending' => 'En attente',
                                'completed' => 'Complété',
                                'failed' => 'Échoué',
                                'cancelled' => 'Annulé',
                            ])
                            ->required()
                            ->default('completed'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Montants')
                    ->schema([
                        Forms\Components\TextInput::make('current_balance')
                            ->label('Solde actuel du compte')
                            ->numeric()
                            ->disabled()
                            ->dehydrated(false)
                            ->prefix('CHF')
                            ->visible(fn (Forms\Get $get) => $get('account_id') !== null),

                        Forms\Components\TextInput::make('amount')
                            ->label('Montant')
                            ->required()
                            ->numeric()
                            ->step(0.01)
                            ->minValue(0.01)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                if ($state && $get('account_id') && $get('type')) {
                                    $account = Account::find($get('account_id'));
                                    if ($account) {
                                        $currentBalance = $account->available_balance;
                                        $newBalance = $get('type') === 'credit'
                                            ? $currentBalance + $state
                                            : $currentBalance - $state;
                                        $set('balance_after', $newBalance);
                                    }
                                }
                            })
                            ->rules([
                                fn (Forms\Get $get): \Closure => function (string $attribute, $value, \Closure $fail) use ($get) {
                                    if ($get('type') === 'debit' && $get('account_id')) {
                                        $account = Account::find($get('account_id'));
                                        if ($account && $value > $account->available_balance) {
                                            $fail("Solde insuffisant. Disponible: " . number_format($account->available_balance, 2) . " CHF");
                                        }
                                    }
                                },
                            ])
                            ->prefix('CHF'),

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

                        Forms\Components\TextInput::make('balance_after')
                            ->label('Solde Après Transaction')
                            ->numeric()
                            ->step(0.01)
                            ->disabled()
                            ->dehydrated()
                            ->prefix('CHF')
                            ->helperText('Calculé automatiquement'),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Destinataire/Émetteur')
                    ->schema([
                        Forms\Components\TextInput::make('recipient_name')
                            ->label('Nom')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('recipient_iban')
                            ->label('IBAN')
                            ->maxLength(34)
                            ->placeholder('CH93 0000 0000 0000 0000 0'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Détails')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->maxLength(500)
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('reference')
                            ->label('Référence')
                            ->maxLength(50)
                            ->default(fn () => 'TRX-' . strtoupper(substr(uniqid(), -10)))
                            ->disabled()
                            ->dehydrated(),

                        Forms\Components\DateTimePicker::make('transaction_date')
                            ->label('Date de Transaction')
                            ->required()
                            ->default(now())
                            ->displayFormat('d/m/Y H:i'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('transaction_date')
                    ->label('Date')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('account.account_number')
                    ->label('Compte')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('reference')
                    ->label('Référence')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Référence copiée'),

                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'credit' => 'success',
                        'debit' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'credit' => 'Crédit',
                        'debit' => 'Débit',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('category')
                    ->label('Catégorie')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('amount')
                    ->label('Montant')
                    ->money('CHF', locale: 'fr_CH')
                    ->sortable()
                    ->color(fn (Transaction $record): string =>
                        $record->type === 'credit' ? 'success' : 'danger'
                    ),

                Tables\Columns\TextColumn::make('recipient_name')
                    ->label('Destinataire/Émetteur')
                    ->searchable()
                    ->limit(30)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'completed' => 'success',
                        'pending' => 'warning',
                        'failed' => 'danger',
                        'cancelled' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'completed' => 'Complété',
                        'pending' => 'En attente',
                        'failed' => 'Échoué',
                        'cancelled' => 'Annulé',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('balance_after')
                    ->label('Solde Après')
                    ->money('CHF', locale: 'fr_CH')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Type de Transaction')
                    ->options([
                        'credit' => 'Crédit',
                        'debit' => 'Débit',
                    ]),

                Tables\Filters\SelectFilter::make('category')
                    ->label('Catégorie')
                    ->options([
                        'Virement' => 'Virement',
                        'Prélèvement' => 'Prélèvement',
                        'Carte Bancaire' => 'Carte Bancaire',
                        'Chèque' => 'Chèque',
                        'Frais Bancaires' => 'Frais Bancaires',
                        'Intérêts' => 'Intérêts',
                        'Salaire' => 'Salaire',
                        'Autre' => 'Autre',
                    ]),

                Tables\Filters\SelectFilter::make('status')
                    ->label('Statut')
                    ->options([
                        'completed' => 'Complété',
                        'pending' => 'En attente',
                        'failed' => 'Échoué',
                        'cancelled' => 'Annulé',
                    ]),

                Tables\Filters\Filter::make('transaction_date')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('Du'),
                        Forms\Components\DatePicker::make('until')
                            ->label('Au'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('transaction_date', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('transaction_date', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),

                Tables\Actions\EditAction::make()
                    ->visible(fn ($record) => $record->status !== 'completed'),

                Tables\Actions\Action::make('complete')
                    ->label('Marquer comme complété')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->action(function ($record) {
                        $record->update(['status' => 'completed']);
                    })
                    ->requiresConfirmation(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('transaction_date', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function canEdit($record): bool
    {
        // Block editing of completed transactions to maintain data integrity
        return $record->status !== 'completed';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'view' => Pages\ViewTransaction::route('/{record}'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
