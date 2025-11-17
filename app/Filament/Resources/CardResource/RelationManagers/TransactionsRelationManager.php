<?php

namespace App\Filament\Resources\CardResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class TransactionsRelationManager extends RelationManager
{
    protected static string $relationship = 'transactions';

    protected static ?string $title = 'Transactions';

    protected static ?string $recordTitleAttribute = 'transaction_id';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('transaction_id')
                    ->label('ID Transaction')
                    ->required()
                    ->disabled(),

                Forms\Components\Select::make('type')
                    ->label('Type')
                    ->options([
                        'purchase' => 'Achat',
                        'withdrawal' => 'Retrait',
                        'refund' => 'Remboursement',
                        'fee' => 'Frais',
                        'reversal' => 'Annulation',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('amount')
                    ->label('Montant')
                    ->numeric()
                    ->required()
                    ->suffix('CHF'),

                Forms\Components\TextInput::make('merchant_name')
                    ->label('Marchand')
                    ->maxLength(255),

                Forms\Components\Select::make('status')
                    ->label('Statut')
                    ->options([
                        'pending' => 'En attente',
                        'approved' => 'Approuvée',
                        'declined' => 'Refusée',
                        'reversed' => 'Annulée',
                    ])
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('transaction_id')
            ->columns([
                Tables\Columns\TextColumn::make('transaction_id')
                    ->label('ID Transaction')
                    ->searchable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'purchase' => 'Achat',
                        'withdrawal' => 'Retrait',
                        'refund' => 'Remboursement',
                        'fee' => 'Frais',
                        'reversal' => 'Annulation',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('amount')
                    ->label('Montant')
                    ->money('CHF')
                    ->sortable(),

                Tables\Columns\TextColumn::make('merchant_name')
                    ->label('Marchand')
                    ->searchable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('merchant_location')
                    ->label('Localisation')
                    ->limit(30)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'approved' => 'success',
                        'pending' => 'warning',
                        'declined' => 'danger',
                        'reversed' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'En attente',
                        'approved' => 'Approuvée',
                        'declined' => 'Refusée',
                        'reversed' => 'Annulée',
                        default => $state,
                    }),

                Tables\Columns\IconColumn::make('is_online')
                    ->label('En ligne')
                    ->boolean()
                    ->toggleable(),

                Tables\Columns\IconColumn::make('is_international')
                    ->label('International')
                    ->boolean()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Statut')
                    ->options([
                        'pending' => 'En attente',
                        'approved' => 'Approuvée',
                        'declined' => 'Refusée',
                        'reversed' => 'Annulée',
                    ]),

                Tables\Filters\SelectFilter::make('type')
                    ->label('Type')
                    ->options([
                        'purchase' => 'Achat',
                        'withdrawal' => 'Retrait',
                        'refund' => 'Remboursement',
                        'fee' => 'Frais',
                        'reversal' => 'Annulation',
                    ]),

                Tables\Filters\Filter::make('is_international')
                    ->label('Transactions internationales')
                    ->query(fn ($query) => $query->where('is_international', true)),
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
