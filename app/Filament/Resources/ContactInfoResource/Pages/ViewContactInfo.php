<?php

namespace App\Filament\Resources\ContactInfoResource\Pages;

use App\Filament\Resources\ContactInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ViewContactInfo extends ViewRecord
{
    protected static string $resource = ContactInfoResource::class;

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
                Infolists\Components\Section::make('Informations générales')
                    ->schema([
                        Infolists\Components\TextEntry::make('name')
                            ->label('Nom'),

                        Infolists\Components\TextEntry::make('type')
                            ->label('Type')
                            ->badge()
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'headquarters' => 'Siège social',
                                'general' => 'Général',
                                'support' => 'Support client',
                                'sales' => 'Commercial',
                                'technical' => 'Technique',
                                default => $state,
                            }),

                        Infolists\Components\IconEntry::make('is_active')
                            ->label('Actif')
                            ->boolean(),

                        Infolists\Components\TextEntry::make('order')
                            ->label('Ordre'),
                    ])->columns(2),

                Infolists\Components\Section::make('Coordonnées')
                    ->schema([
                        Infolists\Components\TextEntry::make('phone')
                            ->label('Téléphone')
                            ->copyable(),

                        Infolists\Components\TextEntry::make('phone_alt')
                            ->label('Téléphone alternatif')
                            ->copyable(),

                        Infolists\Components\TextEntry::make('email')
                            ->label('Email')
                            ->copyable(),

                        Infolists\Components\TextEntry::make('email_alt')
                            ->label('Email alternatif')
                            ->copyable(),

                        Infolists\Components\TextEntry::make('whatsapp')
                            ->label('WhatsApp')
                            ->copyable(),

                        Infolists\Components\TextEntry::make('fax')
                            ->label('Fax')
                            ->copyable(),
                    ])->columns(2),

                Infolists\Components\Section::make('Adresse')
                    ->schema([
                        Infolists\Components\TextEntry::make('address')
                            ->label('Adresse'),

                        Infolists\Components\TextEntry::make('city')
                            ->label('Ville'),

                        Infolists\Components\TextEntry::make('postal_code')
                            ->label('Code postal'),

                        Infolists\Components\TextEntry::make('country')
                            ->label('Pays'),
                    ])->columns(2),

                Infolists\Components\Section::make('Géolocalisation')
                    ->schema([
                        Infolists\Components\TextEntry::make('latitude')
                            ->label('Latitude'),

                        Infolists\Components\TextEntry::make('longitude')
                            ->label('Longitude'),
                    ])->columns(2)
                    ->collapsed(),

                Infolists\Components\Section::make('Horaires')
                    ->schema([
                        Infolists\Components\TextEntry::make('formatted_opening_hours')
                            ->label('Horaires d\'ouverture')
                            ->listWithLineBreaks(),
                    ])
                    ->collapsed(),

                Infolists\Components\Section::make('Description')
                    ->schema([
                        Infolists\Components\TextEntry::make('description')
                            ->label('Description')
                            ->prose()
                            ->markdown(),
                    ])
                    ->collapsed(),

                Infolists\Components\Section::make('Réseaux sociaux')
                    ->schema([
                        Infolists\Components\TextEntry::make('facebook_url')
                            ->label('Facebook')
                            ->url(),

                        Infolists\Components\TextEntry::make('linkedin_url')
                            ->label('LinkedIn')
                            ->url(),

                        Infolists\Components\TextEntry::make('twitter_url')
                            ->label('Twitter')
                            ->url(),

                        Infolists\Components\TextEntry::make('instagram_url')
                            ->label('Instagram')
                            ->url(),
                    ])->columns(2)
                    ->collapsed(),

                Infolists\Components\Section::make('Dates')
                    ->schema([
                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Créé le')
                            ->dateTime('d/m/Y H:i'),

                        Infolists\Components\TextEntry::make('updated_at')
                            ->label('Modifié le')
                            ->dateTime('d/m/Y H:i'),
                    ])->columns(2),
            ]);
    }
}
