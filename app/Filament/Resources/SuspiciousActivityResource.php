<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuspiciousActivityResource\Pages;
use App\Models\SuspiciousActivity;
use App\Services\SuspiciousActivityDetectionService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;

class SuspiciousActivityResource extends Resource
{
    protected static ?string $model = SuspiciousActivity::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-exclamation';

    protected static ?string $navigationLabel = 'Activités Suspectes';

    protected static ?string $navigationGroup = 'Système';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Utilisateur')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->disabled(),
                        Forms\Components\TextInput::make('type')
                            ->label('Type')
                            ->disabled(),
                        Forms\Components\Select::make('severity')
                            ->label('Sévérité')
                            ->options([
                                'low' => 'Faible',
                                'medium' => 'Moyenne',
                                'high' => 'Élevée',
                                'critical' => 'Critique',
                            ])
                            ->disabled(),
                        Forms\Components\TextInput::make('risk_score')
                            ->label('Score de Risque')
                            ->numeric()
                            ->disabled()
                            ->suffix('/100'),
                    ])->columns(2),

                Forms\Components\Section::make('Détails Techniques')
                    ->schema([
                        Forms\Components\TextInput::make('ip_address')
                            ->label('Adresse IP')
                            ->disabled(),
                        Forms\Components\TextInput::make('location')
                            ->label('Localisation')
                            ->disabled(),
                        Forms\Components\Textarea::make('user_agent')
                            ->label('User Agent')
                            ->disabled()
                            ->rows(2),
                        Forms\Components\KeyValue::make('details')
                            ->label('Détails')
                            ->disabled(),
                    ]),

                Forms\Components\Section::make('Résolution')
                    ->schema([
                        Forms\Components\Toggle::make('is_resolved')
                            ->label('Résolu')
                            ->reactive(),
                        Forms\Components\Toggle::make('false_positive')
                            ->label('Faux Positif')
                            ->reactive(),
                        Forms\Components\Textarea::make('resolution_notes')
                            ->label('Notes de Résolution')
                            ->required()
                            ->rows(3)
                            ->visible(fn ($get) => $get('is_resolved')),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Utilisateur')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'multiple_login_failures' => 'Échecs connexion',
                        'ip_change' => 'Changement IP',
                        'unusual_time' => 'Heure inhabituelle',
                        'rapid_transactions' => 'Transactions rapides',
                        'high_value_transaction' => 'Transaction élevée',
                        default => $state,
                    })
                    ->color('info')
                    ->searchable(),
                Tables\Columns\TextColumn::make('severity')
                    ->label('Sévérité')
                    ->badge()
                    ->colors([
                        'success' => 'low',
                        'warning' => 'medium',
                        'danger' => 'high',
                        'primary' => 'critical',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'low' => 'Faible',
                        'medium' => 'Moyenne',
                        'high' => 'Élevée',
                        'critical' => 'Critique',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('risk_score')
                    ->label('Score')
                    ->sortable()
                    ->suffix('/100')
                    ->color(fn (string $state): string => match (true) {
                        $state >= 80 => 'danger',
                        $state >= 60 => 'warning',
                        default => 'success',
                    }),
                Tables\Columns\TextColumn::make('ip_address')
                    ->label('IP')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_resolved')
                    ->label('Résolu')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('false_positive')
                    ->label('Faux Positif')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('severity')
                    ->label('Sévérité')
                    ->options([
                        'low' => 'Faible',
                        'medium' => 'Moyenne',
                        'high' => 'Élevée',
                        'critical' => 'Critique',
                    ]),
                Tables\Filters\TernaryFilter::make('is_resolved')
                    ->label('Résolu')
                    ->placeholder('Tous')
                    ->trueLabel('Résolu')
                    ->falseLabel('Non résolu'),
                Tables\Filters\TernaryFilter::make('false_positive')
                    ->label('Faux Positif')
                    ->placeholder('Tous')
                    ->trueLabel('Oui')
                    ->falseLabel('Non'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('resolve')
                    ->label('Résoudre')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Textarea::make('resolution_notes')
                            ->label('Notes de résolution')
                            ->required()
                            ->rows(3),
                        Forms\Components\Toggle::make('false_positive')
                            ->label('Marquer comme faux positif'),
                    ])
                    ->action(function (SuspiciousActivity $record, array $data) {
                        $service = app(SuspiciousActivityDetectionService::class);
                        $service->resolve(
                            $record,
                            auth()->user(),
                            $data['resolution_notes'],
                            $data['false_positive'] ?? false
                        );

                        Notification::make()
                            ->title('Activité résolue')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (SuspiciousActivity $record) => !$record->is_resolved),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSuspiciousActivities::route('/'),
            'view' => Pages\ViewSuspiciousActivity::route('/{record}'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('is_resolved', false)->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        $count = static::getModel()::where('is_resolved', false)
            ->whereIn('severity', ['high', 'critical'])
            ->count();

        return $count > 0 ? 'danger' : 'warning';
    }
}
