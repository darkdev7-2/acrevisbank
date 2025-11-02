<?php

namespace App\Filament\Resources\CreditRequestResource\Pages;

use App\Filament\Resources\CreditRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\IconEntry;

class ViewCreditRequest extends ViewRecord
{
    protected static string $resource = CreditRequestResource::class;

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
                Section::make('Informations du Demandeur')
                    ->schema([
                        TextEntry::make('first_name')
                            ->label('Prénom'),
                        TextEntry::make('last_name')
                            ->label('Nom'),
                        TextEntry::make('email')
                            ->label('Email')
                            ->icon('heroicon-m-envelope')
                            ->copyable(),
                        TextEntry::make('phone')
                            ->label('Téléphone')
                            ->icon('heroicon-m-phone')
                            ->copyable(),
                        TextEntry::make('whatsapp')
                            ->label('WhatsApp')
                            ->icon('heroicon-m-chat-bubble-left-right')
                            ->copyable()
                            ->placeholder('Non fourni'),
                        TextEntry::make('gender')
                            ->label('Genre')
                            ->formatStateUsing(fn ($state) => match($state) {
                                'M' => 'Homme',
                                'F' => 'Femme',
                                'Other' => 'Autre',
                                default => $state,
                            }),
                        TextEntry::make('birth_date')
                            ->label('Date de naissance')
                            ->date('d/m/Y')
                            ->placeholder('Non fournie'),
                        TextEntry::make('nationality')
                            ->label('Nationalité')
                            ->placeholder('Non fournie'),
                        TextEntry::make('marital_status')
                            ->label('Statut matrimonial')
                            ->formatStateUsing(fn ($state) => match($state) {
                                'single' => 'Célibataire',
                                'married' => 'Marié(e)',
                                'divorced' => 'Divorcé(e)',
                                'widowed' => 'Veuf/Veuve',
                                'partnership' => 'Partenariat',
                                default => $state,
                            })
                            ->placeholder('Non fourni'),
                        TextEntry::make('profession')
                            ->label('Profession')
                            ->placeholder('Non fournie'),
                    ])
                    ->columns(3),

                Section::make('Adresse')
                    ->schema([
                        TextEntry::make('country')
                            ->label('Pays'),
                        TextEntry::make('city')
                            ->label('Ville'),
                        TextEntry::make('address')
                            ->label('Adresse complète')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Détails du Crédit')
                    ->schema([
                        TextEntry::make('amount')
                            ->label('Montant demandé')
                            ->money('CHF')
                            ->size('lg')
                            ->weight('bold')
                            ->color('success'),
                        TextEntry::make('currency')
                            ->label('Devise')
                            ->badge(),
                        TextEntry::make('duration_months')
                            ->label('Durée')
                            ->suffix(' mois')
                            ->weight('bold'),
                        TextEntry::make('purpose')
                            ->label('Objet du crédit')
                            ->columnSpanFull(),
                        IconEntry::make('has_other_credit')
                            ->label('Autres crédits en cours')
                            ->boolean(),
                        TextEntry::make('other_credit_details')
                            ->label('Détails des autres crédits')
                            ->placeholder('Aucun autre crédit')
                            ->columnSpanFull(),
                        TextEntry::make('attachment')
                            ->label('Pièce jointe')
                            ->url(fn ($state) => $state ? asset('storage/' . $state) : null)
                            ->openUrlInNewTab()
                            ->placeholder('Aucune pièce jointe'),
                    ])
                    ->columns(3),

                Section::make('Statut de la Demande')
                    ->schema([
                        TextEntry::make('status')
                            ->label('Statut')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'pending' => 'warning',
                                'in_review' => 'info',
                                'approved' => 'success',
                                'rejected' => 'danger',
                                default => 'gray',
                            })
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'pending' => 'En attente',
                                'in_review' => 'En révision',
                                'approved' => 'Approuvé',
                                'rejected' => 'Rejeté',
                                default => $state,
                            }),
                        TextEntry::make('reviewer.email')
                            ->label('Assigné à')
                            ->placeholder('Non assigné')
                            ->icon('heroicon-m-user'),
                        TextEntry::make('reviewed_at')
                            ->label('Date de révision')
                            ->dateTime('d/m/Y H:i')
                            ->placeholder('Pas encore révisé'),
                        TextEntry::make('review_notes')
                            ->label('Notes internes')
                            ->placeholder('Aucune note')
                            ->columnSpanFull(),
                    ])
                    ->columns(3),

                Section::make('Informations Système')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Créé le')
                            ->dateTime('d/m/Y H:i:s'),
                        TextEntry::make('updated_at')
                            ->label('Modifié le')
                            ->dateTime('d/m/Y H:i:s'),
                    ])
                    ->columns(2)
                    ->collapsed(),
            ]);
    }
}
