<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeneficiaryResource\Pages;
use App\Filament\Resources\BeneficiaryResource\RelationManagers;
use App\Models\Beneficiary;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BeneficiaryResource extends Resource
{
    protected static ?string $model = Beneficiary::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Gestion Clients';

    protected static ?string $navigationLabel = 'Bénéficiaires';

    protected static ?string $modelLabel = 'Bénéficiaire';

    protected static ?string $pluralModelLabel = 'Bénéficiaires';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations du Bénéficiaire')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Client')
                            ->relationship('user', 'email')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('name')
                            ->label('Nom du Bénéficiaire')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('bank_name')
                            ->label('Nom de la Banque')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Coordonnées Bancaires')
                    ->schema([
                        Forms\Components\TextInput::make('iban')
                            ->label('IBAN')
                            ->required()
                            ->maxLength(34)
                            ->placeholder('CH93 0000 0000 0000 0000 0')
                            ->helperText('Format: CH93 suivi de 19 chiffres')
                            ->columnSpanFull(),

                        Forms\Components\Select::make('category')
                            ->label('Catégorie')
                            ->options([
                                'Famille' => 'Famille',
                                'Fournisseur' => 'Fournisseur',
                                'Service' => 'Service',
                                'Salaire' => 'Salaire',
                                'Autre' => 'Autre',
                            ])
                            ->default('Autre'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Informations Complémentaires')
                    ->schema([
                        Forms\Components\Textarea::make('notes')
                            ->label('Notes')
                            ->maxLength(500)
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('is_favorite')
                            ->label('Bénéficiaire Favori')
                            ->default(false)
                            ->inline(false),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Client')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nom du Bénéficiaire')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('iban')
                    ->label('IBAN')
                    ->formatStateUsing(fn (string $state): string => chunk_split($state, 4, ' '))
                    ->searchable()
                    ->copyable()
                    ->copyMessage('IBAN copié'),

                Tables\Columns\TextColumn::make('bank_name')
                    ->label('Banque')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('category')
                    ->label('Catégorie')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Famille' => 'success',
                        'Fournisseur' => 'warning',
                        'Service' => 'info',
                        'Salaire' => 'primary',
                        'Autre' => 'gray',
                        default => 'gray',
                    }),

                Tables\Columns\IconColumn::make('is_favorite')
                    ->label('Favori')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray'),

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
                Tables\Filters\SelectFilter::make('category')
                    ->label('Catégorie')
                    ->options([
                        'Famille' => 'Famille',
                        'Fournisseur' => 'Fournisseur',
                        'Service' => 'Service',
                        'Salaire' => 'Salaire',
                        'Autre' => 'Autre',
                    ]),

                Tables\Filters\TernaryFilter::make('is_favorite')
                    ->label('Bénéficiaire Favori')
                    ->placeholder('Tous les bénéficiaires')
                    ->trueLabel('Favoris uniquement')
                    ->falseLabel('Non favoris uniquement'),

                Tables\Filters\SelectFilter::make('user_id')
                    ->label('Client')
                    ->relationship('user', 'email')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListBeneficiaries::route('/'),
            'create' => Pages\CreateBeneficiary::route('/create'),
            'edit' => Pages\EditBeneficiary::route('/{record}/edit'),
        ];
    }
}
