<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MessageResource\Pages;
use App\Models\Message;
use App\Models\User;
use App\Services\MessagingService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationLabel = 'Messages';

    protected static ?string $modelLabel = 'Message';

    protected static ?string $pluralModelLabel = 'Messages';

    protected static ?string $navigationGroup = 'Communication';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Destinataire')
                    ->schema([
                        Forms\Components\Select::make('recipient_id')
                            ->label('Client destinataire')
                            ->relationship('recipient', 'email')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->getSearchResultsUsing(fn (string $search) =>
                                User::where('email', 'like', "%{$search}%")
                                    ->orWhere('first_name', 'like', "%{$search}%")
                                    ->orWhere('last_name', 'like', "%{$search}%")
                                    ->limit(50)
                                    ->get()
                                    ->mapWithKeys(fn ($user) => [$user->id => "{$user->full_name} ({$user->email})"])
                            )
                            ->getOptionLabelUsing(fn ($value): ?string =>
                                User::find($value)?->full_name . ' (' . User::find($value)?->email . ')'
                            ),
                    ]),

                Forms\Components\Section::make('Contenu du message')
                    ->schema([
                        Forms\Components\TextInput::make('subject')
                            ->label('Sujet')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('body')
                            ->label('Message')
                            ->required()
                            ->rows(6)
                            ->maxLength(10000),
                    ]),

                Forms\Components\Section::make('Options')
                    ->schema([
                        Forms\Components\Select::make('type')
                            ->label('Type de message')
                            ->options([
                                'general' => 'Général',
                                'transaction' => 'Transaction',
                                'card' => 'Carte',
                                'account' => 'Compte',
                                'security' => 'Sécurité',
                                'support' => 'Support',
                            ])
                            ->default('general')
                            ->required(),

                        Forms\Components\Select::make('priority')
                            ->label('Priorité')
                            ->options([
                                'low' => 'Basse',
                                'normal' => 'Normale',
                                'high' => 'Haute',
                                'urgent' => 'Urgente',
                            ])
                            ->default('normal')
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('recipient.full_name')
                    ->label('Destinataire')
                    ->searchable(['first_name', 'last_name', 'email'])
                    ->sortable(),

                Tables\Columns\TextColumn::make('sender.full_name')
                    ->label('Expéditeur')
                    ->searchable(['first_name', 'last_name'])
                    ->sortable()
                    ->default('AcrevisBank'),

                Tables\Columns\TextColumn::make('subject')
                    ->label('Sujet')
                    ->searchable()
                    ->limit(40)
                    ->tooltip(fn ($record) => $record->subject),

                Tables\Columns\TextColumn::make('type')
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
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'general' => 'Général',
                        'transaction' => 'Transaction',
                        'card' => 'Carte',
                        'account' => 'Compte',
                        'security' => 'Sécurité',
                        'support' => 'Support',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('priority')
                    ->label('Priorité')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'urgent' => 'danger',
                        'high' => 'warning',
                        'normal' => 'info',
                        'low' => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'low' => 'Basse',
                        'normal' => 'Normale',
                        'high' => 'Haute',
                        'urgent' => 'Urgente',
                        default => $state,
                    }),

                Tables\Columns\IconColumn::make('is_read')
                    ->label('Lu')
                    ->boolean(),

                Tables\Columns\IconColumn::make('is_archived')
                    ->label('Archivé')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Envoyé le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('read_at')
                    ->label('Lu le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Type')
                    ->options([
                        'general' => 'Général',
                        'transaction' => 'Transaction',
                        'card' => 'Carte',
                        'account' => 'Compte',
                        'security' => 'Sécurité',
                        'support' => 'Support',
                    ]),

                Tables\Filters\SelectFilter::make('priority')
                    ->label('Priorité')
                    ->options([
                        'low' => 'Basse',
                        'normal' => 'Normale',
                        'high' => 'Haute',
                        'urgent' => 'Urgente',
                    ]),

                Tables\Filters\TernaryFilter::make('is_read')
                    ->label('Lu')
                    ->boolean(),

                Tables\Filters\TernaryFilter::make('is_archived')
                    ->label('Archivé')
                    ->boolean(),

                Tables\Filters\Filter::make('from_clients')
                    ->label('Messages clients')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('sender_id')),

                Tables\Filters\Filter::make('from_bank')
                    ->label('Messages banque')
                    ->query(fn (Builder $query): Builder => $query->whereNull('sender_id')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->visible(fn (Message $record) => $record->sender_id === null), // Only bank messages can be edited

                Tables\Actions\Action::make('reply')
                    ->label('Répondre')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->color('primary')
                    ->form([
                        Forms\Components\Textarea::make('reply_body')
                            ->label('Votre réponse')
                            ->required()
                            ->rows(4),
                    ])
                    ->action(function (Message $record, array $data) {
                        $service = app(MessagingService::class);
                        $service->replyToMessage($record, auth()->user(), $data['reply_body']);

                        Notification::make()
                            ->title('Réponse envoyée avec succès')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),

                    Tables\Actions\BulkAction::make('mark_as_read')
                        ->label('Marquer comme lu')
                        ->icon('heroicon-o-check')
                        ->action(fn ($records) => $records->each->markAsRead())
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\BulkAction::make('archive')
                        ->label('Archiver')
                        ->icon('heroicon-o-archive-box')
                        ->action(fn ($records) => $records->each->archive())
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
            'index' => Pages\ListMessages::route('/'),
            'create' => Pages\CreateMessage::route('/create'),
            'view' => Pages\ViewMessage::route('/{record}'),
            'edit' => Pages\EditMessage::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::whereNotNull('sender_id')->where('is_read', false)->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        $count = static::getModel()::whereNotNull('sender_id')
            ->where('is_read', false)
            ->where('priority', 'urgent')
            ->count();

        return $count > 0 ? 'danger' : 'primary';
    }
}
