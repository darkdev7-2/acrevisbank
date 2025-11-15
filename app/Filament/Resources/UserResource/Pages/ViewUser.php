<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\IconEntry;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

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
                Section::make('Informations Personnelles')
                    ->schema([
                        TextEntry::make('first_name')
                            ->label('Prénom'),
                        TextEntry::make('last_name')
                            ->label('Nom'),
                        TextEntry::make('email')
                            ->label('Email')
                            ->icon('heroicon-m-envelope'),
                        TextEntry::make('birth_date')
                            ->label('Date de naissance')
                            ->date('d/m/Y'),
                        TextEntry::make('account_type')
                            ->label('Type de compte')
                            ->badge()
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'individual' => 'Particulier',
                                'business' => 'Entreprise',
                                default => $state,
                            }),
                        TextEntry::make('customer_segment')
                            ->label('Segment')
                            ->badge()
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'privat' => 'Privé',
                                'business' => 'Entreprise',
                                default => $state,
                            }),
                    ])
                    ->columns(2),

                Section::make('Coordonnées')
                    ->schema([
                        TextEntry::make('phone')
                            ->label('Téléphone')
                            ->icon('heroicon-m-phone'),
                        TextEntry::make('whatsapp')
                            ->label('WhatsApp')
                            ->icon('heroicon-m-chat-bubble-left-right'),
                        TextEntry::make('country')
                            ->label('Pays'),
                        TextEntry::make('city')
                            ->label('Ville'),
                        TextEntry::make('address')
                            ->label('Adresse')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Préférences')
                    ->schema([
                        TextEntry::make('preferred_language')
                            ->label('Langue préférée')
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'fr' => 'Français',
                                'de' => 'Allemand',
                                'en' => 'Anglais',
                                'es' => 'Espagnol',
                                default => $state,
                            }),
                        IconEntry::make('is_active')
                            ->label('Compte actif')
                            ->boolean(),
                    ])
                    ->columns(2),

                Section::make('Informations Système')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Créé le')
                            ->dateTime('d/m/Y H:i'),
                        TextEntry::make('last_login_at')
                            ->label('Dernière connexion')
                            ->dateTime('d/m/Y H:i')
                            ->placeholder('Jamais connecté'),
                    ])
                    ->columns(2),
            ]);
    }
}
