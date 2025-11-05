<x-layouts.dashboard>
    @php
        $currentLocale = app()->getLocale();

        $texts = [
            'fr' => [
                'title' => 'Détails du compte',
                'back' => '← Retour au tableau de bord',
                'account_number' => 'Numéro de compte',
                'iban' => 'IBAN',
                'balance' => 'Solde',
                'available' => 'Disponible',
                'opened_on' => 'Ouvert le',
                'transactions' => 'Transactions',
                'date' => 'Date',
                'description' => 'Description',
                'reference' => 'Référence',
                'amount' => 'Montant',
                'balance_after' => 'Solde après',
                'no_transactions' => 'Aucune transaction',
                'no_transactions_text' => 'Il n\'y a pas encore de transactions pour ce compte.',
                'recipient' => 'Bénéficiaire',
                'actions' => 'Actions',
                'new_transfer' => 'Nouveau virement',
                'export' => 'Exporter',
                'show_filters' => 'Afficher les filtres',
                'hide_filters' => 'Masquer les filtres',
                'filters' => 'Filtres',
                'date_from' => 'Date de début',
                'date_to' => 'Date de fin',
                'type' => 'Type',
                'all' => 'Tous',
                'debits' => 'Débits',
                'credits' => 'Crédits',
                'min_amount' => 'Montant min (CHF)',
                'max_amount' => 'Montant max (CHF)',
                'search' => 'Rechercher',
                'search_placeholder' => 'Description, bénéficiaire, référence...',
                'apply_filters' => 'Appliquer les filtres',
                'reset' => 'Réinitialiser',
                'export_pdf' => 'Exporter PDF',
                'export_csv' => 'Exporter CSV',
                'active_filters' => 'Filtres actifs:',
                'from' => 'Du:',
                'to' => 'Au:',
            ],
            'de' => [
                'title' => 'Kontodetails',
                'back' => '← Zurück zum Dashboard',
                'account_number' => 'Kontonummer',
                'iban' => 'IBAN',
                'balance' => 'Saldo',
                'available' => 'Verfügbar',
                'opened_on' => 'Eröffnet am',
                'transactions' => 'Transaktionen',
                'date' => 'Datum',
                'description' => 'Beschreibung',
                'reference' => 'Referenz',
                'amount' => 'Betrag',
                'balance_after' => 'Saldo nach',
                'no_transactions' => 'Keine Transaktionen',
                'no_transactions_text' => 'Es gibt noch keine Transaktionen für dieses Konto.',
                'recipient' => 'Empfänger',
                'actions' => 'Aktionen',
                'new_transfer' => 'Neue Überweisung',
                'export' => 'Exportieren',
                'show_filters' => 'Filter anzeigen',
                'hide_filters' => 'Filter ausblenden',
                'filters' => 'Filter',
                'date_from' => 'Von Datum',
                'date_to' => 'Bis Datum',
                'type' => 'Typ',
                'all' => 'Alle',
                'debits' => 'Belastungen',
                'credits' => 'Gutschriften',
                'min_amount' => 'Mindestbetrag (CHF)',
                'max_amount' => 'Maximalbetrag (CHF)',
                'search' => 'Suchen',
                'search_placeholder' => 'Beschreibung, Empfänger, Referenz...',
                'apply_filters' => 'Filter anwenden',
                'reset' => 'Zurücksetzen',
                'export_pdf' => 'PDF exportieren',
                'export_csv' => 'CSV exportieren',
                'active_filters' => 'Aktive Filter:',
                'from' => 'Von:',
                'to' => 'Bis:',
            ],
            'en' => [
                'title' => 'Account details',
                'back' => '← Back to dashboard',
                'account_number' => 'Account number',
                'iban' => 'IBAN',
                'balance' => 'Balance',
                'available' => 'Available',
                'opened_on' => 'Opened on',
                'transactions' => 'Transactions',
                'date' => 'Date',
                'description' => 'Description',
                'reference' => 'Reference',
                'amount' => 'Amount',
                'balance_after' => 'Balance after',
                'no_transactions' => 'No transactions',
                'no_transactions_text' => 'There are no transactions yet for this account.',
                'recipient' => 'Recipient',
                'actions' => 'Actions',
                'new_transfer' => 'New transfer',
                'export' => 'Export',
                'show_filters' => 'Show filters',
                'hide_filters' => 'Hide filters',
                'filters' => 'Filters',
                'date_from' => 'Start date',
                'date_to' => 'End date',
                'type' => 'Type',
                'all' => 'All',
                'debits' => 'Debits',
                'credits' => 'Credits',
                'min_amount' => 'Min amount (CHF)',
                'max_amount' => 'Max amount (CHF)',
                'search' => 'Search',
                'search_placeholder' => 'Description, recipient, reference...',
                'apply_filters' => 'Apply filters',
                'reset' => 'Reset',
                'export_pdf' => 'Export PDF',
                'export_csv' => 'Export CSV',
                'active_filters' => 'Active filters:',
                'from' => 'From:',
                'to' => 'To:',
            ],
            'es' => [
                'title' => 'Detalles de cuenta',
                'back' => '← Volver al panel',
                'account_number' => 'Número de cuenta',
                'iban' => 'IBAN',
                'balance' => 'Saldo',
                'available' => 'Disponible',
                'opened_on' => 'Abierto el',
                'transactions' => 'Transacciones',
                'date' => 'Fecha',
                'description' => 'Descripción',
                'reference' => 'Referencia',
                'amount' => 'Monto',
                'balance_after' => 'Saldo después',
                'no_transactions' => 'Sin transacciones',
                'no_transactions_text' => 'Aún no hay transacciones para esta cuenta.',
                'recipient' => 'Beneficiario',
                'actions' => 'Acciones',
                'new_transfer' => 'Nueva transferencia',
                'export' => 'Exportar',
                'show_filters' => 'Mostrar filtros',
                'hide_filters' => 'Ocultar filtros',
                'filters' => 'Filtros',
                'date_from' => 'Fecha de inicio',
                'date_to' => 'Fecha de fin',
                'type' => 'Tipo',
                'all' => 'Todos',
                'debits' => 'Débitos',
                'credits' => 'Créditos',
                'min_amount' => 'Monto mín (CHF)',
                'max_amount' => 'Monto máx (CHF)',
                'search' => 'Buscar',
                'search_placeholder' => 'Descripción, beneficiario, referencia...',
                'apply_filters' => 'Aplicar filtros',
                'reset' => 'Reiniciar',
                'export_pdf' => 'Exportar PDF',
                'export_csv' => 'Exportar CSV',
                'active_filters' => 'Filtros activos:',
                'from' => 'Desde:',
                'to' => 'Hasta:',
            ]
        ];

        $t = $texts[$currentLocale];
    @endphp

    <x-slot name="title">{{ $account->account_type }}</x-slot>
    <x-slot name="pageTitle">{{ $account->account_type }}</x-slot>
    <x-slot name="pageSubtitle">{{ $t['opened_on'] }} {{ $account->opened_at->format('d.m.Y') }} • {{ $t['balance'] }}: {{ $account->formatted_balance }}</x-slot>

    <div class="p-4 sm:p-6 lg:p-8">
        <div class="mb-4">
            <a href="{{ route('dashboard.index', ['locale' => $currentLocale]) }}"
               class="inline-flex items-center text-pink-600 hover:text-pink-700 font-medium transition-colors">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                {{ $t['back'] }}
            </a>
        </div>
            <!-- Account Info Card -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <p class="text-xs text-gray-500 mb-1">{{ $t['account_number'] }}</p>
                        <p class="font-mono font-medium">{{ $account->account_number }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-1">{{ $t['iban'] }}</p>
                        <p class="font-mono text-sm font-medium">{{ trim($account->formatted_iban) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-1">{{ $t['available'] }}</p>
                        <p class="font-medium text-green-600">{{ number_format($account->available_balance, 2, '.', "'") }} {{ $account->currency }}</p>
                    </div>
                </div>
            </div>

            <!-- Filters & Export Section -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-900">{{ $t['export'] }} & {{ $t['filters'] }}</h3>
                    <button onclick="toggleFilters()" type="button" class="text-sm text-pink-600 hover:text-pink-700 font-medium">
                        <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        <span id="filterToggleText">{{ $t['show_filters'] }}</span>
                    </button>
                </div>

                <!-- Filter Form (Hidden by default) -->
                <div id="filterForm" class="hidden mb-6">
                    <form method="GET" action="{{ route('dashboard.account', ['locale' => $currentLocale, 'id' => $account->id]) }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Date From -->
                            <div>
                                <label for="date_from" class="block text-sm font-medium text-gray-700 mb-1">{{ $t['date_from'] }}</label>
                                <input type="date"
                                       name="date_from"
                                       id="date_from"
                                       value="{{ request('date_from') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                            </div>

                            <!-- Date To -->
                            <div>
                                <label for="date_to" class="block text-sm font-medium text-gray-700 mb-1">{{ $t['date_to'] }}</label>
                                <input type="date"
                                       name="date_to"
                                       id="date_to"
                                       value="{{ request('date_to') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                            </div>

                            <!-- Type -->
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">{{ $t['type'] }}</label>
                                <select name="type"
                                        id="type"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                                    <option value="all" {{ request('type', 'all') === 'all' ? 'selected' : '' }}>{{ $t['all'] }}</option>
                                    <option value="debit" {{ request('type') === 'debit' ? 'selected' : '' }}>{{ $t['debits'] }}</option>
                                    <option value="credit" {{ request('type') === 'credit' ? 'selected' : '' }}>{{ $t['credits'] }}</option>
                                </select>
                            </div>

                            <!-- Min Amount -->
                            <div>
                                <label for="min_amount" class="block text-sm font-medium text-gray-700 mb-1">{{ $t['min_amount'] }}</label>
                                <input type="number"
                                       name="min_amount"
                                       id="min_amount"
                                       step="0.01"
                                       value="{{ request('min_amount') }}"
                                       placeholder="0.00"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                            </div>

                            <!-- Max Amount -->
                            <div>
                                <label for="max_amount" class="block text-sm font-medium text-gray-700 mb-1">{{ $t['max_amount'] }}</label>
                                <input type="number"
                                       name="max_amount"
                                       id="max_amount"
                                       step="0.01"
                                       value="{{ request('max_amount') }}"
                                       placeholder="0.00"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                            </div>

                            <!-- Search -->
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">{{ $t['search'] }}</label>
                                <input type="text"
                                       name="search"
                                       id="search"
                                       value="{{ request('search') }}"
                                       placeholder="{{ $t['search_placeholder'] }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-3">
                            <button type="submit" class="px-6 py-2 bg-pink-600 text-white rounded-md hover:bg-pink-700 transition-colors font-medium">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                </svg>
                                {{ $t['apply_filters'] }}
                            </button>
                            <a href="{{ route('dashboard.account', ['locale' => $currentLocale, 'id' => $account->id]) }}"
                               class="px-6 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-colors font-medium">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                {{ $t['reset'] }}
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Export Buttons -->
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('dashboard.transactions.export.pdf', ['locale' => $currentLocale, 'accountId' => $account->id]) }}?{{ http_build_query(request()->except('page')) }}"
                       target="_blank"
                       class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        {{ $t['export_pdf'] }}
                    </a>
                    <a href="{{ route('dashboard.transactions.export.csv', ['locale' => $currentLocale, 'accountId' => $account->id]) }}?{{ http_build_query(request()->except('page')) }}"
                       class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        {{ $t['export_csv'] }}
                    </a>
                    <a href="{{ route('dashboard.transfer', ['locale' => $currentLocale]) }}"
                       class="inline-flex items-center px-4 py-2 bg-pink-600 text-white rounded-md hover:bg-pink-700 transition-colors font-medium ml-auto">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                        </svg>
                        {{ $t['new_transfer'] }}
                    </a>
                </div>

                <!-- Active Filters Display -->
                @php
                    $hasFilters = request()->hasAny(['date_from', 'date_to', 'type', 'min_amount', 'max_amount', 'search']) &&
                                  (request('date_from') || request('date_to') || request('type') !== 'all' || request('min_amount') || request('max_amount') || request('search'));
                @endphp

                @if($hasFilters)
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="flex flex-wrap gap-2 items-center">
                            <span class="text-sm font-medium text-gray-700">{{ $t['active_filters'] }}</span>
                            @if(request('date_from'))
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                                    {{ $t['from'] }} {{ request('date_from') }}
                                </span>
                            @endif
                            @if(request('date_to'))
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                                    {{ $t['to'] }} {{ request('date_to') }}
                                </span>
                            @endif
                            @if(request('type') && request('type') !== 'all')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                                    {{ $t['type'] }}: {{ request('type') === 'debit' ? $t['debits'] : $t['credits'] }}
                                </span>
                            @endif
                            @if(request('min_amount'))
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                                    Min: {{ request('min_amount') }} CHF
                                </span>
                            @endif
                            @if(request('max_amount'))
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                                    Max: {{ request('max_amount') }} CHF
                                </span>
                            @endif
                            @if(request('search'))
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                                    {{ $t['search'] }}: "{{ request('search') }}"
                                </span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Actions Bar -->
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">{{ $t['transactions'] }}</h2>
            </div>

            <!-- Transactions Table -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                @if($transactions->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ $t['date'] }}
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ $t['description'] }}
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ $t['reference'] }}
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ $t['amount'] }}
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ $t['balance_after'] }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($transactions as $transaction)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $transaction->transaction_date->format('d.m.Y') }}
                                            <span class="block text-xs text-gray-500">{{ $transaction->transaction_date->format('H:i') }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            <div class="font-medium text-gray-900">{{ $transaction->description }}</div>
                                            @if($transaction->recipient_name)
                                                <div class="text-xs text-gray-500 mt-1">
                                                    {{ $t['recipient'] }}: {{ $transaction->recipient_name }}
                                                </div>
                                            @endif
                                            @if($transaction->recipient_iban)
                                                <div class="text-xs text-gray-400 font-mono">{{ $transaction->recipient_iban }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-500">
                                            {{ $transaction->reference }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-bold">
                                            <span class="{{ $transaction->type === 'debit' ? 'text-red-600' : 'text-green-600' }}">
                                                {{ $transaction->formatted_amount }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium text-gray-900">
                                            {{ number_format($transaction->balance_after, 2, '.', "'") }} {{ $transaction->currency }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $transactions->links() }}
                    </div>
                @else
                    <div class="px-6 py-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">{{ $t['no_transactions'] }}</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ $t['no_transactions_text'] }}</p>
                    </div>
                @endif
            </div>
    </div>

    <script>
        function toggleFilters() {
            const filterForm = document.getElementById('filterForm');
            const toggleText = document.getElementById('filterToggleText');

            if (filterForm.classList.contains('hidden')) {
                filterForm.classList.remove('hidden');
                toggleText.textContent = '{{ $t["hide_filters"] }}';
            } else {
                filterForm.classList.add('hidden');
                toggleText.textContent = '{{ $t["show_filters"] }}';
            }
        }

        // Auto-show filters if any filter is active
        @php
            $hasFilters = request()->hasAny(['date_from', 'date_to', 'type', 'min_amount', 'max_amount', 'search']) &&
                          (request('date_from') || request('date_to') || request('type') !== 'all' || request('min_amount') || request('max_amount') || request('search'));
        @endphp

        @if($hasFilters)
            document.addEventListener('DOMContentLoaded', function() {
                toggleFilters();
            });
        @endif
    </script>
</x-layouts.dashboard>
