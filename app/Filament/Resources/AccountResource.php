<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccountResource\Pages;
use App\Filament\Resources\AccountResource\RelationManagers;
use App\Models\Account;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Support\Colors\Color;

class AccountResource extends Resource
{
    protected static ?string $model = Account::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationGroup = 'Gestion Clients';

    protected static ?string $navigationLabel = 'Comptes Bancaires';

    protected static ?string $modelLabel = 'Compte Bancaire';

    protected static ?string $pluralModelLabel = 'Comptes Bancaires';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations du Compte')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Client')
                            ->relationship('user', 'email')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('account_number')
                            ->label('Numéro de Compte')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(20)
                            ->default(fn () => 'ACC-' . strtoupper(substr(uniqid(), -10)))
                            ->disabled()
                            ->dehydrated(),

                        Forms\Components\TextInput::make('iban')
                            ->label('IBAN')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(34)
                            ->placeholder('CH93 0000 0000 0000 0000 0')
                            ->helperText('Format: CH93 suivi de 19 chiffres'),

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
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Soldes')
                    ->schema([
                        Forms\Components\TextInput::make('balance')
                            ->label('Solde')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->prefix('CHF')
                            ->step(0.01)
                            ->minValue(0),

                        Forms\Components\TextInput::make('available_balance')
                            ->label('Solde Disponible')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->prefix('CHF')
                            ->step(0.01)
                            ->minValue(0),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Statut')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Compte Actif')
                            ->default(true)
                            ->inline(false),

                        Forms\Components\DateTimePicker::make('opened_at')
                            ->label('Date d\'Ouverture')
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
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Client')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('account_number')
                    ->label('N° Compte')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Numéro de compte copié')
                    ->copyMessageDuration(1500),

                Tables\Columns\TextColumn::make('iban')
                    ->label('IBAN')
                    ->formatStateUsing(fn (string $state): string => chunk_split($state, 4, ' '))
                    ->searchable()
                    ->copyable()
                    ->copyMessage('IBAN copié'),

                Tables\Columns\TextColumn::make('account_type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Compte Courant' => 'info',
                        'Compte Épargne' => 'success',
                        'Compte Joint' => 'warning',
                        'Compte Entreprise' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('balance')
                    ->label('Solde')
                    ->money('CHF', locale: 'fr_CH')
                    ->sortable(),

                Tables\Columns\TextColumn::make('currency')
                    ->label('Devise')
                    ->badge(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Actif')
                    ->boolean(),

                Tables\Columns\TextColumn::make('opened_at')
                    ->label('Ouvert le')
                    ->dateTime('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('account_type')
                    ->label('Type de Compte')
                    ->options([
                        'Compte Courant' => 'Compte Courant',
                        'Compte Épargne' => 'Compte Épargne',
                        'Compte Joint' => 'Compte Joint',
                        'Compte Entreprise' => 'Compte Entreprise',
                    ]),

                Tables\Filters\SelectFilter::make('currency')
                    ->label('Devise')
                    ->options([
                        'CHF' => 'CHF',
                        'EUR' => 'EUR',
                        'USD' => 'USD',
                        'GBP' => 'GBP',
                    ]),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Compte Actif')
                    ->placeholder('Tous les comptes')
                    ->trueLabel('Actifs uniquement')
                    ->falseLabel('Inactifs uniquement'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListAccounts::route('/'),
            'create' => Pages\CreateAccount::route('/create'),
            'edit' => Pages\EditAccount::route('/{record}/edit'),
        ];
    }
}
