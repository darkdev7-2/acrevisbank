<x-layouts.dashboard>
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
    <x-slot name="pageTitle">{{ $t['title'] }}</x-slot>
    <x-slot name="pageSubtitle">Virement bancaire sécurisé</x-slot>

    <!-- Transfer Form -->
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="max-w-3xl mx-auto">
            <div class="mb-6">
                <a href="{{ route('dashboard.index', ['locale' => $currentLocale]) }}"
                   class="inline-flex items-center text-slate-600 hover:text-slate-900 font-medium transition-colors text-sm">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    {{ $t['back'] }}
                </a>
            </div>

            <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-6 md:p-8">
                @if($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex">
                            <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div class="ml-3">
                                <ul class="text-sm text-red-700 space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('dashboard.transfer.confirm', ['locale' => $currentLocale]) }}" class="space-y-6" x-data="transferForm()">
                    @csrf

                    <!-- From Account -->
                    <div>
                        <label for="from_account" class="block text-sm font-semibold text-slate-700 mb-2">
                            {{ $t['from_account'] }} <span class="text-red-500">*</span>
                        </label>
                        <select id="from_account" name="from_account" required x-model="selectedAccount"
                                class="w-full px-4 py-3 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            <option value="">{{ $t['select_account'] }}</option>
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}" data-balance="{{ $account->available_balance }}">
                                    {{ $account->account_type }} - {{ $account->account_number }} ({{ $account->formatted_balance }})
                                </option>
                            @endforeach
                        </select>
                        <template x-if="selectedAccount && availableBalance">
                            <p class="mt-2 text-sm text-slate-600 flex items-center">
                                <svg class="w-4 h-4 mr-1.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $t['available_balance'] }}: <span class="font-semibold ml-1" x-text="formatBalance(availableBalance)"></span>
                            </p>
                        </template>
                    </div>

                    <!-- Beneficiary Selector -->
                    @if($beneficiaries->count() > 0)
                        <div>
                            <label for="beneficiary" class="block text-sm font-semibold text-slate-700 mb-2">
                                {{ $currentLocale === 'fr' ? 'Sélectionner un bénéficiaire (optionnel)' :
                                   ($currentLocale === 'de' ? 'Begünstigten auswählen (optional)' :
                                   ($currentLocale === 'en' ? 'Select a beneficiary (optional)' : 'Seleccionar beneficiario (opcional)')) }}
                            </label>
                            <select id="beneficiary" x-model="selectedBeneficiary" @change="fillBeneficiary()"
                                    class="w-full px-4 py-3 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                <option value="">{{ $currentLocale === 'fr' ? 'Saisir manuellement' :
                                   ($currentLocale === 'de' ? 'Manuell eingeben' :
                                   ($currentLocale === 'en' ? 'Enter manually' : 'Ingresar manualmente')) }}</option>
                                @foreach($beneficiaries as $beneficiary)
                                    <option value="{{ $beneficiary->id }}"
                                            data-iban="{{ trim($beneficiary->formatted_iban) }}"
                                            data-name="{{ $beneficiary->name }}">
                                        {{ $beneficiary->name }}{{ $beneficiary->is_favorite ? ' ⭐' : '' }}
                                    </option>
                                @endforeach
                            </select>
                            <a href="{{ route('dashboard.beneficiaries.index', ['locale' => $currentLocale]) }}"
                               class="mt-2 text-xs text-blue-600 hover:text-blue-700 inline-flex items-center font-medium">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $currentLocale === 'fr' ? 'Gérer mes bénéficiaires' :
                                   ($currentLocale === 'de' ? 'Begünstigte verwalten' :
                                   ($currentLocale === 'en' ? 'Manage beneficiaries' : 'Gestionar beneficiarios')) }}
                            </a>
                        </div>
                    @else
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-800">
                                        {{ $currentLocale === 'fr' ? 'Astuce : Enregistrez vos bénéficiaires fréquents pour gagner du temps lors de vos prochains virements.' :
                                           ($currentLocale === 'de' ? 'Tipp: Speichern Sie Ihre häufigen Empfänger, um bei Ihren nächsten Überweisungen Zeit zu sparen.' :
                                           ($currentLocale === 'en' ? 'Tip: Save your frequent recipients to save time on your next transfers.' : 'Consejo: Guarde sus destinatarios frecuentes para ahorrar tiempo en sus próximas transferencias.')) }}
                                    </p>
                                    <a href="{{ route('dashboard.beneficiaries.create', ['locale' => $currentLocale]) }}"
                                       class="mt-2 text-sm font-semibold text-blue-700 hover:text-blue-800 inline-flex items-center">
                                        {{ $currentLocale === 'fr' ? 'Ajouter un bénéficiaire' :
                                           ($currentLocale === 'de' ? 'Begünstigten hinzufügen' :
                                           ($currentLocale === 'en' ? 'Add a beneficiary' : 'Agregar beneficiario')) }} →
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 gap-6">
                        <!-- Recipient IBAN -->
                        <div>
                            <label for="recipient_iban" class="block text-sm font-semibold text-slate-700 mb-2">
                                {{ $t['recipient_iban'] }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="recipient_iban" name="recipient_iban" required x-model="recipientIban"
                                   placeholder="CH12 3456 7890 1234 5678 9"
                                   class="w-full px-4 py-3 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 font-mono transition-colors">
                            <p class="mt-1.5 text-xs text-slate-500">{{ $t['iban_help'] }}</p>
                        </div>

                        <!-- Recipient Name -->
                        <div>
                            <label for="recipient_name" class="block text-sm font-semibold text-slate-700 mb-2">
                                {{ $t['recipient_name'] }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="recipient_name" name="recipient_name" required x-model="recipientName"
                                   class="w-full px-4 py-3 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>
                    </div>

                    <!-- Amount -->
                    <div>
                        <label for="amount" class="block text-sm font-semibold text-slate-700 mb-2">
                            {{ $t['amount'] }} (CHF) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="number" id="amount" name="amount" step="0.01" min="0.01" required x-model="amount"
                                   class="w-full px-4 py-3 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <span class="text-slate-500 text-sm font-medium">CHF</span>
                            </div>
                        </div>
                        <template x-if="selectedAccount && amount && parseFloat(amount) > availableBalance">
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Montant supérieur au solde disponible
                            </p>
                        </template>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">
                            {{ $t['description'] }}
                        </label>
                        <textarea id="description" name="description" rows="3"
                                  placeholder="{{ $t['description_placeholder'] }}"
                                  class="w-full px-4 py-3 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit"
                                :disabled="selectedAccount && amount && parseFloat(amount) > availableBalance"
                                :class="{'opacity-50 cursor-not-allowed': selectedAccount && amount && parseFloat(amount) > availableBalance}"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 rounded-lg transition-colors text-base shadow-sm disabled:opacity-50 disabled:cursor-not-allowed">
                            <span class="inline-flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                                {{ $t['execute_transfer'] }}
                            </span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Security Notice -->
            <div class="mt-6 bg-slate-50 border border-slate-200 rounded-lg p-4">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <p class="ml-3 text-sm text-slate-700">
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
                selectedBeneficiary: '',
                recipientIban: '',
                recipientName: '',
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
                fillBeneficiary() {
                    if (this.selectedBeneficiary) {
                        const select = document.getElementById('beneficiary');
                        const option = select.options[select.selectedIndex];
                        this.recipientIban = option.dataset.iban || '';
                        this.recipientName = option.dataset.name || '';
                    }
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
</x-layouts.dashboard>
