<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\CreditRequest;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class BankingStatsOverview extends BaseWidget
{
    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        // Client statistics
        $totalClients = User::role('Customer')->count();
        $pendingRegistrations = User::where('validation_status', 'pending')->count();
        $validatedClients = User::where('validation_status', 'validated')->count();

        // Get previous month stats for comparison
        $previousMonthClients = User::role('Customer')
            ->whereDate('created_at', '<', now()->startOfMonth())
            ->count();
        $clientGrowth = $previousMonthClients > 0
            ? (($totalClients - $previousMonthClients) / $previousMonthClients) * 100
            : 0;

        // Account statistics
        $totalAccounts = Account::count();
        $activeAccounts = Account::where('is_active', true)->count();
        $totalBalance = Account::sum('balance');

        // Transaction statistics
        $monthlyTransactions = Transaction::whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->count();
        $monthlyVolume = Transaction::whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->where('status', 'completed')
            ->sum('amount');

        // Credit request statistics
        $pendingCredits = CreditRequest::where('status', 'pending')->count();

        return [
            Stat::make('Clients totaux', $totalClients)
                ->description(abs($clientGrowth) > 0
                    ? number_format($clientGrowth, 1) . '% ce mois'
                    : 'Aucun changement')
                ->descriptionIcon($clientGrowth >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($clientGrowth >= 0 ? 'success' : 'danger')
                ->chart([7, 12, 8, 15, 14, 20, $totalClients]),

            Stat::make('Inscriptions en attente', $pendingRegistrations)
                ->description($pendingRegistrations > 0
                    ? 'Nécessite validation'
                    : 'Aucune en attente')
                ->descriptionIcon('heroicon-m-clock')
                ->color($pendingRegistrations > 10 ? 'danger' : ($pendingRegistrations > 5 ? 'warning' : 'success'))
                ->url(route('filament.admin.resources.pending-registrations.index')),

            Stat::make('Comptes bancaires', $totalAccounts)
                ->description($activeAccounts . ' comptes actifs')
                ->descriptionIcon('heroicon-m-credit-card')
                ->color('primary'),

            Stat::make('Solde total', number_format($totalBalance, 0, '.', "'") . ' CHF')
                ->description('Tous comptes confondus')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make('Transactions ce mois', $monthlyTransactions)
                ->description('Volume: ' . number_format($monthlyVolume, 0, '.', "'") . ' CHF')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color('info'),

            Stat::make('Demandes de crédit', $pendingCredits)
                ->description($pendingCredits > 0
                    ? 'En attente de traitement'
                    : 'Aucune demande')
                ->descriptionIcon('heroicon-m-document-text')
                ->color($pendingCredits > 0 ? 'warning' : 'success'),
        ];
    }
}
