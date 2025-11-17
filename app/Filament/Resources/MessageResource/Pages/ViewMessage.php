<?php

namespace App\Filament\Resources\MessageResource\Pages;

use App\Filament\Resources\MessageResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ViewMessage extends ViewRecord
{
    protected static string $resource = MessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->visible(fn () => $this->record->sender_id === null),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Informations du message')
                    ->schema([
                        Infolists\Components\TextEntry::make('sender.full_name')
                            ->label('Expéditeur')
                            ->default('AcrevisBank (Système)'),

                        Infolists\Components\TextEntry::make('recipient.full_name')
                            ->label('Destinataire'),

                        Infolists\Components\TextEntry::make('recipient.email')
                            ->label('Email destinataire')
                            ->copyable(),

                        Infolists\Components\TextEntry::make('subject')
                            ->label('Sujet'),

                        Infolists\Components\TextEntry::make('type')
                            ->label('Type')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'security' => 'danger',
                                'transaction' => 'success',
                                'card' => 'info',
                                'account' => 'warning',
                                'support' => 'primary',
                                default => 'gray',
                            })
                            ->formatStateUsing(fn ($record) => $record->type_label),

                        Infolists\Components\TextEntry::make('priority')
                            ->label('Priorité')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'urgent' => 'danger',
                                'high' => 'warning',
                                'normal' => 'info',
                                'low' => 'gray',
                                default => 'gray',
                            })
                            ->formatStateUsing(fn ($record) => $record->priority_label),
                    ])->columns(2),

                Infolists\Components\Section::make('Contenu')
                    ->schema([
                        Infolists\Components\TextEntry::make('body')
                            ->label('Message')
                            ->prose()
                            ->markdown(),
                    ]),

                Infolists\Components\Section::make('Statut')
                    ->schema([
                        Infolists\Components\IconEntry::make('is_read')
                            ->label('Lu')
                            ->boolean(),

                        Infolists\Components\TextEntry::make('read_at')
                            ->label('Lu le')
                            ->dateTime('d/m/Y H:i'),

                        Infolists\Components\IconEntry::make('is_archived')
                            ->label('Archivé')
                            ->boolean(),

                        Infolists\Components\TextEntry::make('archived_at')
                            ->label('Archivé le')
                            ->dateTime('d/m/Y H:i'),

                        Infolists\Components\TextEntry::make('created_at')
                            ->label('Créé le')
                            ->dateTime('d/m/Y H:i'),

                        Infolists\Components\TextEntry::make('updated_at')
                            ->label('Modifié le')
                            ->dateTime('d/m/Y H:i'),
                    ])->columns(2),

                Infolists\Components\Section::make('Réponses')
                    ->schema([
                        Infolists\Components\RepeatableEntry::make('replies')
                            ->label('')
                            ->schema([
                                Infolists\Components\TextEntry::make('sender.full_name')
                                    ->label('De')
                                    ->default('AcrevisBank'),

                                Infolists\Components\TextEntry::make('body')
                                    ->label('Message'),

                                Infolists\Components\TextEntry::make('created_at')
                                    ->label('Date')
                                    ->dateTime('d/m/Y H:i'),
                            ])
                            ->columns(3),
                    ])
                    ->visible(fn ($record) => $record->replies->isNotEmpty()),
            ]);
    }
}
