<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TransactionsRelationManager extends RelationManager
{
    protected static string $relationship = 'transactions';

    protected static ?string $title = 'Transactions';
    protected static ?string $modelLabel = 'Transaction';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations de la transaction')
                    ->schema([
                        Forms\Components\Select::make('account_id')
                            ->label('Compte')
                            ->relationship('account', 'account_number')
                            ->required()
                            ->disabled()
                            ->dehydrated(false),

                        Forms\Components\TextInput::make('transaction_number')
                            ->label('Numéro de transaction')
                            ->disabled()
                            ->dehydrated(false),

                        Forms\Components\Select::make('type')
                            ->label('Type')
                            ->options([
                                'credit' => 'Crédit',
                                'debit' => 'Débit',
                            ])
                            ->required()
                            ->disabled()
                            ->dehydrated(false),

                        Forms\Components\TextInput::make('amount')
                            ->label('Montant')
                            ->numeric()
                            ->disabled()
                            ->dehydrated(false)
                            ->suffix('CHF'),

                        Forms\Components\TextInput::make('balance_after')
                            ->label('Solde après')
                            ->numeric()
                            ->disabled()
                            ->dehydrated(false)
                            ->suffix('CHF'),

                        Forms\Components\Select::make('status')
                            ->label('Statut')
                            ->options([
                                'pending' => 'En attente',
                                'completed' => 'Complétée',
                                'failed' => 'Échouée',
                                'cancelled' => 'Annulée',
                            ])
                            ->disabled()
                            ->dehydrated(false),

                        Forms\Components\DateTimePicker::make('transaction_date')
                            ->label('Date de transaction')
                            ->disabled()
                            ->dehydrated(false),

                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->disabled()
                            ->dehydrated(false)
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('transaction_number')
            ->columns([
                Tables\Columns\TextColumn::make('transaction_number')
                    ->label('N° Transaction')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->weight('medium'),

                Tables\Columns\TextColumn::make('account.account_number')
                    ->label('Compte')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('type')
                    ->label('Type')
                    ->icon(fn (string $state): string => match ($state) {
                        'credit' => 'heroicon-o-arrow-down-circle',
                        'debit' => 'heroicon-o-arrow-up-circle',
                        default => 'heroicon-o-question-mark-circle',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'credit' => 'success',
                        'debit' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('amount')
                    ->label('Montant')
                    ->money('CHF')
                    ->sortable()
                    ->color(fn ($record) => $record->type === 'credit' ? 'success' : 'danger')
                    ->formatStateUsing(fn ($record, $state) =>
                        ($record->type === 'debit' ? '-' : '+') . number_format($state, 2) . ' CHF'
                    ),

                Tables\Columns\TextColumn::make('balance_after')
                    ->label('Solde après')
                    ->money('CHF')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'completed' => 'success',
                        'failed' => 'danger',
                        'cancelled' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'En attente',
                        'completed' => 'Complétée',
                        'failed' => 'Échouée',
                        'cancelled' => 'Annulée',
                        default => $state,
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('transaction_date')
                    ->label('Date')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->since(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(30)
                    ->searchable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Type')
                    ->options([
                        'credit' => 'Crédit',
                        'debit' => 'Débit',
                    ]),

                Tables\Filters\SelectFilter::make('status')
                    ->label('Statut')
                    ->options([
                        'pending' => 'En attente',
                        'completed' => 'Complétée',
                        'failed' => 'Échouée',
                        'cancelled' => 'Annulée',
                    ])
                    ->default('completed'),

                Tables\Filters\SelectFilter::make('account_id')
                    ->label('Compte')
                    ->relationship('account', 'account_number'),

                Tables\Filters\Filter::make('transaction_date')
                    ->label('Ce mois')
                    ->query(fn (Builder $query): Builder =>
                        $query->whereMonth('transaction_date', now()->month)
                              ->whereYear('transaction_date', now()->year)
                    ),
            ])
            ->headerActions([
                // No create action - transactions should be created via the main TransactionResource
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                // No bulk actions - transactions should not be bulk deleted
            ])
            ->defaultSort('transaction_date', 'desc');
    }
}
