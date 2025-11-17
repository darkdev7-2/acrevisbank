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
    <x-slot name="pageTitle">{{ $t['title'] }}</x-slot>
    <x-slot name="pageSubtitle">Vérifiez les informations avant validation</x-slot>

    <!-- Confirmation Content -->
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="max-w-3xl mx-auto">
            <div class="mb-6">
                <a href="{{ route('dashboard.transfer', ['locale' => $currentLocale]) }}"
                   class="inline-flex items-center text-slate-600 hover:text-slate-900 font-medium transition-colors text-sm">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    {{ $t['back'] }}
                </a>
            </div>

            <!-- Warning Banner -->
            <div class="mb-6 bg-amber-50 border border-amber-200 rounded-lg p-4">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <div class="ml-3">
                        <h3 class="text-sm font-semibold text-amber-900">{{ $t['warning'] }}</h3>
                        <p class="mt-1 text-sm text-amber-800">{{ $t['warning_text'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Summary Card -->
            <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 bg-slate-50 border-b border-slate-200">
                    <h2 class="text-lg font-bold text-slate-900">{{ $t['summary'] }}</h2>
                </div>

                <div class="p-6 space-y-6">
                    <!-- From Account -->
                    <div>
                        <p class="text-xs font-medium text-slate-500 mb-2 uppercase tracking-wider">{{ $t['from_account'] }}</p>
                        <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                            <p class="font-semibold text-base text-slate-900">{{ $account->account_type }}</p>
                            <p class="font-mono text-sm text-slate-600 mt-1">{{ $account->account_number }}</p>
                            <div class="mt-4 grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-xs text-slate-500 font-medium mb-1">{{ $t['account_balance'] }}</p>
                                    <p class="text-base font-bold text-slate-900">{{ number_format($account->balance, 2, '.', "'") }} {{ $account->currency }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500 font-medium mb-1">{{ $t['balance_after'] }}</p>
                                    <p class="text-base font-bold {{ $balanceAfter >= 0 ? 'text-emerald-600' : 'text-red-600' }}">
                                        {{ number_format($balanceAfter, 2, '.', "'") }} {{ $account->currency }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recipient -->
                    <div>
                        <p class="text-xs font-medium text-slate-500 mb-2 uppercase tracking-wider">{{ $t['recipient'] }}</p>
                        <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                            <p class="font-semibold text-base text-slate-900">{{ $transferData['recipient_name'] }}</p>
                            <p class="text-xs text-slate-500 mt-2 font-medium">{{ $t['recipient_iban'] }}</p>
                            <p class="font-mono text-sm text-slate-900 mt-1">{{ chunk_split($transferData['recipient_iban'], 4, ' ') }}</p>
                        </div>
                    </div>

                    <!-- Amount -->
                    <div>
                        <p class="text-xs font-medium text-slate-500 mb-2 uppercase tracking-wider">{{ $t['amount'] }}</p>
                        <div class="bg-blue-50 rounded-lg p-5 border-2 border-blue-200">
                            <div class="flex items-baseline">
                                <p class="text-3xl font-bold text-blue-700">
                                    {{ number_format($transferData['amount'], 2, '.', "'") }}
                                </p>
                                <p class="ml-2 text-lg font-semibold text-blue-600">{{ $account->currency }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    @if($transferData['description'])
                        <div>
                            <p class="text-xs font-medium text-slate-500 mb-2 uppercase tracking-wider">{{ $t['description'] }}</p>
                            <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                                <p class="text-sm text-slate-900">{{ $transferData['description'] }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Actions -->
                <div class="px-6 py-4 bg-slate-50 border-t border-slate-200">
                    <form method="POST" action="{{ route('dashboard.transfer.execute', ['locale' => $currentLocale]) }}" class="flex items-center justify-end space-x-3">
                        @csrf
                        <a href="{{ route('dashboard.transfer', ['locale' => $currentLocale]) }}"
                           class="px-6 py-3 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-100 transition-colors font-medium text-sm">
                            {{ $t['cancel'] }}
                        </a>
                        <button type="submit"
                                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors text-sm shadow-sm inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
