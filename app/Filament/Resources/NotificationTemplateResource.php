<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NotificationTemplateResource\Pages;
use App\Models\NotificationTemplate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NotificationTemplateResource extends Resource
{
    protected static ?string $model = NotificationTemplate::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Templates Notifications';

    protected static ?string $modelLabel = 'Template';

    protected static ?string $pluralModelLabel = 'Templates';

    protected static ?string $navigationGroup = 'Communication';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations générales')
                    ->schema([
                        Forms\Components\TextInput::make('code')
                            ->label('Code unique')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->disabled(fn ($record) => $record?->is_system)
                            ->helperText('Code unique pour identifier le template (ex: transaction_approved)')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('name')
                            ->label('Nom')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->rows(2)
                            ->maxLength(500),

                        Forms\Components\Select::make('type')
                            ->label('Type')
                            ->options([
                                'email' => 'Email',
                                'sms' => 'SMS',
                                'push' => 'Push',
                                'message' => 'Message interne',
                            ])
                            ->default('email')
                            ->required(),

                        Forms\Components\Select::make('category')
                            ->label('Catégorie')
                            ->options([
                                'transaction' => 'Transaction',
                                'card' => 'Carte',
                                'security' => 'Sécurité',
                                'account' => 'Compte',
                                'message' => 'Message',
                                'general' => 'Général',
                            ])
                            ->default('general'),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Actif')
                            ->default(true),
                    ])->columns(2),

                Forms\Components\Section::make('Contenu du template')
                    ->schema([
                        Forms\Components\TextInput::make('subject')
                            ->label('Sujet (pour emails)')
                            ->maxLength(255)
                            ->helperText('Utilisez {{variable}} pour les placeholders'),

                        Forms\Components\Textarea::make('body')
                            ->label('Corps du message')
                            ->required()
                            ->rows(10)
                            ->helperText('Utilisez {{variable}} pour les placeholders')
                            ->columnSpanFull(),

                        Forms\Components\TagsInput::make('placeholders')
                            ->label('Placeholders disponibles')
                            ->helperText('Liste des variables utilisables (sans les {{ }})')
                            ->placeholder('Ex: amount, merchant, date')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Options')
                    ->schema([
                        Forms\Components\Toggle::make('is_system')
                            ->label('Template système')
                            ->disabled()
                            ->helperText('Les templates système ne peuvent pas être supprimés'),
                    ])
                    ->visible(fn ($record) => $record?->is_system),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('code')
                    ->label('Code')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->tooltip('Cliquer pour copier'),

                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'email' => 'success',
                        'sms' => 'warning',
                        'push' => 'info',
                        'message' => 'primary',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'email' => 'Email',
                        'sms' => 'SMS',
                        'push' => 'Push',
                        'message' => 'Message interne',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('category')
                    ->label('Catégorie')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'transaction' => 'Transaction',
                        'card' => 'Carte',
                        'security' => 'Sécurité',
                        'account' => 'Compte',
                        'message' => 'Message',
                        'general' => 'Général',
                        default => $state ?? 'N/A',
                    }),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Actif')
                    ->boolean(),

                Tables\Columns\IconColumn::make('is_system')
                    ->label('Système')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Modifié le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Type')
                    ->options([
                        'email' => 'Email',
                        'sms' => 'SMS',
                        'push' => 'Push',
                        'message' => 'Message interne',
                    ]),

                Tables\Filters\SelectFilter::make('category')
                    ->label('Catégorie')
                    ->options([
                        'transaction' => 'Transaction',
                        'card' => 'Carte',
                        'security' => 'Sécurité',
                        'account' => 'Compte',
                        'message' => 'Message',
                        'general' => 'Général',
                    ]),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Actif')
                    ->boolean(),

                Tables\Filters\TernaryFilter::make('is_system')
                    ->label('Système')
                    ->boolean(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn (NotificationTemplate $record) => !$record->is_system),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->action(function ($records) {
                            // Only delete non-system templates
                            $records->filter(fn ($record) => !$record->is_system)->each->delete();
                        }),
                ]),
            ])
            ->defaultSort('name');
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
            'index' => Pages\ListNotificationTemplates::route('/'),
            'create' => Pages\CreateNotificationTemplate::route('/create'),
            'view' => Pages\ViewNotificationTemplate::route('/{record}'),
            'edit' => Pages\EditNotificationTemplate::route('/{record}/edit'),
        ];
    }
}
