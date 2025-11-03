<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();

        $texts = [
            'fr' => [
                'title' => 'Nouveau virement',
                'back' => '← Retour au tableau de bord',
                'from_account' => 'Depuis le compte',
                'recipient_iban' => 'IBAN du bénéficiaire',
                'recipient_name' => 'Nom du bénéficiaire',
                'amount' => 'Montant',
                'description' => 'Motif du paiement',
                'description_placeholder' => 'Ex: Paiement facture, Remboursement...',
                'available_balance' => 'Solde disponible',
                'execute_transfer' => 'Exécuter le virement',
                'select_account' => 'Sélectionner un compte',
                'iban_help' => 'Format IBAN suisse: CH12 3456 7890 1234 5678 9',
            ],
            'de' => [
                'title' => 'Neue Überweisung',
                'back' => '← Zurück zum Dashboard',
                'from_account' => 'Von Konto',
                'recipient_iban' => 'IBAN des Empfängers',
                'recipient_name' => 'Name des Empfängers',
                'amount' => 'Betrag',
                'description' => 'Zahlungsgrund',
                'description_placeholder' => 'Z.B.: Rechnungszahlung, Rückzahlung...',
                'available_balance' => 'Verfügbarer Saldo',
                'execute_transfer' => 'Überweisung ausführen',
                'select_account' => 'Konto wählen',
                'iban_help' => 'Schweizer IBAN-Format: CH12 3456 7890 1234 5678 9',
            ],
            'en' => [
                'title' => 'New transfer',
                'back' => '← Back to dashboard',
                'from_account' => 'From account',
                'recipient_iban' => 'Recipient IBAN',
                'recipient_name' => 'Recipient name',
                'amount' => 'Amount',
                'description' => 'Payment reason',
                'description_placeholder' => 'E.g.: Invoice payment, Reimbursement...',
                'available_balance' => 'Available balance',
                'execute_transfer' => 'Execute transfer',
                'select_account' => 'Select account',
                'iban_help' => 'Swiss IBAN format: CH12 3456 7890 1234 5678 9',
            ],
            'es' => [
                'title' => 'Nueva transferencia',
                'back' => '← Volver al panel',
                'from_account' => 'Desde cuenta',
                'recipient_iban' => 'IBAN del beneficiario',
                'recipient_name' => 'Nombre del beneficiario',
                'amount' => 'Monto',
                'description' => 'Motivo del pago',
                'description_placeholder' => 'Ej: Pago de factura, Reembolso...',
                'available_balance' => 'Saldo disponible',
                'execute_transfer' => 'Ejecutar transferencia',
                'select_account' => 'Seleccionar cuenta',
                'iban_help' => 'Formato IBAN suizo: CH12 3456 7890 1234 5678 9',
            ]
        ];

        $t = $texts[$currentLocale];
    @endphp

    <x-slot name="title">{{ $t['title'] }}</x-slot>

    <!-- Header -->
    <div class="bg-gradient-to-r from-pink-600 to-pink-700 text-white py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('dashboard.index', ['locale' => $currentLocale]) }}" class="inline-flex items-center text-pink-100 hover:text-white mb-4 transition-colors">
                {{ $t['back'] }}
            </a>
            <h1 class="text-3xl font-bold">{{ $t['title'] }}</h1>
        </div>
    </div>

    <!-- Transfer Form -->
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md p-8">
                @if($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-md p-4">
                        <div class="flex">
                            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div class="ml-3">
                                <ul class="text-sm text-red-700 list-disc list-inside">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('dashboard.transfer.store', ['locale' => $currentLocale]) }}" class="space-y-6" x-data="transferForm()">
                    @csrf

                    <!-- From Account -->
                    <div>
                        <label for="from_account" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $t['from_account'] }} <span class="text-red-500">*</span>
                        </label>
                        <select id="from_account" name="from_account" required x-model="selectedAccount"
                                class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                            <option value="">{{ $t['select_account'] }}</option>
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}" data-balance="{{ $account->available_balance }}">
                                    {{ $account->account_type }} - {{ $account->account_number }} ({{ $account->formatted_balance }})
                                </option>
                            @endforeach
                        </select>
                        <template x-if="selectedAccount && availableBalance">
                            <p class="mt-1 text-sm text-gray-600">
                                {{ $t['available_balance'] }}: <span class="font-bold" x-text="formatBalance(availableBalance)"></span>
                            </p>
                        </template>
                    </div>

                    <!-- Recipient IBAN -->
                    <div>
                        <label for="recipient_iban" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $t['recipient_iban'] }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="recipient_iban" name="recipient_iban" required
                               placeholder="CH12 3456 7890 1234 5678 9"
                               class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500 font-mono">
                        <p class="mt-1 text-xs text-gray-500">{{ $t['iban_help'] }}</p>
                    </div>

                    <!-- Recipient Name -->
                    <div>
                        <label for="recipient_name" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $t['recipient_name'] }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="recipient_name" name="recipient_name" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                    </div>

                    <!-- Amount -->
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $t['amount'] }} (CHF) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="amount" name="amount" step="0.01" min="0.01" required x-model="amount"
                               class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                        <template x-if="selectedAccount && amount && parseFloat(amount) > availableBalance">
                            <p class="mt-1 text-sm text-red-600">Montant supérieur au solde disponible</p>
                        </template>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $t['description'] }}
                        </label>
                        <textarea id="description" name="description" rows="3"
                                  placeholder="{{ $t['description_placeholder'] }}"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit"
                                :disabled="selectedAccount && amount && parseFloat(amount) > availableBalance"
                                :class="{'opacity-50 cursor-not-allowed': selectedAccount && amount && parseFloat(amount) > availableBalance}"
                                class="w-full bg-pink-600 hover:bg-pink-700 text-white font-semibold py-4 rounded-md transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                            {{ $t['execute_transfer'] }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- Security Notice -->
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-md p-4">
                <div class="flex">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="ml-3 text-sm text-blue-700">
                        {{ $currentLocale === 'fr' ? 'Vos virements sont sécurisés et traités immédiatement. En cas de problème, contactez votre conseiller.' :
                           ($currentLocale === 'de' ? 'Ihre Überweisungen sind sicher und werden sofort verarbeitet. Bei Problemen wenden Sie sich an Ihren Berater.' :
                           ($currentLocale === 'en' ? 'Your transfers are secure and processed immediately. If you have any problems, contact your advisor.' :
                           'Sus transferencias son seguras y se procesan inmediatamente. Si tiene algún problema, contacte a su asesor.')) }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function transferForm() {
            return {
                selectedAccount: '',
                amount: '',
                availableBalance: 0,
                init() {
                    this.$watch('selectedAccount', value => {
                        if (value) {
                            const select = document.getElementById('from_account');
                            const option = select.options[select.selectedIndex];
                            this.availableBalance = parseFloat(option.dataset.balance) || 0;
                        } else {
                            this.availableBalance = 0;
                        }
                    });
                },
                formatBalance(balance) {
                    return new Intl.NumberFormat('fr-CH', {
                        style: 'currency',
                        currency: 'CHF'
                    }).format(balance);
                }
            }
        }
    </script>
</x-layouts.app>
