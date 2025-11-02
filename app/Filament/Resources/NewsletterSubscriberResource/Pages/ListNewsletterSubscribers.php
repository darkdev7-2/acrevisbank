<?php

namespace App\Filament\Resources\NewsletterSubscriberResource\Pages;

use App\Filament\Resources\NewsletterSubscriberResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\DB;

class ListNewsletterSubscribers extends ListRecords
{
    protected static string $resource = NewsletterSubscriberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('export_all')
                ->label('Exporter Tous')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->action(function () {
                    $subscribers = DB::table('newsletter_subscribers')->get();

                    $filename = 'newsletter_subscribers_all_' . now()->format('Y-m-d_His') . '.csv';
                    $headers = [
                        'Content-Type' => 'text/csv',
                        'Content-Disposition' => "attachment; filename=\"$filename\"",
                    ];

                    $callback = function() use ($subscribers) {
                        $file = fopen('php://output', 'w');
                        fputcsv($file, ['Email', 'Actif', 'Date d\'inscription', 'Date de création']);

                        foreach ($subscribers as $subscriber) {
                            fputcsv($file, [
                                $subscriber->email,
                                $subscriber->is_active ? 'Oui' : 'Non',
                                $subscriber->subscribed_at,
                                $subscriber->created_at,
                            ]);
                        }

                        fclose($file);
                    };

                    return response()->stream($callback, 200, $headers);
                }),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            NewsletterSubscriberResource\Widgets\NewsletterStatsWidget::class,
        ];
    }
}
