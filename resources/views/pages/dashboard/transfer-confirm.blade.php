<x-layouts.dashboard>
    @php
        $currentLocale = app()->getLocale();

        $texts = [
            'fr' => [
                'title' => 'Confirmer le virement',
                'back' => '← Retour',
                'summary' => 'Récapitulatif du virement',
                'from_account' => 'Depuis le compte',
                'recipient' => 'Bénéficiaire',
                'recipient_iban' => 'IBAN du bénéficiaire',
                'amount' => 'Montant',
                'description' => 'Description',
                'no_description' => 'Aucune description',
                'account_balance' => 'Solde actuel',
                'balance_after' => 'Solde après virement',
                'confirm' => 'Confirmer et exécuter',
                'cancel' => 'Annuler',
                'warning' => 'Attention',
                'warning_text' => 'Cette opération est irréversible. Veuillez vérifier attentivement les informations avant de confirmer.',
            ],
            'de' => [
                'title' => 'Überweisung bestätigen',
                'back' => '← Zurück',
                'summary' => 'Zusammenfassung der Überweisung',
                'from_account' => 'Von Konto',
                'recipient' => 'Empfänger',
                'recipient_iban' => 'IBAN des Empfängers',
                'amount' => 'Betrag',
                'description' => 'Beschreibung',
                'no_description' => 'Keine Beschreibung',
                'account_balance' => 'Aktueller Saldo',
                'balance_after' => 'Saldo nach Überweisung',
                'confirm' => 'Bestätigen und ausführen',
                'cancel' => 'Abbrechen',
                'warning' => 'Achtung',
                'warning_text' => 'Dieser Vorgang ist unwiderruflich. Bitte überprüfen Sie die Informationen sorgfältig, bevor Sie bestätigen.',
            ],
            'en' => [
                'title' => 'Confirm transfer',
                'back' => '← Back',
                'summary' => 'Transfer summary',
                'from_account' => 'From account',
                'recipient' => 'Recipient',
                'recipient_iban' => 'Recipient IBAN',
                'amount' => 'Amount',
                'description' => 'Description',
                'no_description' => 'No description',
                'account_balance' => 'Current balance',
                'balance_after' => 'Balance after transfer',
                'confirm' => 'Confirm and execute',
                'cancel' => 'Cancel',
                'warning' => 'Warning',
                'warning_text' => 'This operation is irreversible. Please check the information carefully before confirming.',
            ],
            'es' => [
                'title' => 'Confirmar transferencia',
                'back' => '← Volver',
                'summary' => 'Resumen de la transferencia',
                'from_account' => 'Desde cuenta',
                'recipient' => 'Beneficiario',
                'recipient_iban' => 'IBAN del beneficiario',
                'amount' => 'Monto',
                'description' => 'Descripción',
                'no_description' => 'Sin descripción',
                'account_balance' => 'Saldo actual',
                'balance_after' => 'Saldo después de la transferencia',
                'confirm' => 'Confirmar y ejecutar',
                'cancel' => 'Cancelar',
                'warning' => 'Advertencia',
                'warning_text' => 'Esta operación es irreversible. Por favor, verifique la información cuidadosamente antes de confirmar.',
            ]
        ];

        $t = $texts[$currentLocale];
        $balanceAfter = $account->balance - $transferData['amount'];
    @endphp

    <x-slot name="title">{{ $t['title'] }}</x-slot>

    <!-- Header -->
    <div class="bg-gradient-to-r from-pink-600 to-pink-700 text-white py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('dashboard.transfer', ['locale' => $currentLocale]) }}" class="inline-flex items-center text-pink-100 hover:text-white mb-4 transition-colors">
                {{ $t['back'] }}
            </a>
            <h1 class="text-3xl font-bold">{{ $t['title'] }}</h1>
        </div>
    </div>

    <!-- Confirmation Content -->
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Warning Banner -->
            <div class="mb-6 bg-yellow-50 border border-yellow-200 rounded-md p-4">
                <div class="flex">
                    <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-yellow-800">{{ $t['warning'] }}</h3>
                        <p class="mt-1 text-sm text-yellow-700">{{ $t['warning_text'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Summary Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900">{{ $t['summary'] }}</h2>
                </div>

                <div class="p-6 space-y-6">
                    <!-- From Account -->
                    <div>
                        <p class="text-sm text-gray-500 mb-2">{{ $t['from_account'] }}</p>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="font-bold text-lg text-gray-900">{{ $account->account_type }}</p>
                            <p class="font-mono text-sm text-gray-600 mt-1">{{ $account->account_number }}</p>
                            <div class="mt-3 grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-xs text-gray-500">{{ $t['account_balance'] }}</p>
                                    <p class="text-lg font-bold text-gray-900">{{ number_format($account->balance, 2, '.', "'") }} {{ $account->currency }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">{{ $t['balance_after'] }}</p>
                                    <p class="text-lg font-bold {{ $balanceAfter >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ number_format($balanceAfter, 2, '.', "'") }} {{ $account->currency }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recipient -->
                    <div>
                        <p class="text-sm text-gray-500 mb-2">{{ $t['recipient'] }}</p>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="font-bold text-lg text-gray-900">{{ $transferData['recipient_name'] }}</p>
                            <p class="text-sm text-gray-500 mt-1">{{ $t['recipient_iban'] }}</p>
                            <p class="font-mono text-sm text-gray-900 mt-1">{{ chunk_split($transferData['recipient_iban'], 4, ' ') }}</p>
                        </div>
                    </div>

                    <!-- Amount -->
                    <div>
                        <p class="text-sm text-gray-500 mb-2">{{ $t['amount'] }}</p>
                        <div class="bg-pink-50 rounded-lg p-4 border-2 border-pink-200">
                            <p class="text-3xl font-bold text-pink-600">
                                {{ number_format($transferData['amount'], 2, '.', "'") }} {{ $account->currency }}
                            </p>
                        </div>
                    </div>

                    <!-- Description -->
                    @if($transferData['description'])
                        <div>
                            <p class="text-sm text-gray-500 mb-2">{{ $t['description'] }}</p>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-900">{{ $transferData['description'] }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Actions -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <form method="POST" action="{{ route('dashboard.transfer.execute', ['locale' => $currentLocale]) }}" class="flex items-center justify-end space-x-3">
                        @csrf
                        <a href="{{ route('dashboard.transfer', ['locale' => $currentLocale]) }}"
                           class="px-6 py-3 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100 transition-colors font-medium">
                            {{ $t['cancel'] }}
                        </a>
                        <button type="submit"
                                class="px-6 py-3 bg-pink-600 hover:bg-pink-700 text-white font-semibold rounded-md transition-colors">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ $t['confirm'] }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
