<div class="space-y-6">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Nouvelle demande de prêt</h2>
        <p class="text-gray-600 mb-6">
            Vos informations personnelles sont déjà enregistrées. Veuillez compléter les informations suivantes pour soumettre votre demande de prêt.
        </p>

        @if (session()->has('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <form wire:submit.prevent="submit" class="space-y-6">
            <!-- Montant du prêt -->
            <div>
                <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">
                    Montant du prêt <span class="text-red-500">*</span>
                </label>
                <div class="flex gap-3">
                    <div class="flex-1">
                        <input
                            type="number"
                            id="amount"
                            wire:model="amount"
                            step="100"
                            min="1000"
                            max="1000000"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                            placeholder="Ex: 50000"
                        >
                    </div>
                    <div class="w-32">
                        <select
                            wire:model="currency"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                        >
                            <option value="CHF">CHF</option>
                            <option value="EUR">EUR</option>
                            <option value="USD">USD</option>
                        </select>
                    </div>
                </div>
                @error('amount')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @error('currency')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date prévue de remboursement -->
            <div>
                <label for="repayment_date" class="block text-sm font-medium text-gray-700 mb-2">
                    Date prévue de remboursement <span class="text-red-500">*</span>
                </label>
                <input
                    type="date"
                    id="repayment_date"
                    wire:model="repayment_date"
                    min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                >
                @error('repayment_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">
                    Indiquez la date à laquelle vous prévoyez de rembourser le prêt
                </p>
            </div>

            <!-- Durée en mois (optionnel) -->
            <div>
                <label for="duration_months" class="block text-sm font-medium text-gray-700 mb-2">
                    Durée souhaitée (en mois) <span class="text-gray-400">(optionnel)</span>
                </label>
                <input
                    type="number"
                    id="duration_months"
                    wire:model="duration_months"
                    min="1"
                    max="360"
                    step="1"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                    placeholder="Ex: 24"
                >
                @error('duration_months')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">
                    Si non renseigné, sera calculé automatiquement en fonction de la date de remboursement
                </p>
            </div>

            <!-- Motif du prêt -->
            <div>
                <label for="purpose" class="block text-sm font-medium text-gray-700 mb-2">
                    Motif du prêt <span class="text-red-500">*</span>
                </label>
                <textarea
                    id="purpose"
                    wire:model="purpose"
                    rows="4"
                    maxlength="1000"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                    placeholder="Décrivez l'objet de votre demande de prêt (achat immobilier, création d'entreprise, rénovation, etc.)"
                ></textarea>
                @error('purpose')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">
                    {{ strlen($purpose ?? '') }}/1000 caractères
                </p>
            </div>

            <!-- Personne à contacter -->
            <div>
                <label for="contact_person" class="block text-sm font-medium text-gray-700 mb-2">
                    Personne à contacter <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="contact_person"
                    wire:model="contact_person"
                    maxlength="255"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                    placeholder="Nom de la personne de référence"
                >
                @error('contact_person')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">
                    Personne que nous pourrons contacter si besoin (ex: votre conseiller, un proche, etc.)
                </p>
            </div>

            <!-- Informations automatiquement remplies -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h3 class="text-sm font-semibold text-blue-900 mb-2">
                    ℹ️ Informations automatiquement remplies depuis votre profil
                </h3>
                <div class="text-sm text-blue-800 space-y-1">
                    <p><strong>Nom:</strong> {{ Auth::user()->first_name ?? Auth::user()->name }} {{ Auth::user()->last_name ?? '' }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Téléphone:</strong> {{ Auth::user()->phone ?? 'Non renseigné' }}</p>
                    <p><strong>Pays:</strong> {{ Auth::user()->country ?? 'Non renseigné' }}</p>
                    <p><strong>Ville:</strong> {{ Auth::user()->city ?? 'Non renseignée' }}</p>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                <a
                    href="{{ route('dashboard.credit-requests.index', ['locale' => app()->getLocale()]) }}"
                    class="px-6 py-3 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors"
                >
                    Annuler
                </a>
                <button
                    type="submit"
                    class="px-8 py-3 bg-gradient-to-r from-pink-600 to-pink-700 text-white rounded-lg hover:from-pink-700 hover:to-pink-800 transition-all shadow-md hover:shadow-lg"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-50 cursor-not-allowed"
                >
                    <span wire:loading.remove>Soumettre la demande</span>
                    <span wire:loading>Envoi en cours...</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Important notice -->
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
        <h3 class="text-sm font-semibold text-yellow-900 mb-2">
            ⚠️ Important
        </h3>
        <ul class="text-sm text-yellow-800 space-y-1 list-disc list-inside">
            <li>Une fois soumise, vous ne pourrez pas modifier votre demande</li>
            <li>Votre demande sera examinée par notre équipe sous 48-72 heures</li>
            <li>Vous recevrez une notification par email une fois la demande traitée</li>
        </ul>
    </div>
</div>
