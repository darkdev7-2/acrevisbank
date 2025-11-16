<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CardResource\Pages;
use App\Filament\Resources\CardResource\RelationManagers;
use App\Models\Card;
use App\Services\CardService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;

class CardResource extends Resource
{
    protected static ?string $model = Card::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationLabel = 'Cartes Bancaires';

    protected static ?string $modelLabel = 'Carte';

    protected static ?string $pluralModelLabel = 'Cartes';

    protected static ?string $navigationGroup = 'Gestion Bancaire';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations du compte')
                    ->schema([
                        Forms\Components\Select::make('account_id')
                            ->label('Compte bancaire')
                            ->relationship('account', 'account_number')
                            ->required()
                            ->searchable()
                            ->preload(),
                    ]),

                Forms\Components\Section::make('Informations de la carte')
                    ->schema([
                        Forms\Components\TextInput::make('cardholder_name')
                            ->label('Nom du titulaire')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Select::make('card_type')
                            ->label('Type de carte')
                            ->options([
                                'Visa' => 'Visa',
                                'Mastercard' => 'Mastercard',
                            ])
                            ->required()
                            ->default('Visa'),

                        Forms\Components\Select::make('status')
                            ->label('Statut')
                            ->options([
                                'pending' => 'En attente',
                                'active' => 'Active',
                                'blocked' => 'Bloquée',
                                'expired' => 'Expirée',
                                'cancelled' => 'Annulée',
                            ])
                            ->required()
                            ->default('pending'),

                        Forms\Components\Toggle::make('is_virtual')
                            ->label('Carte virtuelle')
                            ->default(true),
                    ])->columns(2),

                Forms\Components\Section::make('Limites')
                    ->schema([
                        Forms\Components\TextInput::make('daily_limit')
                            ->label('Limite journalière (CHF)')
                            ->numeric()
                            ->default(5000.00)
                            ->required()
                            ->suffix('CHF'),

                        Forms\Components\TextInput::make('monthly_limit')
                            ->label('Limite mensuelle (CHF)')
                            ->numeric()
                            ->default(50000.00)
                            ->required()
                            ->suffix('CHF'),
                    ])->columns(2),

                Forms\Components\Section::make('Détails supplémentaires')
                    ->schema([
                        Forms\Components\Textarea::make('blocked_reason')
                            ->label('Raison du blocage')
                            ->maxLength(500)
                            ->visible(fn (Forms\Get $get) => $get('status') === 'blocked'),
                    ])
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('account.account_number')
                    ->label('N° de compte')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('account.user.full_name')
                    ->label('Client')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('masked_card_number')
                    ->label('N° de carte')
                    ->copyable()
                    ->copyMessage('Numéro masqué copié')
                    ->copyMessageDuration(1500),

                Tables\Columns\TextColumn::make('card_type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Visa' => 'info',
                        'Mastercard' => 'warning',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'pending' => 'warning',
                        'blocked' => 'danger',
                        'expired' => 'gray',
                        'cancelled' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'En attente',
                        'active' => 'Active',
                        'blocked' => 'Bloquée',
                        'expired' => 'Expirée',
                        'cancelled' => 'Annulée',
                        default => $state,
                    }),

                Tables\Columns\IconColumn::make('is_virtual')
                    ->label('Virtuelle')
                    ->boolean(),

                Tables\Columns\TextColumn::make('expiry_date')
                    ->label('Expiration')
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->orderBy('expiry_year', $direction)
                            ->orderBy('expiry_month', $direction);
                    }),

                Tables\Columns\TextColumn::make('daily_spent')
                    ->label('Dépensé (jour)')
                    ->money('CHF')
                    ->sortable(),

                Tables\Columns\TextColumn::make('monthly_spent')
                    ->label('Dépensé (mois)')
                    ->money('CHF')
                    ->sortable(),

                Tables\Columns\TextColumn::make('last_used_at')
                    ->label('Dernière utilisation')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créée le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Statut')
                    ->options([
                        'pending' => 'En attente',
                        'active' => 'Active',
                        'blocked' => 'Bloquée',
                        'expired' => 'Expirée',
                        'cancelled' => 'Annulée',
                    ]),

                Tables\Filters\SelectFilter::make('card_type')
                    ->label('Type')
                    ->options([
                        'Visa' => 'Visa',
                        'Mastercard' => 'Mastercard',
                    ]),

                Tables\Filters\TernaryFilter::make('is_virtual')
                    ->label('Carte virtuelle')
                    ->boolean(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),

                Tables\Actions\Action::make('activate')
                    ->label('Activer')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Card $record) => $record->status === 'pending')
                    ->requiresConfirmation()
                    ->action(function (Card $record) {
                        $service = app(CardService::class);
                        if ($service->activateCard($record, auth()->user())) {
                            Notification::make()
                                ->title('Carte activée avec succès')
                                ->success()
                                ->send();
                        } else {
                            Notification::make()
                                ->title('Impossible d\'activer la carte')
                                ->danger()
                                ->send();
                        }
                    }),

                Tables\Actions\Action::make('block')
                    ->label('Bloquer')
                    ->icon('heroicon-o-lock-closed')
                    ->color('danger')
                    ->visible(fn (Card $record) => $record->status === 'active')
                    ->form([
                        Forms\Components\Textarea::make('reason')
                            ->label('Raison du blocage')
                            ->required()
                            ->maxLength(500),
                    ])
                    ->action(function (Card $record, array $data) {
                        $service = app(CardService::class);
                        if ($service->blockCard($record, $data['reason'], auth()->user())) {
                            Notification::make()
                                ->title('Carte bloquée avec succès')
                                ->success()
                                ->send();
                        }
                    }),

                Tables\Actions\Action::make('unblock')
                    ->label('Débloquer')
                    ->icon('heroicon-o-lock-open')
                    ->color('success')
                    ->visible(fn (Card $record) => $record->status === 'blocked')
                    ->requiresConfirmation()
                    ->action(function (Card $record) {
                        $service = app(CardService::class);
                        if ($service->unblockCard($record, auth()->user())) {
                            Notification::make()
                                ->title('Carte débloquée avec succès')
                                ->success()
                                ->send();
                        }
                    }),

                Tables\Actions\Action::make('renew')
                    ->label('Renouveler')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')
                    ->visible(fn (Card $record) => in_array($record->status, ['active', 'expired']))
                    ->requiresConfirmation()
                    ->modalDescription('Une nouvelle carte sera créée et l\'ancienne sera annulée.')
                    ->action(function (Card $record) {
                        $service = app(CardService::class);
                        $newCard = $service->renewCard($record);

                        Notification::make()
                            ->title('Carte renouvelée avec succès')
                            ->body('Nouvelle carte créée avec le numéro ' . $newCard->masked_card_number)
                            ->success()
                            ->send();
                    }),
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
            RelationManagers\TransactionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCards::route('/'),
            'create' => Pages\CreateCard::route('/create'),
            'view' => Pages\ViewCard::route('/{record}'),
            'edit' => Pages\EditCard::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }
}
