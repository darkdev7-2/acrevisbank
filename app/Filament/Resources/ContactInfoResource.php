<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactInfoResource\Pages;
use App\Models\ContactInfo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactInfoResource extends Resource
{
    protected static ?string $model = ContactInfo::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone';

    protected static ?string $navigationLabel = 'Coordonnées';

    protected static ?string $modelLabel = 'Coordonnée';

    protected static ?string $pluralModelLabel = 'Coordonnées';

    protected static ?string $navigationGroup = 'Gestion Banque';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations générales')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nom')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Ex: Siège Social, Service Client, Support Technique'),

                        Forms\Components\Select::make('type')
                            ->label('Type')
                            ->options([
                                'headquarters' => 'Siège social',
                                'general' => 'Général',
                                'support' => 'Support client',
                                'sales' => 'Commercial',
                                'technical' => 'Technique',
                            ])
                            ->default('general')
                            ->required(),

                        Forms\Components\TextInput::make('order')
                            ->label('Ordre d\'affichage')
                            ->numeric()
                            ->default(0)
                            ->required(),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Actif')
                            ->default(true),
                    ])->columns(2),

                Forms\Components\Section::make('Coordonnées téléphoniques')
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                            ->label('Téléphone principal')
                            ->tel()
                            ->maxLength(255)
                            ->placeholder('+41 71 227 27 27'),

                        Forms\Components\TextInput::make('phone_alt')
                            ->label('Téléphone alternatif')
                            ->tel()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('whatsapp')
                            ->label('WhatsApp')
                            ->tel()
                            ->maxLength(255)
                            ->placeholder('+41 79 123 45 67')
                            ->helperText('Numéro WhatsApp pour le widget flottant'),

                        Forms\Components\TextInput::make('fax')
                            ->label('Fax')
                            ->tel()
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Coordonnées email')
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->label('Email principal')
                            ->email()
                            ->maxLength(255)
                            ->placeholder('info@acrevis.ch'),

                        Forms\Components\TextInput::make('email_alt')
                            ->label('Email alternatif')
                            ->email()
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Adresse')
                    ->schema([
                        Forms\Components\TextInput::make('address->fr')
                            ->label('Adresse (FR)')
                            ->maxLength(255)
                            ->placeholder('Marktplatz 1'),

                        Forms\Components\TextInput::make('address->de')
                            ->label('Adresse (DE)')
                            ->maxLength(255)
                            ->placeholder('Marktplatz 1'),

                        Forms\Components\TextInput::make('address->en')
                            ->label('Adresse (EN)')
                            ->maxLength(255)
                            ->placeholder('Marktplatz 1'),

                        Forms\Components\TextInput::make('address->es')
                            ->label('Adresse (ES)')
                            ->maxLength(255)
                            ->placeholder('Marktplatz 1'),

                        Forms\Components\TextInput::make('city')
                            ->label('Ville')
                            ->maxLength(255)
                            ->placeholder('St. Gallen'),

                        Forms\Components\TextInput::make('postal_code')
                            ->label('Code postal')
                            ->maxLength(255)
                            ->placeholder('9004'),

                        Forms\Components\TextInput::make('country')
                            ->label('Pays')
                            ->default('Switzerland')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('latitude')
                            ->label('Latitude')
                            ->numeric()
                            ->placeholder('47.4239'),

                        Forms\Components\TextInput::make('longitude')
                            ->label('Longitude')
                            ->numeric()
                            ->placeholder('9.3748'),
                    ])->columns(3),

                Forms\Components\Section::make('Horaires d\'ouverture')
                    ->schema([
                        Forms\Components\KeyValue::make('opening_hours')
                            ->label('Horaires par jour')
                            ->keyLabel('Jour')
                            ->valueLabel('Horaires')
                            ->helperText('Ex: monday => 08:00 - 17:00')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Description')
                    ->schema([
                        Forms\Components\Textarea::make('description->fr')
                            ->label('Description (FR)')
                            ->rows(3)
                            ->maxLength(1000),

                        Forms\Components\Textarea::make('description->de')
                            ->label('Description (DE)')
                            ->rows(3)
                            ->maxLength(1000),

                        Forms\Components\Textarea::make('description->en')
                            ->label('Description (EN)')
                            ->rows(3)
                            ->maxLength(1000),

                        Forms\Components\Textarea::make('description->es')
                            ->label('Description (ES)')
                            ->rows(3)
                            ->maxLength(1000),
                    ])->columns(2),

                Forms\Components\Section::make('Réseaux sociaux')
                    ->schema([
                        Forms\Components\TextInput::make('facebook_url')
                            ->label('Facebook')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://facebook.com/acrevisbank'),

                        Forms\Components\TextInput::make('linkedin_url')
                            ->label('LinkedIn')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://linkedin.com/company/acrevisbank'),

                        Forms\Components\TextInput::make('twitter_url')
                            ->label('Twitter/X')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://twitter.com/acrevisbank'),

                        Forms\Components\TextInput::make('instagram_url')
                            ->label('Instagram')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://instagram.com/acrevisbank'),
                    ])->columns(2),
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

                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'headquarters' => 'danger',
                        'support' => 'success',
                        'sales' => 'warning',
                        'technical' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'headquarters' => 'Siège',
                        'general' => 'Général',
                        'support' => 'Support',
                        'sales' => 'Commercial',
                        'technical' => 'Technique',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Téléphone')
                    ->searchable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('city')
                    ->label('Ville')
                    ->searchable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Actif')
                    ->boolean(),

                Tables\Columns\TextColumn::make('order')
                    ->label('Ordre')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Type')
                    ->options([
                        'headquarters' => 'Siège social',
                        'general' => 'Général',
                        'support' => 'Support client',
                        'sales' => 'Commercial',
                        'technical' => 'Technique',
                    ]),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Actif')
                    ->boolean(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order');
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
            'index' => Pages\ListContactInfos::route('/'),
            'create' => Pages\CreateContactInfo::route('/create'),
            'view' => Pages\ViewContactInfo::route('/{record}'),
            'edit' => Pages\EditContactInfo::route('/{record}/edit'),
        ];
    }
}
