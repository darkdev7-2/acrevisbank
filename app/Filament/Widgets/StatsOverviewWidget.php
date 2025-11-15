<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\CreditRequest;
use Illuminate\Support\Facades\DB;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // Total users
        $totalUsers = User::count();
        $newUsersThisMonth = User::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Credit requests
        $totalCreditRequests = CreditRequest::count();
        $pendingCredits = CreditRequest::where('status', 'pending')->count();
        $approvedCredits = CreditRequest::where('status', 'approved')->count();
        $creditRequestsThisMonth = CreditRequest::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Newsletter subscribers
        $newsletterSubscribers = DB::table('newsletter_subscribers')
            ->where('is_active', true)
            ->count();
        $newsletterThisMonth = DB::table('newsletter_subscribers')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Contact submissions
        $contactSubmissions = DB::table('contact_submissions')->count();
        $newContactsThisMonth = DB::table('contact_submissions')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Total credit amount requested
        $totalCreditAmount = CreditRequest::sum('amount');
        $approvedCreditAmount = CreditRequest::where('status', 'approved')->sum('amount');

        return [
            Stat::make('Total Clients', $totalUsers)
                ->description($newUsersThisMonth . ' nouveaux ce mois')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 4, 6, 8, 10, 12, $newUsersThisMonth]),

            Stat::make('Demandes de Crédit', $totalCreditRequests)
                ->description($creditRequestsThisMonth . ' ce mois')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('primary')
                ->chart([5, 10, 8, 15, 20, 18, $creditRequestsThisMonth]),

            Stat::make('Crédits en Attente', $pendingCredits)
                ->description($approvedCredits . ' approuvés au total')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Abonnés Newsletter', $newsletterSubscribers)
                ->description($newsletterThisMonth . ' nouveaux ce mois')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('info'),

            Stat::make('Montant Total Demandé', 'CHF ' . number_format($totalCreditAmount, 0, '.', '\''))
                ->description('CHF ' . number_format($approvedCreditAmount, 0, '.', '\'') . ' approuvés')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),

            Stat::make('Contacts Reçus', $contactSubmissions)
                ->description($newContactsThisMonth . ' ce mois')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->color('gray'),
        ];
    }
}
