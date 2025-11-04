<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Statistiques Globales --}}
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
            @php
                $stats = $this->getStats();
            @endphp

            <x-filament::section>
                <x-slot name="heading">
                    <div class="flex items-center gap-2">
                        <x-heroicon-o-users class="w-5 h-5 text-primary-500" />
                        <span>Clients</span>
                    </div>
                </x-slot>
                <div class="space-y-2">
                    <div class="text-3xl font-bold text-gray-900 dark:text-white">
                        {{ number_format($stats['total_users']) }}
                    </div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">
                        <div>✓ Validés: {{ number_format($stats['validated_users']) }}</div>
                        <div>⏳ En attente: {{ number_format($stats['pending_users']) }}</div>
                    </div>
                </div>
            </x-filament::section>

            <x-filament::section>
                <x-slot name="heading">
                    <div class="flex items-center gap-2">
                        <x-heroicon-o-credit-card class="w-5 h-5 text-success-500" />
                        <span>Comptes</span>
                    </div>
                </x-slot>
                <div class="space-y-2">
                    <div class="text-3xl font-bold text-gray-900 dark:text-white">
                        {{ number_format($stats['total_accounts']) }}
                    </div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">
                        <div>✓ Actifs: {{ number_format($stats['active_accounts']) }}</div>
                        <div>💰 Solde total: {{ number_format($stats['total_balance'], 2) }} CHF</div>
                    </div>
                </div>
            </x-filament::section>

            <x-filament::section>
                <x-slot name="heading">
                    <div class="flex items-center gap-2">
                        <x-heroicon-o-arrow-path class="w-5 h-5 text-warning-500" />
                        <span>Transactions</span>
                    </div>
                </x-slot>
                <div class="space-y-2">
                    <div class="text-3xl font-bold text-gray-900 dark:text-white">
                        {{ number_format($stats['total_transactions']) }}
                    </div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">
                        <div>✓ Complétées: {{ number_format($stats['completed_transactions']) }}</div>
                    </div>
                </div>
            </x-filament::section>

            <x-filament::section>
                <x-slot name="heading">
                    <div class="flex items-center gap-2">
                        <x-heroicon-o-banknotes class="w-5 h-5 text-danger-500" />
                        <span>Demandes de Crédit</span>
                    </div>
                </x-slot>
                <div class="space-y-2">
                    <div class="text-3xl font-bold text-gray-900 dark:text-white">
                        {{ number_format($stats['total_credit_requests']) }}
                    </div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">
                        <div>✓ Approuvées: {{ number_format($stats['approved_credits']) }}</div>
                        <div>⏳ En attente: {{ number_format($stats['pending_credits']) }}</div>
                    </div>
                </div>
            </x-filament::section>
        </div>

        {{-- Instructions Export --}}
        <x-filament::section>
            <x-slot name="heading">
                Instructions d'Export
            </x-slot>
            <div class="prose dark:prose-invert max-w-none">
                <p class="text-gray-600 dark:text-gray-400">
                    Utilisez les boutons en haut de la page pour exporter les données en format CSV.
                </p>
                <ul class="text-sm text-gray-600 dark:text-gray-400">
                    <li><strong>Exporter Clients :</strong> Liste complète des clients avec leurs informations personnelles</li>
                    <li><strong>Exporter Comptes :</strong> Tous les comptes bancaires avec soldes et statuts</li>
                    <li><strong>Exporter Transactions :</strong> Historique complet des transactions</li>
                    <li><strong>Exporter Demandes de Crédit :</strong> Toutes les demandes de crédit avec leur statut</li>
                </ul>
                <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-950 rounded-lg">
                    <p class="text-sm text-blue-800 dark:text-blue-200">
                        <strong>💡 Astuce :</strong> Les fichiers CSV peuvent être ouverts avec Excel, Google Sheets ou tout autre tableur.
                        Les exports sont générés en temps réel avec les données les plus récentes.
                    </p>
                </div>
            </div>
        </x-filament::section>
    </div>
</x-filament-panels::page>
