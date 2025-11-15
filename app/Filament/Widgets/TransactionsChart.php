<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class TransactionsChart extends ChartWidget
{
    protected static ?string $heading = 'Transactions des 30 derniers jours';

    protected static ?int $sort = 1;

    protected function getData(): array
    {
        $transactions = Transaction::where('status', 'completed')
            ->where('transaction_date', '>=', now()->subDays(30))
            ->select(
                DB::raw('DATE(transaction_date) as date'),
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(CASE WHEN type = "credit" THEN amount ELSE 0 END) as credits'),
                DB::raw('SUM(CASE WHEN type = "debit" THEN amount ELSE 0 END) as debits')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = [];
        $creditData = [];
        $debitData = [];

        foreach ($transactions as $transaction) {
            $labels[] = date('d/m', strtotime($transaction->date));
            $creditData[] = (float) $transaction->credits;
            $debitData[] = (float) $transaction->debits;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Crédits',
                    'data' => $creditData,
                    'backgroundColor' => 'rgba(34, 197, 94, 0.2)',
                    'borderColor' => 'rgb(34, 197, 94)',
                ],
                [
                    'label' => 'Débits',
                    'data' => $debitData,
                    'backgroundColor' => 'rgba(239, 68, 68, 0.2)',
                    'borderColor' => 'rgb(239, 68, 68)',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                ],
            ],
        ];
    }
}
