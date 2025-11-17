<?php

namespace App\Filament\Resources\SuspiciousActivityResource\Pages;

use App\Filament\Resources\SuspiciousActivityResource;
use App\Services\SuspiciousActivityDetectionService;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListSuspiciousActivities extends ListRecords
{
    protected static string $resource = SuspiciousActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('statistics')
                ->label('Statistiques')
                ->icon('heroicon-o-chart-bar')
                ->color('info')
                ->modalHeading('Statistiques des Activités Suspectes')
                ->modalContent(function () {
                    $service = app(SuspiciousActivityDetectionService::class);
                    $stats = $service->getStatistics(30);

                    return view('filament.pages.suspicious-activities-stats', ['stats' => $stats]);
                })
                ->modalSubmitAction(false)
                ->modalCancelActionLabel('Fermer'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Toutes')
                ->badge($this->getModel()::count()),
            'unresolved' => Tab::make('Non résolues')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_resolved', false))
                ->badge($this->getModel()::where('is_resolved', false)->count())
                ->badgeColor('warning'),
            'high_risk' => Tab::make('Risque Élevé')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereIn('severity', ['high', 'critical']))
                ->badge($this->getModel()::whereIn('severity', ['high', 'critical'])->count())
                ->badgeColor('danger'),
            'today' => Tab::make('Aujourd\'hui')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereDate('created_at', today()))
                ->badge($this->getModel()::whereDate('created_at', today())->count())
                ->badgeColor('success'),
        ];
    }
}
