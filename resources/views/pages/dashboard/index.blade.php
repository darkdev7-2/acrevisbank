<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();

        $texts = [
            'fr' => [
                'title' => 'Mon espace client',
                'welcome' => 'Bienvenue',
                'total_balance' => 'Solde total',
                'accounts' => 'Mes comptes',
                'account_number' => 'Numéro de compte',
                'iban' => 'IBAN',
                'balance' => 'Solde',
                'available' => 'Disponible',
                'recent_transactions' => 'Dernières transactions',
                'view_all' => 'Voir tout',
                'view_account' => 'Voir le compte',
                'quick_actions' => 'Actions rapides',
                'new_transfer' => 'Nouveau virement',
                'request_credit' => 'Demander un crédit',
                'contact_advisor' => 'Contacter mon conseiller',
                'logout' => 'Se déconnecter',
                'date' => 'Date',
                'description' => 'Description',
                'amount' => 'Montant',
                'no_accounts' => 'Aucun compte',
                'no_accounts_text' => 'Vous n\'avez pas encore de compte actif.',
                'no_transactions' => 'Aucune transaction',
                'opened_on' => 'Ouvert le',
            ],
            'de' => [
                'title' => 'Mein Kundenbereich',
                'welcome' => 'Willkommen',
                'total_balance' => 'Gesamtsaldo',
                'accounts' => 'Meine Konten',
                'account_number' => 'Kontonummer',
                'iban' => 'IBAN',
                'balance' => 'Saldo',
                'available' => 'Verfügbar',
                'recent_transactions' => 'Letzte Transaktionen',
                'view_all' => 'Alle anzeigen',
                'view_account' => 'Konto anzeigen',
                'quick_actions' => 'Schnellaktionen',
                'new_transfer' => 'Neue Überweisung',
                'request_credit' => 'Kredit beantragen',
                'contact_advisor' => 'Berater kontaktieren',
                'logout' => 'Abmelden',
                'date' => 'Datum',
                'description' => 'Beschreibung',
                'amount' => 'Betrag',
                'no_accounts' => 'Keine Konten',
                'no_accounts_text' => 'Sie haben noch kein aktives Konto.',
                'no_transactions' => 'Keine Transaktionen',
                'opened_on' => 'Eröffnet am',
            ],
            'en' => [
                'title' => 'My customer area',
                'welcome' => 'Welcome',
                'total_balance' => 'Total balance',
                'accounts' => 'My accounts',
                'account_number' => 'Account number',
                'iban' => 'IBAN',
                'balance' => 'Balance',
                'available' => 'Available',
                'recent_transactions' => 'Recent transactions',
                'view_all' => 'View all',
                'view_account' => 'View account',
                'quick_actions' => 'Quick actions',
                'new_transfer' => 'New transfer',
                'request_credit' => 'Request credit',
                'contact_advisor' => 'Contact my advisor',
                'logout' => 'Logout',
                'date' => 'Date',
                'description' => 'Description',
                'amount' => 'Amount',
                'no_accounts' => 'No accounts',
                'no_accounts_text' => 'You don\'t have any active accounts yet.',
                'no_transactions' => 'No transactions',
                'opened_on' => 'Opened on',
            ],
            'es' => [
                'title' => 'Mi área de cliente',
                'welcome' => 'Bienvenido',
                'total_balance' => 'Saldo total',
                'accounts' => 'Mis cuentas',
                'account_number' => 'Número de cuenta',
                'iban' => 'IBAN',
                'balance' => 'Saldo',
                'available' => 'Disponible',
                'recent_transactions' => 'Transacciones recientes',
                'view_all' => 'Ver todo',
                'view_account' => 'Ver cuenta',
                'quick_actions' => 'Acciones rápidas',
                'new_transfer' => 'Nueva transferencia',
                'request_credit' => 'Solicitar crédito',
                'contact_advisor' => 'Contactar mi asesor',
                'logout' => 'Cerrar sesión',
                'date' => 'Fecha',
                'description' => 'Descripción',
                'amount' => 'Monto',
                'no_accounts' => 'Sin cuentas',
                'no_accounts_text' => 'Aún no tiene cuentas activas.',
                'no_transactions' => 'Sin transacciones',
                'opened_on' => 'Abierto el',
            ]
        ];

        $t = $texts[$currentLocale];
    @endphp

    <x-slot name="title">{{ $t['title'] }}</x-slot>

    <!-- Header -->
    <div class="bg-gradient-to-r from-pink-600 to-pink-700 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">{{ $t['welcome'] }}, {{ $user->name }}</h1>
                    <p class="text-pink-100">{{ now()->format('l, d F Y') }}</p>
                </div>
                <form method="POST" action="{{ route('logout', ['locale' => $currentLocale]) }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-white/20 hover:bg-white/30 rounded-md transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        {{ $t['logout'] }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 rounded-md p-4">
                    <div class="flex">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="ml-3 text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Total Balance Card -->
            <div class="bg-gradient-to-br from-pink-600 to-purple-700 rounded-lg shadow-lg p-8 mb-8 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-pink-100 text-sm mb-2">{{ $t['total_balance'] }}</p>
                        <h2 class="text-4xl font-bold">{{ number_format($totalBalance, 2, '.', "'") }} CHF</h2>
                    </div>
                    <div class="text-white/20">
                        <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05.82 1.87 2.65 1.87 1.96 0 2.4-.98 2.4-1.59 0-.83-.44-1.61-2.67-2.14-2.48-.6-4.18-1.62-4.18-3.67 0-1.72 1.39-2.84 3.11-3.21V4h2.67v1.95c1.86.45 2.79 1.86 2.85 3.39H14.3c-.05-1.11-.64-1.87-2.22-1.87-1.5 0-2.4.68-2.4 1.64 0 .84.65 1.39 2.67 1.91s4.18 1.39 4.18 3.91c-.01 1.83-1.38 2.83-3.12 3.16z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Accounts Section -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-2xl font-bold text-gray-900">{{ $t['accounts'] }}</h2>
                    </div>

                    @forelse($accounts as $account)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-4">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $account->account_type }}</h3>
                                        <p class="text-sm text-gray-500">{{ $t['opened_on'] }} {{ $account->opened_at->format('d.m.Y') }}</p>
                                    </div>
                                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">
                                        {{ $account->currency }}
                                    </span>
                                </div>

                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">{{ $t['account_number'] }}</p>
                                        <p class="font-mono text-sm font-medium">{{ $account->account_number }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">{{ $t['iban'] }}</p>
                                        <p class="font-mono text-xs font-medium">{{ trim($account->formatted_iban) }}</p>
                                    </div>
                                </div>

                                <div class="border-t pt-4 flex items-center justify-between">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">{{ $t['balance'] }}</p>
                                        <p class="text-2xl font-bold text-gray-900">{{ $account->formatted_balance }}</p>
                                    </div>
                                    <a href="{{ route('dashboard.account', ['locale' => $currentLocale, 'id' => $account->id]) }}"
                                       class="inline-flex items-center px-4 py-2 bg-pink-600 text-white rounded-md hover:bg-pink-700 transition-colors">
                                        {{ $t['view_account'] }}
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white rounded-lg shadow-md p-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">{{ $t['no_accounts'] }}</h3>
                            <p class="mt-1 text-sm text-gray-500">{{ $t['no_accounts_text'] }}</p>
                        </div>
                    @endforelse

                    <!-- Recent Transactions -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-bold text-gray-900">{{ $t['recent_transactions'] }}</h3>
                        </div>
                        <div class="divide-y divide-gray-200">
                            @forelse($recentTransactions as $transaction)
                                <div class="px-6 py-4 hover:bg-gray-50">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <p class="font-medium text-gray-900">{{ $transaction->description }}</p>
                                            <p class="text-sm text-gray-500">{{ $transaction->transaction_date->format('d.m.Y H:i') }}</p>
                                            @if($transaction->recipient_name)
                                                <p class="text-xs text-gray-400 mt-1">{{ $transaction->recipient_name }}</p>
                                            @endif
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold {{ $transaction->type === 'debit' ? 'text-red-600' : 'text-green-600' }}">
                                                {{ $transaction->formatted_amount }}
                                            </p>
                                            <p class="text-xs text-gray-500">{{ $transaction->reference }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="px-6 py-12 text-center text-gray-500">
                                    {{ $t['no_transactions'] }}
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Sidebar - Quick Actions -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">{{ $t['quick_actions'] }}</h3>
                        <div class="space-y-3">
                            <a href="{{ route('dashboard.transfer', ['locale' => $currentLocale]) }}"
                               class="block w-full px-4 py-3 bg-pink-600 text-white rounded-md hover:bg-pink-700 transition-colors text-center font-medium">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                </svg>
                                {{ $t['new_transfer'] }}
                            </a>
                            <a href="{{ route('credit.request', ['locale' => $currentLocale]) }}"
                               class="block w-full px-4 py-3 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-colors text-center font-medium">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $t['request_credit'] }}
                            </a>
                            <a href="{{ route('contact', ['locale' => $currentLocale]) }}"
                               class="block w-full px-4 py-3 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-colors text-center font-medium">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                {{ $t['contact_advisor'] }}
                            </a>
                        </div>
                    </div>

                    <!-- Account Summary -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Résumé</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">{{ $t['accounts'] }}</span>
                                <span class="font-bold">{{ $accounts->count() }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Transactions (30j)</span>
                                <span class="font-bold">{{ $recentTransactions->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
