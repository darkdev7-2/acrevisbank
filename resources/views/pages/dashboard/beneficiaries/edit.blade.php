<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();

        $texts = [
            'fr' => [
                'title' => 'Modifier le bénéficiaire',
                'back' => '← Retour à la liste',
                'name' => 'Nom du bénéficiaire',
                'name_placeholder' => 'Ex: Jean Dupont',
                'iban' => 'IBAN',
                'iban_placeholder' => 'CH12 3456 7890 1234 5678 9',
                'iban_help' => 'Format IBAN suisse ou international',
                'bank_name' => 'Nom de la banque',
                'bank_name_placeholder' => 'Ex: UBS, Credit Suisse...',
                'category' => 'Catégorie',
                'category_placeholder' => 'Ex: Famille, Fournisseur, Ami...',
                'notes' => 'Notes personnelles',
                'notes_placeholder' => 'Informations complémentaires...',
                'is_favorite' => 'Épingler en favori',
                'save' => 'Enregistrer les modifications',
                'cancel' => 'Annuler',
            ],
            'de' => [
                'title' => 'Begünstigten bearbeiten',
                'back' => '← Zurück zur Liste',
                'name' => 'Name des Begünstigten',
                'name_placeholder' => 'Z.B.: Hans Müller',
                'iban' => 'IBAN',
                'iban_placeholder' => 'CH12 3456 7890 1234 5678 9',
                'iban_help' => 'Schweizer oder internationales IBAN-Format',
                'bank_name' => 'Name der Bank',
                'bank_name_placeholder' => 'Z.B.: UBS, Credit Suisse...',
                'category' => 'Kategorie',
                'category_placeholder' => 'Z.B.: Familie, Lieferant, Freund...',
                'notes' => 'Persönliche Notizen',
                'notes_placeholder' => 'Zusätzliche Informationen...',
                'is_favorite' => 'Als Favorit markieren',
                'save' => 'Änderungen speichern',
                'cancel' => 'Abbrechen',
            ],
            'en' => [
                'title' => 'Edit beneficiary',
                'back' => '← Back to list',
                'name' => 'Beneficiary name',
                'name_placeholder' => 'E.g.: John Doe',
                'iban' => 'IBAN',
                'iban_placeholder' => 'CH12 3456 7890 1234 5678 9',
                'iban_help' => 'Swiss or international IBAN format',
                'bank_name' => 'Bank name',
                'bank_name_placeholder' => 'E.g.: UBS, Credit Suisse...',
                'category' => 'Category',
                'category_placeholder' => 'E.g.: Family, Supplier, Friend...',
                'notes' => 'Personal notes',
                'notes_placeholder' => 'Additional information...',
                'is_favorite' => 'Pin as favorite',
                'save' => 'Save changes',
                'cancel' => 'Cancel',
            ],
            'es' => [
                'title' => 'Editar beneficiario',
                'back' => '← Volver a la lista',
                'name' => 'Nombre del beneficiario',
                'name_placeholder' => 'Ej: Juan Pérez',
                'iban' => 'IBAN',
                'iban_placeholder' => 'CH12 3456 7890 1234 5678 9',
                'iban_help' => 'Formato IBAN suizo o internacional',
                'bank_name' => 'Nombre del banco',
                'bank_name_placeholder' => 'Ej: UBS, Credit Suisse...',
                'category' => 'Categoría',
                'category_placeholder' => 'Ej: Familia, Proveedor, Amigo...',
                'notes' => 'Notas personales',
                'notes_placeholder' => 'Información adicional...',
                'is_favorite' => 'Marcar como favorito',
                'save' => 'Guardar cambios',
                'cancel' => 'Cancelar',
            ]
        ];

        $t = $texts[$currentLocale];
    @endphp

    <x-slot name="title">{{ $t['title'] }}</x-slot>

    <!-- Header -->
    <div class="bg-gradient-to-r from-pink-600 to-pink-700 text-white py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('dashboard.beneficiaries.index', ['locale' => $currentLocale]) }}" class="inline-flex items-center text-pink-100 hover:text-white mb-4 transition-colors">
                {{ $t['back'] }}
            </a>
            <h1 class="text-3xl font-bold">{{ $t['title'] }}</h1>
        </div>
    </div>

    <!-- Form -->
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

                <form method="POST" action="{{ route('dashboard.beneficiaries.update', ['locale' => $currentLocale, 'id' => $beneficiary->id]) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $t['name'] }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', $beneficiary->name) }}" required
                               placeholder="{{ $t['name_placeholder'] }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                    </div>

                    <!-- IBAN -->
                    <div>
                        <label for="iban" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $t['iban'] }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="iban" name="iban" value="{{ old('iban', trim($beneficiary->formatted_iban)) }}" required
                               placeholder="{{ $t['iban_placeholder'] }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500 font-mono">
                        <p class="mt-1 text-xs text-gray-500">{{ $t['iban_help'] }}</p>
                    </div>

                    <!-- Bank Name -->
                    <div>
                        <label for="bank_name" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $t['bank_name'] }}
                        </label>
                        <input type="text" id="bank_name" name="bank_name" value="{{ old('bank_name', $beneficiary->bank_name) }}"
                               placeholder="{{ $t['bank_name_placeholder'] }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $t['category'] }}
                        </label>
                        <input type="text" id="category" name="category" value="{{ old('category', $beneficiary->category) }}"
                               placeholder="{{ $t['category_placeholder'] }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                    </div>

                    <!-- Notes -->
                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $t['notes'] }}
                        </label>
                        <textarea id="notes" name="notes" rows="3"
                                  placeholder="{{ $t['notes_placeholder'] }}"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">{{ old('notes', $beneficiary->notes) }}</textarea>
                    </div>

                    <!-- Is Favorite -->
                    <div class="flex items-center">
                        <input type="checkbox" id="is_favorite" name="is_favorite" value="1"
                               {{ old('is_favorite', $beneficiary->is_favorite) ? 'checked' : '' }}
                               class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded">
                        <label for="is_favorite" class="ml-2 block text-sm text-gray-900">
                            {{ $t['is_favorite'] }}
                        </label>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-end space-x-3 pt-4">
                        <a href="{{ route('dashboard.beneficiaries.index', ['locale' => $currentLocale]) }}"
                           class="px-6 py-3 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors font-medium">
                            {{ $t['cancel'] }}
                        </a>
                        <button type="submit"
                                class="px-6 py-3 bg-pink-600 hover:bg-pink-700 text-white font-semibold rounded-md transition-colors">
                            {{ $t['save'] }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
