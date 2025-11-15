<?php

namespace App\Filament\Widgets;

use App\Models\CreditRequest;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CreditRequestStats extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        $pendingCount = CreditRequest::where('status', 'pending')->count();
        $approvedCount = CreditRequest::where('status', 'approved')->count();
        $rejectedCount = CreditRequest::where('status', 'rejected')->count();
        $totalAmount = CreditRequest::where('status', 'approved')->sum('amount');

        return [
            Stat::make('Demandes en attente', $pendingCount)
                ->description('Demandes à traiter')
                ->descriptionIcon('heroicon-m-clock')
                ->color($pendingCount > 5 ? 'danger' : ($pendingCount > 0 ? 'warning' : 'success'))
                ->chart($this->getPendingTrend())
                ->url(route('filament.admin.resources.credit-requests.index', [
                    'tableFilters' => ['status' => ['value' => 'pending']],
                ])),

            Stat::make('Demandes approuvées', $approvedCount)
                ->description('Ce mois-ci')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->chart($this->getApprovedTrend()),

            Stat::make('Demandes rejetées', $rejectedCount)
                ->description('Ce mois-ci')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger')
                ->chart($this->getRejectedTrend()),

            Stat::make('Montant total approuvé', number_format($totalAmount, 0, ',', ' ') . ' CHF')
                ->description('Montant cumulé ce mois')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
        ];
    }

    protected function getPendingTrend(): array
    {
        return $this->getTrendData('pending');
    }

    protected function getApprovedTrend(): array
    {
        return $this->getTrendData('approved');
    }

    protected function getRejectedTrend(): array
    {
        return $this->getTrendData('rejected');
    }

    protected function getTrendData(string $status): array
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $count = CreditRequest::where('status', $status)
                ->whereDate('created_at', $date)
                ->count();
            $data[] = $count;
        }
        return $data;
    }
}
