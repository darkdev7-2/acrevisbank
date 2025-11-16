<?php

namespace App\Filament\Resources\CardResource\Pages;

use App\Filament\Resources\CardResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ViewCard extends ViewRecord
{
    protected static string $resource = CardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Informations de la carte')
                    ->schema([
                        Infolists\Components\TextEntry::make('account.account_number')
                            ->label('N° de compte'),

                        Infolists\Components\TextEntry::make('account.user.full_name')
                            ->label('Titulaire du compte'),

                        Infolists\Components\TextEntry::make('formatted_card_number')
                            ->label('Numéro de carte')
                            ->copyable(),

                        Infolists\Components\TextEntry::make('cvv')
                            ->label('CVV')
                            ->visible(fn () => auth()->user()->hasRole('Admin')),

                        Infolists\Components\TextEntry::make('expiry_date')
                            ->label('Date d\'expiration'),

                        Infolists\Components\TextEntry::make('cardholder_name')
                            ->label('Nom sur la carte'),

                        Infolists\Components\TextEntry::make('card_type')
                            ->label('Type de carte')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'Visa' => 'info',
                                'Mastercard' => 'warning',
                                default => 'gray',
                            }),

                        Infolists\Components\TextEntry::make('status')
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

                        Infolists\Components\IconEntry::make('is_virtual')
                            ->label('Carte virtuelle')
                            ->boolean(),
                    ])->columns(2),

                Infolists\Components\Section::make('Limites et dépenses')
                    ->schema([
                        Infolists\Components\TextEntry::make('daily_limit')
                            ->label('Limite journalière')
                            ->money('CHF'),

                        Infolists\Components\TextEntry::make('daily_spent')
                            ->label('Dépensé aujourd\'hui')
                            ->money('CHF'),

                        Infolists\Components\TextEntry::make('monthly_limit')
                            ->label('Limite mensuelle')
                            ->money('CHF'),

                        Infolists\Components\TextEntry::make('monthly_spent')
                            ->label('Dépensé ce mois')
                            ->money('CHF'),
                    ])->columns(2),

                Infolists\Components\Section::make('Informations complémentaires')
                    ->schema([
                        Infolists\Components\TextEntry::make('activated_at')
                            ->label('Date d\'activation')
                            ->dateTime('d/m/Y H:i'),

                        Infolists\Components\TextEntry::make('blocked_at')
                            ->label('Date de blocage')
                            ->dateTime('d/m/Y H:i')
                            ->visible(fn ($record) => $record->status === 'blocked'),

                        Infolists\Components\TextEntry::make('blocked_reason')
                            ->label('Raison du blocage')
                            ->visible(fn ($record) => $record->status === 'blocked'),

                        Infolists\Components\TextEntry::make('last_used_at')
                            ->label('Dernière utilisation')
                            ->dateTime('d/m/Y H:i'),

                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Créée le')
                            ->dateTime('d/m/Y H:i'),

                        Infolists\Components\TextEntry::make('updated_at')
                            ->label('Modifiée le')
                            ->dateTime('d/m/Y H:i'),
                    ])->columns(2),
            ]);
    }
}
