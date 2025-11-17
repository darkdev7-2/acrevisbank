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
                'total_accounts' => 'Comptes actifs',
                'recent_activity' => 'Activité récente',
                'monthly_summary' => 'Résumé mensuel',
                'income' => 'Revenus',
                'expenses' => 'Dépenses',
                'transfer_success' => 'Virement effectué avec succès',
                'reference' => 'Référence',
                'beneficiary' => 'Bénéficiaire',
                'download_receipt' => 'Télécharger le reçu',
                'manage_beneficiaries' => 'Gérer les bénéficiaires',
                'total_transactions' => 'Transactions',
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
                'total_accounts' => 'Aktive Konten',
                'recent_activity' => 'Letzte Aktivität',
                'monthly_summary' => 'Monatszusammenfassung',
                'income' => 'Einnahmen',
                'expenses' => 'Ausgaben',
                'transfer_success' => 'Überweisung erfolgreich durchgeführt',
                'reference' => 'Referenz',
                'beneficiary' => 'Empfänger',
                'download_receipt' => 'Beleg herunterladen',
                'manage_beneficiaries' => 'Empfänger verwalten',
                'total_transactions' => 'Transaktionen',
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
                'total_accounts' => 'Active accounts',
                'recent_activity' => 'Recent activity',
                'monthly_summary' => 'Monthly summary',
                'income' => 'Income',
                'expenses' => 'Expenses',
                'transfer_success' => 'Transfer completed successfully',
                'reference' => 'Reference',
                'beneficiary' => 'Beneficiary',
                'download_receipt' => 'Download receipt',
                'manage_beneficiaries' => 'Manage beneficiaries',
                'total_transactions' => 'Transactions',
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
                'total_accounts' => 'Cuentas activas',
                'recent_activity' => 'Actividad reciente',
                'monthly_summary' => 'Resumen mensual',
                'income' => 'Ingresos',
                'expenses' => 'Gastos',
                'transfer_success' => 'Transferencia realizada con éxito',
                'reference' => 'Referencia',
                'beneficiary' => 'Beneficiario',
                'download_receipt' => 'Descargar recibo',
                'manage_beneficiaries' => 'Administrar beneficiarios',
                'total_transactions' => 'Transacciones',
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
            <div class="mb-6 bg-emerald-50 border border-emerald-200 rounded-lg p-4">
                <div class="flex">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="ml-3 text-sm text-emerald-800 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('transfer_success'))
            <div class="mb-6 bg-white border border-emerald-200 rounded-lg p-6 shadow-sm">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-base font-semibold text-slate-900">{{ $t['transfer_success'] }}</h3>
                            <div class="mt-2 space-y-1 text-sm text-slate-600">
                                <p><span class="font-medium text-slate-700">{{ $t['reference'] }}:</span> <span class="font-mono ml-2">{{ session('transfer_success')['reference'] }}</span></p>
                                <p><span class="font-medium text-slate-700">{{ $t['amount'] }}:</span> <span class="font-semibold ml-2">{{ number_format(session('transfer_success')['amount'], 2, '.', "'") }} CHF</span></p>
                                <p><span class="font-medium text-slate-700">{{ $t['beneficiary'] }}:</span> <span class="ml-2">{{ session('transfer_success')['recipient_name'] }}</span></p>
                                @if(session('transfer_success')['recipient_iban'])
                                    <p class="text-xs text-slate-500 font-mono">{{ session('transfer_success')['recipient_iban'] }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('dashboard.transaction.receipt', ['locale' => $currentLocale, 'transactionId' => session('transfer_success')['transaction_id']]) }}"
                       target="_blank"
                       class="inline-flex items-center justify-center px-4 py-2 bg-emerald-600 text-white text-sm rounded-lg hover:bg-emerald-700 transition-colors font-medium">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        {{ $t['download_receipt'] }}
                    </a>
                </div>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Total Balance -->
            <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-6 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-slate-600 mb-1">{{ $t['total_balance'] }}</p>
                        <h3 class="text-3xl font-bold text-slate-900 mb-1">{{ number_format($totalBalance, 2, '.', "'") }}</h3>
                        <p class="text-xs text-slate-500 font-medium">CHF</p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Accounts -->
            <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-6 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-slate-600 mb-1">{{ $t['total_accounts'] }}</p>
                        <h3 class="text-3xl font-bold text-slate-900 mb-1">{{ $accounts->count() }}</h3>
                        <p class="text-xs text-slate-500">{{ $accounts->count() > 1 ? 'comptes' : 'compte' }}</p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-slate-50 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Transfer -->
            <a href="{{ route('dashboard.transfer', ['locale' => $currentLocale]) }}"
               class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg shadow-sm p-6 text-white hover:shadow-md transition-all group">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <p class="text-blue-100 text-sm font-medium mb-1">Action rapide</p>
                        <h3 class="text-xl font-semibold mb-1">{{ $t['new_transfer'] }}</h3>
                        <p class="text-blue-100 text-xs">Effectuer un virement</p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-white/10 rounded-lg flex items-center justify-center group-hover:bg-white/20 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Accounts List -->
            <div class="lg:col-span-2 space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-slate-900">{{ $t['accounts'] }}</h2>
                </div>

                @forelse($accounts as $account)
                    <!-- Bank Card Style -->
                    <div class="relative bg-gradient-to-br from-slate-800 via-slate-900 to-slate-800 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow">
                        <!-- Card Background Pattern -->
                        <div class="absolute inset-0 opacity-10">
                            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5"/>
                                    </pattern>
                                </defs>
                                <rect width="100%" height="100%" fill="url(#grid)" />
                            </svg>
                        </div>

                        <div class="relative p-6">
                            <!-- Card Header -->
                            <div class="flex items-start justify-between mb-8">
                                <div>
                                    <div class="flex items-center space-x-2 mb-1">
                                        <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                                            </svg>
                                        </div>
                                        <span class="text-white font-semibold text-lg">Acrevis Bank</span>
                                    </div>
                                    <p class="text-slate-400 text-xs mt-2">{{ $account->account_type }}</p>
                                </div>
                                <div class="px-3 py-1 bg-white/10 backdrop-blur-sm rounded-full">
                                    <span class="text-white text-xs font-semibold">{{ $account->currency }}</span>
                                </div>
                            </div>

                            <!-- Account Number -->
                            <div class="mb-6">
                                <p class="text-slate-400 text-xs mb-1">IBAN</p>
                                <p class="text-white font-mono text-sm tracking-wider">{{ trim($account->formatted_iban) }}</p>
                            </div>

                            <!-- Balance & CTA -->
                            <div class="flex items-end justify-between pt-4 border-t border-white/10">
                                <div>
                                    <p class="text-slate-400 text-xs mb-1">{{ $t['balance'] }}</p>
                                    <p class="text-white text-2xl font-bold">{{ $account->formatted_balance }}</p>
                                </div>
                                <a href="{{ route('dashboard.account', ['locale' => $currentLocale, 'id' => $account->id]) }}"
                                   class="inline-flex items-center px-4 py-2 bg-white text-slate-900 rounded-lg hover:bg-slate-100 transition-colors text-sm font-medium">
                                    {{ $t['view_account'] }}
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-12 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-slate-100 rounded-full mb-4">
                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-slate-900 mb-1">{{ $t['no_accounts'] }}</h3>
                        <p class="text-sm text-slate-600">{{ $t['no_accounts_text'] }}</p>
                    </div>
                @endforelse
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Recent Transactions -->
                <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100">
                        <h3 class="text-base font-semibold text-slate-900">{{ $t['recent_transactions'] }}</h3>
                    </div>
                    <div class="divide-y divide-slate-100">
                        @forelse($recentTransactions->take(5) as $transaction)
                            <div class="px-5 py-4 hover:bg-slate-50 transition-colors">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1 min-w-0 mr-4">
                                        <p class="text-sm font-medium text-slate-900 truncate">{{ $transaction->description }}</p>
                                        <p class="text-xs text-slate-500 mt-1">{{ $transaction->transaction_date->format('d.m.Y H:i') }}</p>
                                        @if($transaction->recipient_name)
                                            <p class="text-xs text-slate-400 mt-1 truncate">{{ $transaction->recipient_name }}</p>
                                        @endif
                                    </div>
                                    <div class="text-right flex-shrink-0">
                                        <p class="text-sm font-semibold {{ $transaction->type === 'debit' ? 'text-red-600' : 'text-emerald-600' }}">
                                            {{ $transaction->formatted_amount }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="px-5 py-12 text-center">
                                <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                <p class="text-sm text-slate-500">{{ $t['no_transactions'] }}</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-5">
                    <h3 class="text-base font-semibold text-slate-900 mb-4">{{ $t['quick_actions'] }}</h3>
                    <div class="space-y-2">
                        <a href="{{ route('dashboard.beneficiaries.index', ['locale' => $currentLocale]) }}"
                           class="flex items-center w-full px-4 py-3 bg-slate-50 text-slate-700 rounded-lg hover:bg-slate-100 transition-colors text-sm font-medium border border-slate-200">
                            <svg class="w-5 h-5 mr-3 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            {{ $t['manage_beneficiaries'] }}
                        </a>
                        <a href="{{ route('contact', ['locale' => $currentLocale]) }}"
                           class="flex items-center w-full px-4 py-3 bg-slate-50 text-slate-700 rounded-lg hover:bg-slate-100 transition-colors text-sm font-medium border border-slate-200">
                            <svg class="w-5 h-5 mr-3 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
