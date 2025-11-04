<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsletterSubscriberResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class NewsletterSubscriberResource extends Resource
{
    protected static ?string $model = null;
    protected static ?string $navigationIcon = 'heroicon-o-envelope-open';

    protected static ?string $navigationGroup = 'Communication';

    protected static ?string $navigationLabel = 'Newsletter';
    protected static ?string $modelLabel = 'Abonné Newsletter';
    protected static ?string $pluralModelLabel = 'Abonnés Newsletter';
    protected static ?int $navigationSort = 2;

    public static function getEloquentQuery(): Builder
    {
        return DB::table('newsletter_subscribers')->selectRaw('*');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),

                Forms\Components\Toggle::make('is_active')
                    ->label('Actif')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(DB::table('newsletter_subscribers'))
            ->columns([
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->icon('heroicon-m-envelope')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Actif')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('subscribed_at')
                    ->label('Inscrit le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Statut')
                    ->placeholder('Tous')
                    ->trueLabel('Actifs uniquement')
                    ->falseLabel('Inactifs uniquement'),

                Tables\Filters\Filter::make('subscribed_this_month')
                    ->label('Ce mois')
                    ->query(fn (Builder $query): Builder => $query->whereMonth('subscribed_at', now()->month)),

                Tables\Filters\Filter::make('subscribed_this_year')
                    ->label('Cette année')
                    ->query(fn (Builder $query): Builder => $query->whereYear('subscribed_at', now()->year)),
            ])
            ->actions([
                Tables\Actions\Action::make('activate')
                    ->label('Activer')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => !$record->is_active)
                    ->action(function ($record) {
                        DB::table('newsletter_subscribers')
                            ->where('id', $record->id)
                            ->update(['is_active' => true, 'updated_at' => now()]);
                    })
                    ->requiresConfirmation(),

                Tables\Actions\Action::make('deactivate')
                    ->label('Désactiver')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn ($record) => $record->is_active)
                    ->action(function ($record) {
                        DB::table('newsletter_subscribers')
                            ->where('id', $record->id)
                            ->update(['is_active' => false, 'updated_at' => now()]);
                    })
                    ->requiresConfirmation(),

                Tables\Actions\DeleteAction::make()
                    ->action(function ($record) {
                        DB::table('newsletter_subscribers')->where('id', $record->id)->delete();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('export')
                        ->label('Exporter (CSV)')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('success')
                        ->action(function ($records) {
                            $filename = 'newsletter_subscribers_' . now()->format('Y-m-d_His') . '.csv';
                            $headers = [
                                'Content-Type' => 'text/csv',
                                'Content-Disposition' => "attachment; filename=\"$filename\"",
                            ];

                            $callback = function() use ($records) {
                                $file = fopen('php://output', 'w');
                                fputcsv($file, ['Email', 'Actif', 'Date d\'inscription', 'Date de création']);

                                foreach ($records as $record) {
                                    fputcsv($file, [
                                        $record->email,
                                        $record->is_active ? 'Oui' : 'Non',
                                        $record->subscribed_at,
                                        $record->created_at,
                                    ]);
                                }

                                fclose($file);
                            };

                            return response()->stream($callback, 200, $headers);
                        }),

                    Tables\Actions\BulkAction::make('activate_all')
                        ->label('Activer')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function ($records) {
                            $ids = $records->pluck('id')->toArray();
                            DB::table('newsletter_subscribers')
                                ->whereIn('id', $ids)
                                ->update(['is_active' => true, 'updated_at' => now()]);
                        })
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\BulkAction::make('deactivate_all')
                        ->label('Désactiver')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(function ($records) {
                            $ids = $records->pluck('id')->toArray();
                            DB::table('newsletter_subscribers')
                                ->whereIn('id', $ids)
                                ->update(['is_active' => false, 'updated_at' => now()]);
                        })
                        ->deselectRecordsAfterCompletion(),

                    Tables\Actions\DeleteBulkAction::make()
                        ->action(function ($records) {
                            $ids = $records->pluck('id')->toArray();
                            DB::table('newsletter_subscribers')->whereIn('id', $ids)->delete();
                        }),
                ]),
            ])
            ->defaultSort('subscribed_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNewsletterSubscribers::route('/'),
        ];
    }
}
