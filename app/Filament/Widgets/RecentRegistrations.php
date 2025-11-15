<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentRegistrations extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::query()
                    ->where('validation_status', 'pending')
                    ->latest()
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('first_name')
                    ->label('Prénom')
                    ->searchable(),

                Tables\Columns\TextColumn::make('last_name')
                    ->label('Nom')
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('nationality')
                    ->label('Nationalité'),

                Tables\Columns\TextColumn::make('profession')
                    ->label('Profession'),

                Tables\Columns\BadgeColumn::make('validation_status')
                    ->label('Statut')
                    ->colors([
                        'warning' => 'pending',
                    ])
                    ->formatStateUsing(fn () => 'En attente'),
            ])
            ->heading('Inscriptions récentes en attente de validation')
            ->description('Les 10 dernières demandes d\'ouverture de compte')
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Voir')
                    ->icon('heroicon-o-eye')
                    ->url(fn (User $record): string => route('filament.admin.resources.pending-registrations.view', ['record' => $record])),
            ]);
    }
}
