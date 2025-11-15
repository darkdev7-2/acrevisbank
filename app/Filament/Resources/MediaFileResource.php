<?php
namespace App\Filament\Resources;
use App\Filament\Resources\MediaFileResource\Pages;
use App\Models\MediaFile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MediaFileResource extends Resource
{
    protected static ?string $model = MediaFile::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Contenu du Site';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Fichier')->schema([
                Forms\Components\FileUpload::make('file_path')
                    ->label('Fichier')
                    ->required()
                    ->directory('media')
                    ->maxSize(10240)
                    ->acceptedFileTypes(['image/*', 'application/pdf', 'video/*']),
                Forms\Components\TextInput::make('title')->required(),
                Forms\Components\TextInput::make('alt_text')->label('Texte alternatif'),
                Forms\Components\Textarea::make('description')->rows(3),
            ]),
            Forms\Components\Section::make('Métadonnées')->schema([
                Forms\Components\Select::make('type')->options([
                    'image' => 'Image',
                    'document' => 'Document',
                    'video' => 'Vidéo',
                    'other' => 'Autre',
                ])->required(),
                Forms\Components\TextInput::make('mime_type')->disabled(),
                Forms\Components\TextInput::make('file_size')->numeric()->suffix('KB')->disabled(),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('file_path')->label('Aperçu'),
            Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('type')->badge(),
            Tables\Columns\TextColumn::make('mime_type'),
            Tables\Columns\TextColumn::make('file_size')->suffix(' KB'),
            Tables\Columns\TextColumn::make('created_at')->dateTime('d/m/Y')->sortable(),
        ])->filters([
            Tables\Filters\SelectFilter::make('type'),
        ])->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMediaFiles::route('/'),
            'create' => Pages\CreateMediaFile::route('/create'),
            'view' => Pages\ViewMediaFile::route('/{record}'),
            'edit' => Pages\EditMediaFile::route('/{record}/edit'),
        ];
    }
}
