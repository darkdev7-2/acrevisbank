<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\CreditRequest;
use Illuminate\Support\Facades\DB;

class CreditRequestsChart extends ChartWidget
{
    protected static ?string $heading = 'Demandes de Crédit - 12 Derniers Mois';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = [];
        $labels = [];

        // Get data for last 12 months
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $labels[] = $date->format('M Y');

            $count = CreditRequest::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();

            $data[] = $count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Demandes de crédit',
                    'data' => $data,
                    'backgroundColor' => 'rgba(219, 39, 119, 0.1)',
                    'borderColor' => 'rgba(219, 39, 119, 1)',
                    'fill' => true,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
