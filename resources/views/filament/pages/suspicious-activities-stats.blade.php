<div class="p-6 space-y-4">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-blue-50 dark:bg-blue-900 rounded-lg p-4">
            <div class="text-sm text-blue-600 dark:text-blue-400 font-medium">Total (30 jours)</div>
            <div class="text-2xl font-bold text-blue-900 dark:text-blue-100">{{ $stats['total'] }}</div>
        </div>

        <div class="bg-yellow-50 dark:bg-yellow-900 rounded-lg p-4">
            <div class="text-sm text-yellow-600 dark:text-yellow-400 font-medium">Non résolues</div>
            <div class="text-2xl font-bold text-yellow-900 dark:text-yellow-100">{{ $stats['unresolved'] }}</div>
        </div>

        <div class="bg-red-50 dark:bg-red-900 rounded-lg p-4">
            <div class="text-sm text-red-600 dark:text-red-400 font-medium">Risque Élevé</div>
            <div class="text-2xl font-bold text-red-900 dark:text-red-100">{{ $stats['high_risk'] }}</div>
        </div>

        <div class="bg-purple-50 dark:bg-purple-900 rounded-lg p-4">
            <div class="text-sm text-purple-600 dark:text-purple-400 font-medium">Critiques</div>
            <div class="text-2xl font-bold text-purple-900 dark:text-purple-100">{{ $stats['critical'] }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
            <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Par Type</h3>
            <div class="space-y-2">
                @foreach($stats['by_type'] as $type => $count)
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ ucfirst(str_replace('_', ' ', $type)) }}</span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $count }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
            <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Métriques</h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Faux Positifs</span>
                    <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $stats['false_positives'] }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Score Moyen de Risque</span>
                    <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $stats['avg_risk_score'] }}/100</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Taux de Résolution</span>
                    <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                        {{ $stats['total'] > 0 ? round((($stats['total'] - $stats['unresolved']) / $stats['total']) * 100, 1) : 0 }}%
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div class="ml-3 text-sm text-blue-700 dark:text-blue-300">
                <p class="font-medium">Informations</p>
                <p class="mt-1">Ces statistiques couvrent les 30 derniers jours. Un score de risque supérieur à 80 nécessite une attention immédiate.</p>
            </div>
        </div>
    </div>
</div>
