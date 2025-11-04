<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        {{-- Header --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                Ouvrir un compte Acrevis Bank
            </h1>
            <p class="text-gray-600">
                Processus sécurisé et conforme aux normes bancaires suisses
            </p>
        </div>

        {{-- Progress Bar --}}
        <div class="mb-8">
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm font-medium text-gray-700">Étape {{ $currentStep }} sur {{ $totalSteps }}</span>
                <span class="text-sm font-medium text-gray-700">{{ round(($currentStep / $totalSteps) * 100) }}%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-blue-600 h-2.5 rounded-full transition-all duration-300"
                     style="width: {{ ($currentStep / $totalSteps) * 100 }}%"></div>
            </div>

            {{-- Step Labels --}}
            <div class="flex justify-between mt-4">
                <div class="text-center flex-1">
                    <div class="w-10 h-10 mx-auto rounded-full flex items-center justify-center {{ $currentStep >= 1 ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-600' }}">
                        1
                    </div>
                    <span class="text-xs mt-1 block">Informations<br>personnelles</span>
                </div>
                <div class="text-center flex-1">
                    <div class="w-10 h-10 mx-auto rounded-full flex items-center justify-center {{ $currentStep >= 2 ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-600' }}">
                        2
                    </div>
                    <span class="text-xs mt-1 block">Coordonnées</span>
                </div>
                <div class="text-center flex-1">
                    <div class="w-10 h-10 mx-auto rounded-full flex items-center justify-center {{ $currentStep >= 3 ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-600' }}">
                        3
                    </div>
                    <span class="text-xs mt-1 block">Informations<br>professionnelles</span>
                </div>
                <div class="text-center flex-1">
                    <div class="w-10 h-10 mx-auto rounded-full flex items-center justify-center {{ $currentStep >= 4 ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-600' }}">
                        4
                    </div>
                    <span class="text-xs mt-1 block">Vérification<br>d'identité</span>
                </div>
            </div>
        </div>

        {{-- Form Card --}}
        <div class="bg-white shadow-lg rounded-lg p-8">
            <form wire:submit.prevent="register">
                {{-- Step 1: Personal Information --}}
                @if ($currentStep === 1)
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Informations personnelles</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Prénom <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model="first_name" id="first_name"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                @error('first_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nom <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model="last_name" id="last_name"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                @error('last_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">
                                    Date de naissance <span class="text-red-500">*</span>
                                </label>
                                <input type="date" wire:model="birth_date" id="birth_date"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                @error('birth_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="birth_place" class="block text-sm font-medium text-gray-700 mb-2">
                                    Lieu de naissance <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model="birth_place" id="birth_place"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                @error('birth_place') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="nationality" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nationalité <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model="nationality" id="nationality"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                @error('nationality') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" wire:model="email" id="email"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                    Mot de passe <span class="text-red-500">*</span>
                                </label>
                                <input type="password" wire:model="password" id="password"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                <p class="mt-1 text-xs text-gray-500">Min. 8 caractères, majuscules, minuscules et chiffres</p>
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                    Confirmer le mot de passe <span class="text-red-500">*</span>
                                </label>
                                <input type="password" wire:model="password_confirmation" id="password_confirmation"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Step 2: Contact Information --}}
                @if ($currentStep === 2)
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Coordonnées</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                    Téléphone mobile <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" wire:model="phone" id="phone" placeholder="+41 79 123 45 67"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-2">
                                    WhatsApp (optionnel)
                                </label>
                                <input type="tel" wire:model="whatsapp" id="whatsapp" placeholder="+41 79 123 45 67"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div class="md:col-span-2">
                                <label for="street" class="block text-sm font-medium text-gray-700 mb-2">
                                    Rue et numéro <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model="street" id="street" placeholder="Rue de l'exemple 123"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                @error('street') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-2">
                                    Code postal (NPA) <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model="postal_code" id="postal_code" placeholder="9000"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                @error('postal_code') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 mb-2">
                                    Ville <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model="city" id="city" placeholder="St-Gall"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                @error('city') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="country" class="block text-sm font-medium text-gray-700 mb-2">
                                    Pays <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model="country" id="country"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                @error('country') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Step 3: Professional Information --}}
                @if ($currentStep === 3)
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Informations professionnelles</h2>
                        <p class="text-sm text-gray-600 mb-6">
                            Conformément à la loi suisse sur le blanchiment d'argent (LBA), nous devons connaître l'origine de vos fonds.
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="profession" class="block text-sm font-medium text-gray-700 mb-2">
                                    Profession <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model="profession" id="profession"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                @error('profession') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="employer" class="block text-sm font-medium text-gray-700 mb-2">
                                    Employeur (optionnel)
                                </label>
                                <input type="text" wire:model="employer" id="employer"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div>
                                <label for="annual_income" class="block text-sm font-medium text-gray-700 mb-2">
                                    Revenu annuel (CHF) <span class="text-red-500">*</span>
                                </label>
                                <input type="number" wire:model="annual_income" id="annual_income" step="1000"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                @error('annual_income') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="funds_source" class="block text-sm font-medium text-gray-700 mb-2">
                                    Source des fonds <span class="text-red-500">*</span>
                                </label>
                                <select wire:model="funds_source" id="funds_source"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Sélectionner...</option>
                                    <option value="Salaire">Salaire</option>
                                    <option value="Épargne">Épargne</option>
                                    <option value="Héritage">Héritage</option>
                                    <option value="Investissements">Investissements</option>
                                    <option value="Revenus locatifs">Revenus locatifs</option>
                                    <option value="Vente d'entreprise">Vente d'entreprise</option>
                                    <option value="Autre">Autre</option>
                                </select>
                                @error('funds_source') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="tax_residence_country" class="block text-sm font-medium text-gray-700 mb-2">
                                    Pays de résidence fiscale <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model="tax_residence_country" id="tax_residence_country"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                @error('tax_residence_country') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="tax_identification_number" class="block text-sm font-medium text-gray-700 mb-2">
                                    Numéro d'identification fiscale (optionnel)
                                </label>
                                <input type="text" wire:model="tax_identification_number" id="tax_identification_number"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div class="md:col-span-2">
                                <label class="flex items-center">
                                    <input type="checkbox" wire:model="politically_exposed"
                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">
                                        Je suis une personne politiquement exposée (PPE)
                                    </span>
                                </label>
                                <p class="mt-1 text-xs text-gray-500">
                                    Fonction publique importante (ministre, député, haut fonctionnaire, etc.)
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Step 4: Identity Verification --}}
                @if ($currentStep === 4)
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Vérification d'identité</h2>
                        <p class="text-sm text-gray-600 mb-6">
                            Conformément à la réglementation FINMA, nous devons vérifier votre identité.
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="id_document_type" class="block text-sm font-medium text-gray-700 mb-2">
                                    Type de document <span class="text-red-500">*</span>
                                </label>
                                <select wire:model="id_document_type" id="id_document_type"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Sélectionner...</option>
                                    <option value="passport">Passeport</option>
                                    <option value="id_card">Carte d'identité</option>
                                    <option value="residence_permit">Permis de séjour</option>
                                </select>
                                @error('id_document_type') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="id_document_number" class="block text-sm font-medium text-gray-700 mb-2">
                                    Numéro du document <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model="id_document_number" id="id_document_number"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                @error('id_document_number') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="id_document_expiry" class="block text-sm font-medium text-gray-700 mb-2">
                                    Date d'expiration <span class="text-red-500">*</span>
                                </label>
                                <input type="date" wire:model="id_document_expiry" id="id_document_expiry"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                @error('id_document_expiry') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="id_document" class="block text-sm font-medium text-gray-700 mb-2">
                                    Document d'identité (scan/photo) <span class="text-red-500">*</span>
                                </label>
                                <input type="file" wire:model="id_document" id="id_document" accept=".pdf,.jpg,.jpeg,.png"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                @error('id_document') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                <p class="mt-1 text-xs text-gray-500">
                                    Formats acceptés: PDF, JPG, PNG. Taille max: 5MB
                                </p>
                                @if ($id_document)
                                    <p class="mt-2 text-sm text-green-600">✓ Fichier chargé: {{ $id_document->getClientOriginalName() }}</p>
                                @endif
                            </div>

                            <div class="md:col-span-2 pt-4 border-t">
                                <label class="flex items-start">
                                    <input type="checkbox" wire:model="terms_accepted"
                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 mt-1">
                                    <span class="ml-2 text-sm text-gray-700">
                                        J'accepte les <a href="#" class="text-blue-600 hover:underline">conditions générales</a>
                                        et la <a href="#" class="text-blue-600 hover:underline">politique de confidentialité</a> d'Acrevis Bank <span class="text-red-500">*</span>
                                    </span>
                                </label>
                                @error('terms_accepted') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="flex items-start">
                                    <input type="checkbox" wire:model="marketing_consent"
                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 mt-1">
                                    <span class="ml-2 text-sm text-gray-700">
                                        J'accepte de recevoir des offres et communications marketing d'Acrevis Bank (optionnel)
                                    </span>
                                </label>
                            </div>
                        </div>

                        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                            <h3 class="text-sm font-semibold text-blue-900 mb-2">Protection de vos données</h3>
                            <p class="text-xs text-blue-800">
                                Vos données personnelles sont cryptées et stockées de manière sécurisée.
                                Nous respectons la loi suisse sur la protection des données (LPD) et le RGPD.
                            </p>
                        </div>
                    </div>
                @endif

                {{-- Navigation Buttons --}}
                <div class="flex justify-between mt-8 pt-6 border-t">
                    @if ($currentStep > 1)
                        <button type="button" wire:click="previousStep"
                                class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition">
                            ← Précédent
                        </button>
                    @else
                        <div></div>
                    @endif

                    @if ($currentStep < $totalSteps)
                        <button type="button" wire:click="nextStep"
                                class="px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                            Suivant →
                        </button>
                    @else
                        <button type="submit"
                                class="px-6 py-3 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition">
                            Soumettre ma demande
                        </button>
                    @endif
                </div>
            </form>
        </div>

        {{-- Info Box --}}
        <div class="mt-8 text-center text-sm text-gray-600">
            <p>🔒 Connexion sécurisée SSL | ✓ Conforme FINMA | 📞 Support: +41 71 xxx xx xx</p>
        </div>
    </div>
</div>
