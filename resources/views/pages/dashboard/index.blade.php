<x-layouts.dashboard>
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
                'date' => 'Date',
                'description' => 'Description',
                'amount' => 'Montant',
                'no_accounts' => 'Aucun compte',
                'no_accounts_text' => 'Vous n\'avez pas encore de compte actif.',
                'no_transactions' => 'Aucune transaction',
                'opened_on' => 'Ouvert le',
                'total_accounts' => 'Comptes',
                'recent_activity' => 'Activité récente',
                'monthly_summary' => 'Résumé mensuel',
                'income' => 'Revenus',
                'expenses' => 'Dépenses',
                'transfer_success' => 'Virement effectué avec succès',
                'reference' => 'Référence',
                'beneficiary' => 'Bénéficiaire',
                'download_receipt' => 'Télécharger le reçu',
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
                'view_all' => 'Alle ansehen',
                'view_account' => 'Konto ansehen',
                'quick_actions' => 'Schnellaktionen',
                'new_transfer' => 'Neue Überweisung',
                'request_credit' => 'Kredit beantragen',
                'contact_advisor' => 'Berater kontaktieren',
                'date' => 'Datum',
                'description' => 'Beschreibung',
                'amount' => 'Betrag',
                'no_accounts' => 'Keine Konten',
                'no_accounts_text' => 'Sie haben noch kein aktives Konto.',
                'no_transactions' => 'Keine Transaktionen',
                'opened_on' => 'Eröffnet am',
                'total_accounts' => 'Konten',
                'recent_activity' => 'Letzte Aktivität',
                'monthly_summary' => 'Monatszusammenfassung',
                'income' => 'Einnahmen',
                'expenses' => 'Ausgaben',
                'transfer_success' => 'Überweisung erfolgreich durchgeführt',
                'reference' => 'Referenz',
                'beneficiary' => 'Empfänger',
                'download_receipt' => 'Beleg herunterladen',
            ],
            'en' => [
                'title' => 'My client area',
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
                'contact_advisor' => 'Contact advisor',
                'date' => 'Date',
                'description' => 'Description',
                'amount' => 'Amount',
                'no_accounts' => 'No accounts',
                'no_accounts_text' => 'You don\'t have an active account yet.',
                'no_transactions' => 'No transactions',
                'opened_on' => 'Opened on',
                'total_accounts' => 'Accounts',
                'recent_activity' => 'Recent activity',
                'monthly_summary' => 'Monthly summary',
                'income' => 'Income',
                'expenses' => 'Expenses',
                'transfer_success' => 'Transfer completed successfully',
                'reference' => 'Reference',
                'beneficiary' => 'Beneficiary',
                'download_receipt' => 'Download receipt',
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
                'contact_advisor' => 'Contactar asesor',
                'date' => 'Fecha',
                'description' => 'Descripción',
                'amount' => 'Monto',
                'no_accounts' => 'Sin cuentas',
                'no_accounts_text' => 'Aún no tiene una cuenta activa.',
                'no_transactions' => 'Sin transacciones',
                'opened_on' => 'Abierto el',
                'total_accounts' => 'Cuentas',
                'recent_activity' => 'Actividad reciente',
                'monthly_summary' => 'Resumen mensual',
                'income' => 'Ingresos',
                'expenses' => 'Gastos',
                'transfer_success' => 'Transferencia realizada con éxito',
                'reference' => 'Referencia',
                'beneficiary' => 'Beneficiario',
                'download_receipt' => 'Descargar recibo',
            ],
        ];

        $t = $texts[$currentLocale] ?? $texts['fr'];
    @endphp

    <x-slot name="title">{{ $t['title'] }}</x-slot>
    <x-slot name="pageTitle">{{ $t['welcome'] }}, {{ $user->first_name ?? $user->name }}</x-slot>
    <x-slot name="pageSubtitle">{{ now()->locale($currentLocale)->isoFormat('dddd, D MMMM YYYY') }}</x-slot>
    <x-slot name="showBalance">true</x-slot>
    <x-slot name="totalBalance">{{ number_format($totalBalance, 2, '.', "'") }}</x-slot>

    <div class="p-4 sm:p-6 lg:p-8">
        <!-- Success Messages -->
        @if(session('success'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-400 rounded-r-lg p-4 shadow-sm">
                <div class="flex">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="ml-3 text-sm text-green-700 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('transfer_success'))
            <div class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-300 rounded-xl p-6 shadow-lg">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-bold text-green-900">{{ $t['transfer_success'] }}</h3>
                            <div class="mt-2 space-y-1">
                                <p class="text-sm text-green-800">
                                    <span class="font-medium">{{ $t['reference'] }}:</span>
                                    <span class="font-mono ml-2">{{ session('transfer_success')['reference'] }}</span>
                                </p>
                                <p class="text-sm text-green-800">
                                    <span class="font-medium">{{ $t['amount'] }}:</span>
                                    <span class="font-bold ml-2">{{ number_format(session('transfer_success')['amount'], 2, '.', "'") }} CHF</span>
                                </p>
                                <p class="text-sm text-green-800">
                                    <span class="font-medium">{{ $t['beneficiary'] }}:</span>
                                    <span class="ml-2">{{ session('transfer_success')['recipient_name'] }}</span>
                                </p>
                                @if(session('transfer_success')['recipient_iban'])
                                    <p class="text-xs text-green-700 font-mono">
                                        {{ session('transfer_success')['recipient_iban'] }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('dashboard.transaction.receipt', ['locale' => $currentLocale, 'transactionId' => session('transfer_success')['transaction_id']]) }}"
                       target="_blank"
                       class="inline-flex items-center justify-center px-5 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all font-medium shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        {{ $t['download_receipt'] }}
                    </a>
                </div>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Balance -->
            <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-pink-100 text-sm font-medium mb-1">{{ $t['total_balance'] }}</p>
                        <h3 class="text-3xl font-bold">{{ number_format($totalBalance, 2, '.', "'") }}</h3>
                        <p class="text-pink-100 text-xs mt-1">CHF</p>
                    </div>
                    <div class="bg-white/20 rounded-full p-3">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05.82 1.87 2.65 1.87 1.96 0 2.4-.98 2.4-1.59 0-.83-.44-1.61-2.67-2.14-2.48-.6-4.18-1.62-4.18-3.67 0-1.72 1.39-2.84 3.11-3.21V4h2.67v1.95c1.86.45 2.79 1.86 2.85 3.39H14.3c-.05-1.11-.64-1.87-2.22-1.87-1.5 0-2.4.68-2.4 1.64 0 .84.65 1.39 2.67 1.91s4.18 1.39 4.18 3.91c-.01 1.83-1.38 2.83-3.12 3.16z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Accounts -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">{{ $t['total_accounts'] }}</p>
                        <h3 class="text-3xl font-bold text-gray-900">{{ $accounts->count() }}</h3>
                        <p class="text-gray-400 text-xs mt-1">actifs</p>
                    </div>
                    <div class="bg-blue-100 rounded-full p-3">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Transactions (30j)</p>
                        <h3 class="text-3xl font-bold text-gray-900">{{ $recentTransactions->count() }}</h3>
                        <p class="text-gray-400 text-xs mt-1">ce mois</p>
                    </div>
                    <div class="bg-purple-100 rounded-full p-3">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Quick Transfer -->
            <a href="{{ route('dashboard.transfer', ['locale' => $currentLocale]) }}"
               class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl shadow-lg p-6 text-white hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-emerald-100 text-sm font-medium mb-1">Action rapide</p>
                        <h3 class="text-xl font-bold">Nouveau virement</h3>
                        <p class="text-emerald-100 text-xs mt-1">Effectuer un transfert</p>
                    </div>
                    <div class="bg-white/20 rounded-full p-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </div>
                </div>
            </a>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Accounts List -->
            <div class="lg:col-span-2 space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold text-gray-900">{{ $t['accounts'] }}</h2>
                </div>

                @forelse($accounts as $account)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="bg-gradient-to-r from-pink-500 to-pink-600 px-6 py-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-xl font-bold text-white">{{ $account->account_type }}</h3>
                                    <p class="text-sm text-pink-100">{{ $t['opened_on'] }} {{ $account->opened_at->format('d.m.Y') }}</p>
                                </div>
                                <span class="px-4 py-2 bg-white/20 backdrop-blur-sm text-white rounded-full text-sm font-bold">
                                    {{ $account->currency }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">{{ $t['account_number'] }}</p>
                                    <p class="font-mono text-sm font-medium text-gray-900">{{ $account->account_number }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">{{ $t['iban'] }}</p>
                                    <p class="font-mono text-xs font-medium text-gray-900">{{ trim($account->formatted_iban) }}</p>
                                </div>
                            </div>

                            <div class="border-t pt-4 flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">{{ $t['balance'] }}</p>
                                    <p class="text-3xl font-bold text-gray-900">{{ $account->formatted_balance }}</p>
                                </div>
                                <a href="{{ route('dashboard.account', ['locale' => $currentLocale, 'id' => $account->id]) }}"
                                   class="inline-flex items-center px-5 py-2.5 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition-all font-medium shadow-sm hover:shadow-md transform hover:-translate-x-1">
                                    {{ $t['view_account'] }}
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl shadow-md p-12 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-1">{{ $t['no_accounts'] }}</h3>
                        <p class="text-sm text-gray-500">{{ $t['no_accounts_text'] }}</p>
                    </div>
                @endforelse
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Recent Transactions -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <h3 class="text-lg font-bold text-gray-900">{{ $t['recent_transactions'] }}</h3>
                    </div>
                    <div class="divide-y divide-gray-100">
                        @forelse($recentTransactions->take(5) as $transaction)
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1 min-w-0">
                                        <p class="font-medium text-gray-900 truncate">{{ $transaction->description }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $transaction->transaction_date->format('d.m.Y H:i') }}</p>
                                        @if($transaction->recipient_name)
                                            <p class="text-xs text-gray-400 mt-1 truncate">{{ $transaction->recipient_name }}</p>
                                        @endif
                                    </div>
                                    <div class="text-right ml-4">
                                        <p class="font-bold text-sm {{ $transaction->type === 'debit' ? 'text-red-600' : 'text-green-600' }}">
                                            {{ $transaction->formatted_amount }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="px-6 py-12 text-center text-gray-500 text-sm">
                                {{ $t['no_transactions'] }}
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">{{ $t['quick_actions'] }}</h3>
                    <div class="space-y-3">
                        <a href="{{ route('dashboard.beneficiaries.index', ['locale' => $currentLocale]) }}"
                           class="block w-full px-4 py-3 bg-gray-50 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors text-center font-medium border border-gray-200">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Bénéficiaires
                        </a>
                        <a href="{{ route('contact', ['locale' => $currentLocale]) }}"
                           class="block w-full px-4 py-3 bg-gray-50 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors text-center font-medium border border-gray-200">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            {{ $t['contact_advisor'] }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
