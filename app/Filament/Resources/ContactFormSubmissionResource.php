<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactFormSubmissionResource\Pages;
use App\Filament\Resources\ContactFormSubmissionResource\RelationManagers;
use App\Models\ContactFormSubmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactFormSubmissionResource extends Resource
{
    protected static ?string $model = ContactFormSubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationGroup = 'Communication';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Messages de Contact';
    protected static ?string $modelLabel = 'Message';
    protected static ?string $pluralModelLabel = 'Messages de Contact';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'new')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        $count = static::getModel()::where('status', 'new')->count();
        return $count > 5 ? 'danger' : ($count > 0 ? 'warning' : null);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations du contact')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nom')
                            ->disabled(),

                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->disabled(),

                        Forms\Components\TextInput::make('phone')
                            ->label('Téléphone')
                            ->disabled(),

                        Forms\Components\TextInput::make('subject')
                            ->label('Sujet')
                            ->disabled()
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('message')
                            ->label('Message')
                            ->disabled()
                            ->rows(5)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Détails de la demande')
                    ->schema([
                        Forms\Components\TextInput::make('type')
                            ->label('Type')
                            ->disabled(),

                        Forms\Components\TextInput::make('preferred_contact_method')
                            ->label('Méthode de contact préférée')
                            ->disabled(),

                        Forms\Components\DatePicker::make('preferred_date')
                            ->label('Date préférée')
                            ->disabled(),

                        Forms\Components\TextInput::make('preferred_time')
                            ->label('Heure préférée')
                            ->disabled(),

                        Forms\Components\TextInput::make('status')
                            ->label('Statut')
                            ->disabled(),

                        Forms\Components\TextInput::make('ip_address')
                            ->label('Adresse IP')
                            ->disabled(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Réponse admin')
                    ->schema([
                        Forms\Components\Textarea::make('admin_response')
                            ->label('Réponse de l\'administrateur')
                            ->rows(4)
                            ->columnSpanFull(),

                        Forms\Components\DateTimePicker::make('replied_at')
                            ->label('Répondu le')
                            ->disabled(),
                    ])
                    ->visible(fn ($record) => $record !== null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('status')
                    ->label('Statut')
                    ->icon(fn (string $state): string => match ($state) {
                        'new' => 'heroicon-o-envelope',
                        'processed' => 'heroicon-o-envelope-open',
                        default => 'heroicon-o-question-mark-circle',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'warning',
                        'processed' => 'success',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->icon('heroicon-m-envelope')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Téléphone')
                    ->icon('heroicon-m-phone')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('subject')
                    ->label('Sujet')
                    ->searchable()
                    ->sortable()
                    ->limit(40),

                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'information' => 'info',
                        'compte' => 'primary',
                        'credit' => 'warning',
                        'autre' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('preferred_contact_method')
                    ->label('Contact préféré')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Reçu le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->since()
                    ->description(fn ($record) => $record->created_at->format('d/m/Y H:i')),

                Tables\Columns\TextColumn::make('replied_at')
                    ->label('Répondu le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Statut')
                    ->options([
                        'new' => 'Nouveau',
                        'processed' => 'Traité',
                    ])
                    ->default('new'),

                Tables\Filters\SelectFilter::make('type')
                    ->label('Type')
                    ->options([
                        'information' => 'Information',
                        'compte' => 'Compte',
                        'credit' => 'Crédit',
                        'autre' => 'Autre',
                    ]),

                Tables\Filters\Filter::make('created_today')
                    ->label('Aujourd\'hui')
                    ->query(fn (Builder $query): Builder => $query->whereDate('created_at', today())),

                Tables\Filters\Filter::make('created_this_week')
                    ->label('Cette semaine')
                    ->query(fn (Builder $query): Builder => $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),

                Tables\Actions\Action::make('mark_as_read')
                    ->label('Marquer comme lu')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => $record->status === 'new')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'processed',
                            'replied_at' => now(),
                        ]);
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Marquer comme lu')
                    ->modalDescription('Confirmer que ce message a été traité ?'),

                Tables\Actions\Action::make('mark_as_unread')
                    ->label('Marquer comme non lu')
                    ->icon('heroicon-o-envelope')
                    ->color('warning')
                    ->visible(fn ($record) => $record->status === 'processed')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'new',
                            'replied_at' => null,
                        ]);
                    }),

                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('mark_all_as_read')
                        ->label('Marquer comme lus')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $record->update([
                                    'status' => 'processed',
                                    'replied_at' => now(),
                                ]);
                            }
                        })
                        ->deselectRecordsAfterCompletion(),

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

    public static function canCreate(): bool
    {
        return false; // Read-only resource - submissions come from website form
    }

    public static function canEdit($record): bool
    {
        return false; // Read-only resource
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactFormSubmissions::route('/'),
            'view' => Pages\ViewContactFormSubmission::route('/{record}'),
        ];
    }
}
