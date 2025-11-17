<?php

namespace App\Filament\Resources\NotificationTemplateResource\Pages;

use App\Filament\Resources\NotificationTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ViewNotificationTemplate extends ViewRecord
{
    protected static string $resource = NotificationTemplateResource::class;

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
                Infolists\Components\Section::make('Informations')
                    ->schema([
                        Infolists\Components\TextEntry::make('name')
                            ->label('Nom'),

                        Infolists\Components\TextEntry::make('code')
                            ->label('Code')
                            ->copyable(),

                        Infolists\Components\TextEntry::make('description')
                            ->label('Description'),

                        Infolists\Components\TextEntry::make('type')
                            ->label('Type')
                            ->badge()
                            ->formatStateUsing(fn ($record) => $record->type_label),

                        Infolists\Components\TextEntry::make('category')
                            ->label('Catégorie')
                            ->formatStateUsing(fn (?string $state): string => match ($state) {
                                'transaction' => 'Transaction',
                                'card' => 'Carte',
                                'security' => 'Sécurité',
                                'account' => 'Compte',
                                'message' => 'Message',
                                'general' => 'Général',
                                default => $state ?? 'N/A',
                            }),

                        Infolists\Components\IconEntry::make('is_active')
                            ->label('Actif')
                            ->boolean(),

                        Infolists\Components\IconEntry::make('is_system')
                            ->label('Template système')
                            ->boolean(),
                    ])->columns(2),

                Infolists\Components\Section::make('Contenu')
                    ->schema([
                        Infolists\Components\TextEntry::make('subject')
                            ->label('Sujet'),

                        Infolists\Components\TextEntry::make('body')
                            ->label('Corps du message')
                            ->prose()
                            ->markdown(),

                        Infolists\Components\TextEntry::make('placeholders')
                            ->label('Placeholders disponibles')
                            ->badge()
                            ->separator(','),
                    ]),

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
