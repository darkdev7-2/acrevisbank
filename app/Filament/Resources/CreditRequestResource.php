<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CreditRequestResource\Pages;
use App\Models\CreditRequest;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Notifications\Notification;

class CreditRequestResource extends Resource
{
    protected static ?string $model = CreditRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = 'Opérations Bancaires';

    protected static ?string $navigationLabel = 'Demandes de Crédit';
    protected static ?string $modelLabel = 'Demande de Crédit';
    protected static ?string $pluralModelLabel = 'Demandes de Crédit';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations du Demandeur')
                    ->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->label('Prénom')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('last_name')
                            ->label('Nom')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('phone')
                            ->label('Téléphone')
                            ->tel()
                            ->required()
                            ->maxLength(50),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Détails du Crédit')
                    ->schema([
                        Forms\Components\TextInput::make('amount')
                            ->label('Montant')
                            ->required()
                            ->numeric()
                            ->prefix('CHF')
                            ->minValue(1000)
                            ->maxValue(1000000),

                        Forms\Components\Select::make('currency')
                            ->label('Devise')
                            ->options([
                                'CHF' => 'CHF - Franc Suisse',
                                'EUR' => 'EUR - Euro',
                                'USD' => 'USD - Dollar',
                            ])
                            ->default('CHF')
                            ->required(),

                        Forms\Components\TextInput::make('duration_months')
                            ->label('Durée (mois)')
                            ->required()
                            ->numeric()
                            ->suffix('mois')
                            ->minValue(12)
                            ->maxValue(360),

                        Forms\Components\Textarea::make('purpose')
                            ->label('Objet du crédit')
                            ->required()
                            ->maxLength(1000)
                            ->rows(4)
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('has_other_credit')
                            ->label('A d\'autres crédits en cours')
                            ->reactive(),

                        Forms\Components\Textarea::make('other_credit_details')
                            ->label('Détails des autres crédits')
                            ->maxLength(500)
                            ->rows(3)
                            ->visible(fn (callable $get) => $get('has_other_credit'))
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Gestion de la Demande')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Statut')
                            ->options([
                                'pending' => 'En attente',
                                'in_review' => 'En révision',
                                'approved' => 'Approuvé',
                                'rejected' => 'Rejeté',
                            ])
                            ->default('pending')
                            ->required(),

                        Forms\Components\Select::make('reviewed_by')
                            ->label('Assigné à')
                            ->options(User::where('is_active', true)->pluck('email', 'id'))
                            ->searchable()
                            ->preload(),

                        Forms\Components\DatePicker::make('reviewed_at')
                            ->label('Date de révision')
                            ->displayFormat('d/m/Y'),

                        Forms\Components\Textarea::make('review_notes')
                            ->label('Notes internes')
                            ->helperText('Ces notes sont visibles uniquement par les administrateurs')
                            ->maxLength(2000)
                            ->rows(5)
                            ->columnSpanFull(),
                    ])
                    ->columns(3)
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->label('Prénom')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('last_name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->icon('heroicon-m-envelope')
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Téléphone')
                    ->icon('heroicon-m-phone')
                    ->searchable(),

                Tables\Columns\TextColumn::make('amount')
                    ->label('Montant')
                    ->money('CHF')
                    ->sortable(),

                Tables\Columns\TextColumn::make('duration_months')
                    ->label('Durée')
                    ->suffix(' mois')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Statut')
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'in_review',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'En attente',
                        'in_review' => 'En révision',
                        'approved' => 'Approuvé',
                        'rejected' => 'Rejeté',
                        default => $state,
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('reviewer.email')
                    ->label('Assigné à')
                    ->searchable()
                    ->toggleable()
                    ->placeholder('Non assigné'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Statut')
                    ->options([
                        'pending' => 'En attente',
                        'in_review' => 'En révision',
                        'approved' => 'Approuvé',
                        'rejected' => 'Rejeté',
                    ]),

                Tables\Filters\SelectFilter::make('reviewed_by')
                    ->label('Assigné à')
                    ->relationship('reviewer', 'email')
                    ->searchable()
                    ->preload(),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Du'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Au'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),

                Tables\Actions\Action::make('approve')
                    ->label('Approuver')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => $record->status !== 'approved')
                    ->requiresConfirmation()
                    ->modalHeading('Approuver la demande de crédit')
                    ->modalDescription('Êtes-vous sûr de vouloir approuver cette demande?')
                    ->action(function (CreditRequest $record) {
                        $record->update([
                            'status' => 'approved',
                            'reviewed_by' => auth()->id(),
                            'reviewed_at' => now(),
                        ]);

                        Notification::make()
                            ->title('Demande approuvée')
                            ->success()
                            ->send();
                    }),

                Tables\Actions\Action::make('reject')
                    ->label('Rejeter')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn ($record) => $record->status !== 'rejected')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Textarea::make('review_notes')
                            ->label('Raison du rejet')
                            ->required()
                            ->maxLength(2000),
                    ])
                    ->action(function (CreditRequest $record, array $data) {
                        $record->update([
                            'status' => 'rejected',
                            'reviewed_by' => auth()->id(),
                            'reviewed_at' => now(),
                            'review_notes' => $data['review_notes'],
                        ]);

                        Notification::make()
                            ->title('Demande rejetée')
                            ->danger()
                            ->send();
                    }),

                Tables\Actions\Action::make('assign')
                    ->label('Assigner')
                    ->icon('heroicon-o-user-plus')
                    ->color('info')
                    ->form([
                        Forms\Components\Select::make('reviewed_by')
                            ->label('Assigner à')
                            ->options(User::where('is_active', true)->pluck('email', 'id'))
                            ->required()
                            ->searchable()
                            ->preload(),
                    ])
                    ->action(function (CreditRequest $record, array $data) {
                        $record->update([
                            'reviewed_by' => $data['reviewed_by'],
                            'status' => 'in_review',
                        ]);

                        Notification::make()
                            ->title('Demande assignée')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),

                    Tables\Actions\BulkAction::make('approve_selected')
                        ->label('Approuver')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            $records->each(fn ($record) => $record->update([
                                'status' => 'approved',
                                'reviewed_by' => auth()->id(),
                                'reviewed_at' => now(),
                            ]));

                            Notification::make()
                                ->title(count($records) . ' demande(s) approuvée(s)')
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\BulkAction::make('reject_selected')
                        ->label('Rejeter')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            $records->each(fn ($record) => $record->update([
                                'status' => 'rejected',
                                'reviewed_by' => auth()->id(),
                                'reviewed_at' => now(),
                            ]));

                            Notification::make()
                                ->title(count($records) . ' demande(s) rejetée(s)')
                                ->danger()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),
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
            'index' => Pages\ListCreditRequests::route('/'),
            'create' => Pages\CreateCreditRequest::route('/create'),
            'view' => Pages\ViewCreditRequest::route('/{record}'),
            'edit' => Pages\EditCreditRequest::route('/{record}/edit'),
        ];
    }
}
