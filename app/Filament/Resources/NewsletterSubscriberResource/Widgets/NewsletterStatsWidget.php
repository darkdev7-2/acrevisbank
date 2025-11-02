<?php

namespace App\Filament\Resources\NewsletterSubscriberResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class NewsletterStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $total = DB::table('newsletter_subscribers')->count();
        $active = DB::table('newsletter_subscribers')->where('is_active', true)->count();
        $thisMonth = DB::table('newsletter_subscribers')
            ->whereMonth('subscribed_at', now()->month)
            ->whereYear('subscribed_at', now()->year)
            ->count();
        $thisWeek = DB::table('newsletter_subscribers')
            ->whereBetween('subscribed_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();

        return [
            Stat::make('Total Abonnés', $total)
                ->description($active . ' actifs')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make('Ce Mois', $thisMonth)
                ->description('Nouvelles inscriptions')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

            Stat::make('Cette Semaine', $thisWeek)
                ->description('Nouvelles inscriptions')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info'),
        ];
    }
}
