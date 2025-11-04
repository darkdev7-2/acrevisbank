<?php

namespace App\Filament\Widgets;

use App\Models\CreditRequest;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestCreditRequests extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Dernières demandes de crédit')
            ->query(
                CreditRequest::query()
                    ->where('status', 'pending')
                    ->latest()
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('reference_number')
                    ->label('Référence')
                    ->searchable()
                    ->copyable()
                    ->weight('medium'),

                Tables\Columns\TextColumn::make('first_name')
                    ->label('Prénom')
                    ->searchable(),

                Tables\Columns\TextColumn::make('last_name')
                    ->label('Nom')
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->icon('heroicon-m-envelope')
                    ->searchable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('amount')
                    ->label('Montant')
                    ->money('CHF')
                    ->sortable()
                    ->weight('bold')
                    ->color('primary'),

                Tables\Columns\TextColumn::make('duration_months')
                    ->label('Durée')
                    ->suffix(' mois')
                    ->sortable(),

                Tables\Columns\TextColumn::make('purpose')
                    ->label('Objet')
                    ->limit(30)
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Statut')
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'En attente',
                        'approved' => 'Approuvé',
                        'rejected' => 'Rejeté',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Déposé le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->since(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Voir')
                    ->icon('heroicon-m-eye')
                    ->url(fn (CreditRequest $record): string => route('filament.admin.resources.credit-requests.view', $record)),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
