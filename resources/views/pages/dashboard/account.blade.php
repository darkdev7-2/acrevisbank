<x-layouts.app>
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
            ]
        ];

        $t = $texts[$currentLocale];
    @endphp

    <x-slot name="title">{{ $account->account_type }}</x-slot>

    <!-- Header -->
    <div class="bg-gradient-to-r from-pink-600 to-pink-700 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('dashboard.index', ['locale' => $currentLocale]) }}" class="inline-flex items-center text-pink-100 hover:text-white mb-4 transition-colors">
                {{ $t['back'] }}
            </a>
            <div class="flex items-start justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">{{ $account->account_type }}</h1>
                    <p class="text-pink-100">{{ $t['opened_on'] }} {{ $account->opened_at->format('d.m.Y') }}</p>
                </div>
                <div class="text-right">
                    <p class="text-pink-100 text-sm mb-1">{{ $t['balance'] }}</p>
                    <p class="text-3xl font-bold">{{ $account->formatted_balance }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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

            <!-- Actions Bar -->
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">{{ $t['transactions'] }}</h2>
                <div class="flex gap-3">
                    <a href="{{ route('dashboard.transfer', ['locale' => $currentLocale]) }}"
                       class="inline-flex items-center px-4 py-2 bg-pink-600 text-white rounded-md hover:bg-pink-700 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                        </svg>
                        {{ $t['new_transfer'] }}
                    </a>
                </div>
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
    </div>
</x-layouts.app>
