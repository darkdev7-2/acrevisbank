{{--
    Cette section doit être incluse dans la page de détail d'une demande de crédit
    resources/views/pages/dashboard/credit-requests/show.blade.php

    Usage: @include('components.credit-disbursement-section', ['creditRequest' => $creditRequest])
--}}

@php
    $currentLocale = app()->getLocale();
    $t = [
        'disbursement_title' => [
            'fr' => 'Déboursement du crédit',
            'de' => 'Kreditauszahlung',
            'en' => 'Credit Disbursement',
            'es' => 'Desembolso del crédito'
        ],
        'credit_my_account' => [
            'fr' => 'Créditer mon compte',
            'de' => 'Mein Konto gutschreiben',
            'en' => 'Credit my account',
            'es' => 'Acreditar mi cuenta'
        ],
        'validate_code' => [
            'fr' => 'Valider le code',
            'de' => 'Code bestätigen',
            'en' => 'Validate code',
            'es' => 'Validar código'
        ],
        'code_generated' => [
            'fr' => 'Un code de déboursement a été généré',
            'de' => 'Ein Auszahlungscode wurde generiert',
            'en' => 'A disbursement code has been generated',
            'es' => 'Se ha generado un código de desembolso'
        ],
        'contact_advisor' => [
            'fr' => 'Contactez votre conseiller pour obtenir le code de validation, puis saisissez-le ci-dessous pour créditer votre compte.',
            'de' => 'Kontaktieren Sie Ihren Berater, um den Validierungscode zu erhalten, und geben Sie ihn dann unten ein, um Ihr Konto gutzuschreiben.',
            'en' => 'Contact your advisor to get the validation code, then enter it below to credit your account.',
            'es' => 'Contacte a su asesor para obtener el código de validación, luego ingréselo a continuación para acreditar su cuenta.'
        ],
        'enter_code' => [
            'fr' => 'Entrez le code de validation',
            'de' => 'Geben Sie den Validierungscode ein',
            'en' => 'Enter validation code',
            'es' => 'Ingrese el código de validación'
        ],
        'select_account' => [
            'fr' => 'Sélectionnez le compte à créditer',
            'de' => 'Wählen Sie das zu gutschreibende Konto',
            'en' => 'Select account to credit',
            'es' => 'Seleccione la cuenta a acreditar'
        ],
        'generated_at' => [
            'fr' => 'Code généré le',
            'de' => 'Code generiert am',
            'en' => 'Code generated on',
            'es' => 'Código generado el'
        ],
        'already_disbursed' => [
            'fr' => 'Crédit déjà déboursé',
            'de' => 'Kredit bereits ausgezahlt',
            'en' => 'Credit already disbursed',
            'es' => 'Crédito ya desembolsado'
        ],
        'disbursed_on' => [
            'fr' => 'Le montant de :amount :currency a été crédité sur votre compte le :date',
            'de' => 'Der Betrag von :amount :currency wurde am :date auf Ihr Konto gutgeschrieben',
            'en' => 'The amount of :amount :currency was credited to your account on :date',
            'es' => 'El monto de :amount :currency fue acreditado en su cuenta el :date'
        ],
        'generate_code_info' => [
            'fr' => 'Pour recevoir le montant du crédit sur votre compte, cliquez sur le bouton ci-dessous pour générer un code de déboursement.',
            'de' => 'Um den Kreditbetrag auf Ihr Konto zu erhalten, klicken Sie auf die Schaltfläche unten, um einen Auszahlungscode zu generieren.',
            'en' => 'To receive the credit amount in your account, click the button below to generate a disbursement code.',
            'es' => 'Para recibir el monto del crédito en su cuenta, haga clic en el botón a continuación para generar un código de desembolso.'
        ],
    ];
@endphp

@if($creditRequest->status === 'approved')
<div class="mt-8 bg-white rounded-xl border-2 border-slate-200 overflow-hidden">
    <!-- Header -->
    <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4">
        <h3 class="text-xl font-bold text-white flex items-center">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ $t['disbursement_title'][$currentLocale] }}
        </h3>
    </div>

    <div class="p-6">
        @if($creditRequest->disbursement_status === 'validated')
            <!-- Crédit déjà déboursé -->
            <div class="bg-emerald-50 border-2 border-emerald-200 rounded-lg p-6">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="w-12 h-12 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-lg font-semibold text-emerald-900 mb-2">{{ $t['already_disbursed'][$currentLocale] }}</h4>
                        <p class="text-emerald-800">
                            {{ __($t['disbursed_on'][$currentLocale], [
                                'amount' => number_format($creditRequest->amount, 2, ',', ' '),
                                'currency' => $creditRequest->currency ?? 'CHF',
                                'date' => $creditRequest->disbursed_at->format('d/m/Y à H:i')
                            ]) }}
                        </p>
                    </div>
                </div>
            </div>

        @elseif($creditRequest->disbursement_status === 'code_generated')
            <!-- Code généré, en attente de validation -->
            <div class="space-y-6">
                <!-- Alert info -->
                <div class="bg-blue-50 border-l-4 border-blue-600 p-4 rounded">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-blue-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="font-semibold text-blue-900 mb-1">{{ $t['code_generated'][$currentLocale] }}</p>
                            <p class="text-sm text-blue-800">{{ $t['contact_advisor'][$currentLocale] }}</p>
                            <p class="text-xs text-blue-600 mt-2">
                                {{ $t['generated_at'][$currentLocale] }}: {{ $creditRequest->disbursement_code_generated_at->format('d/m/Y à H:i') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Formulaire de validation du code -->
                <form action="{{ route('dashboard.credit-disbursement.validate', ['locale' => $currentLocale, 'id' => $creditRequest->id]) }}"
                      method="POST"
                      class="space-y-4"
                      x-data="{ code: '' }">
                    @csrf

                    <!-- Champ code -->
                    <div>
                        <label for="code" class="block text-sm font-semibold text-slate-900 mb-2">
                            {{ $t['enter_code'][$currentLocale] }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="code"
                               name="code"
                               x-model="code"
                               maxlength="8"
                               pattern="[0-9]{8}"
                               required
                               placeholder="12345678"
                               class="w-full px-4 py-3 border-2 border-slate-300 rounded-lg text-2xl font-mono text-center tracking-widest focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                               autocomplete="off">
                        <p class="text-xs text-slate-500 mt-1">Code à 8 chiffres fourni par votre conseiller</p>
                    </div>

                    <!-- Sélection du compte -->
                    <div>
                        <label for="account_id" class="block text-sm font-semibold text-slate-900 mb-2">
                            {{ $t['select_account'][$currentLocale] }} <span class="text-red-500">*</span>
                        </label>
                        <select id="account_id"
                                name="account_id"
                                required
                                class="w-full px-4 py-3 border-2 border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                            <option value="">-- Sélectionnez un compte --</option>
                            @foreach(auth()->user()->accounts as $account)
                                <option value="{{ $account->id }}">
                                    {{ $account->account_number }} - {{ $account->account_type }}
                                    ({{ number_format($account->balance, 2) }} {{ $account->currency }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Bouton validation -->
                    <button type="submit"
                            :disabled="code.length !== 8"
                            :class="code.length === 8 ? 'bg-emerald-600 hover:bg-emerald-700' : 'bg-slate-300 cursor-not-allowed'"
                            class="w-full text-white font-bold px-6 py-4 rounded-lg transition-all shadow-lg text-lg flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $t['validate_code'][$currentLocale] }}
                    </button>
                </form>
            </div>

        @else
            <!-- Aucun code généré - afficher le bouton pour générer -->
            <div class="space-y-6">
                <div class="bg-slate-50 border-2 border-slate-200 rounded-lg p-6">
                    <p class="text-slate-700 mb-6">{{ $t['generate_code_info'][$currentLocale] }}</p>

                    <form action="{{ route('dashboard.credit-disbursement.generate', ['locale' => $currentLocale, 'id' => $creditRequest->id]) }}"
                          method="POST">
                        @csrf
                        <button type="submit"
                                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-6 py-4 rounded-lg transition-all shadow-lg text-lg flex items-center justify-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $t['credit_my_account'][$currentLocale] }}
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
@endif

@push('scripts')
<script>
// Auto-formater le code pendant la saisie (ajouter espaces tous les 4 chiffres pour lisibilité)
document.addEventListener('alpine:init', () => {
    // Le code est déjà géré par Alpine.js x-data ci-dessus
});
</script>
@endpush
