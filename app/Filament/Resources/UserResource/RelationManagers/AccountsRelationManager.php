<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AccountsRelationManager extends RelationManager
{
    protected static string $relationship = 'accounts';

    protected static ?string $title = 'Comptes Bancaires';
    protected static ?string $modelLabel = 'Compte';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations du compte')
                    ->schema([
                        Forms\Components\TextInput::make('account_number')
                            ->label('Numéro de compte')
                            ->disabled()
                            ->dehydrated(false),

                        Forms\Components\TextInput::make('iban')
                            ->label('IBAN')
                            ->disabled()
                            ->dehydrated(false),

                        Forms\Components\Select::make('account_type')
                            ->label('Type de compte')
                            ->options([
                                'Compte Courant' => 'Compte Courant',
                                'Compte Épargne' => 'Compte Épargne',
                                'Compte Professionnel' => 'Compte Professionnel',
                            ])
                            ->required(),

                        Forms\Components\Select::make('currency')
                            ->label('Devise')
                            ->options([
                                'CHF' => 'CHF (Franc Suisse)',
                                'EUR' => 'EUR (Euro)',
                                'USD' => 'USD (Dollar US)',
                                'GBP' => 'GBP (Livre Sterling)',
                            ])
                            ->required(),

                        Forms\Components\TextInput::make('balance')
                            ->label('Solde')
                            ->numeric()
                            ->disabled()
                            ->dehydrated(false)
                            ->suffix('CHF'),

                        Forms\Components\TextInput::make('available_balance')
                            ->label('Solde disponible')
                            ->numeric()
                            ->disabled()
                            ->dehydrated(false)
                            ->suffix('CHF'),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Compte actif')
                            ->default(true),

                        Forms\Components\DateTimePicker::make('opened_at')
                            ->label('Ouvert le')
                            ->disabled()
                            ->dehydrated(false),
                    ])
                    ->columns(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('account_number')
            ->columns([
                Tables\Columns\TextColumn::make('account_number')
                    ->label('Numéro de compte')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->weight('medium'),

                Tables\Columns\TextColumn::make('iban')
                    ->label('IBAN')
                    ->searchable()
                    ->copyable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('account_type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Compte Courant' => 'primary',
                        'Compte Épargne' => 'success',
                        'Compte Professionnel' => 'warning',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('currency')
                    ->label('Devise')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('balance')
                    ->label('Solde')
                    ->money('CHF')
                    ->sortable()
                    ->color(fn ($state) => $state >= 0 ? 'success' : 'danger'),

                Tables\Columns\TextColumn::make('available_balance')
                    ->label('Disponible')
                    ->money('CHF')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Actif')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('opened_at')
                    ->label('Ouvert le')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('account_type')
                    ->label('Type de compte')
                    ->options([
                        'Compte Courant' => 'Compte Courant',
                        'Compte Épargne' => 'Compte Épargne',
                        'Compte Professionnel' => 'Compte Professionnel',
                    ]),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Statut')
                    ->placeholder('Tous')
                    ->trueLabel('Actifs uniquement')
                    ->falseLabel('Inactifs uniquement'),
            ])
            ->headerActions([
                // No create action - accounts are created via validation workflow
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // No bulk delete - accounts should be deactivated, not deleted
                ]),
            ])
            ->defaultSort('opened_at', 'desc');
    }
}
