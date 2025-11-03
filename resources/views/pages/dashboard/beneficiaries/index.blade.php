<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();

        $texts = [
            'fr' => [
                'title' => 'Mes bénéficiaires',
                'back' => '← Retour au tableau de bord',
                'add_beneficiary' => 'Ajouter un bénéficiaire',
                'no_beneficiaries' => 'Aucun bénéficiaire',
                'no_beneficiaries_text' => 'Vous n\'avez pas encore ajouté de bénéficiaire. Ajoutez-en un pour faciliter vos virements.',
                'name' => 'Nom',
                'iban' => 'IBAN',
                'bank' => 'Banque',
                'category' => 'Catégorie',
                'actions' => 'Actions',
                'edit' => 'Modifier',
                'delete' => 'Supprimer',
                'confirm_delete' => 'Êtes-vous sûr de vouloir supprimer ce bénéficiaire ?',
                'favorite' => 'Favori',
            ],
            'de' => [
                'title' => 'Meine Begünstigten',
                'back' => '← Zurück zum Dashboard',
                'add_beneficiary' => 'Begünstigten hinzufügen',
                'no_beneficiaries' => 'Keine Begünstigten',
                'no_beneficiaries_text' => 'Sie haben noch keine Begünstigten hinzugefügt. Fügen Sie einen hinzu, um Ihre Überweisungen zu erleichtern.',
                'name' => 'Name',
                'iban' => 'IBAN',
                'bank' => 'Bank',
                'category' => 'Kategorie',
                'actions' => 'Aktionen',
                'edit' => 'Bearbeiten',
                'delete' => 'Löschen',
                'confirm_delete' => 'Sind Sie sicher, dass Sie diesen Begünstigten löschen möchten?',
                'favorite' => 'Favorit',
            ],
            'en' => [
                'title' => 'My beneficiaries',
                'back' => '← Back to dashboard',
                'add_beneficiary' => 'Add beneficiary',
                'no_beneficiaries' => 'No beneficiaries',
                'no_beneficiaries_text' => 'You haven\'t added any beneficiaries yet. Add one to make your transfers easier.',
                'name' => 'Name',
                'iban' => 'IBAN',
                'bank' => 'Bank',
                'category' => 'Category',
                'actions' => 'Actions',
                'edit' => 'Edit',
                'delete' => 'Delete',
                'confirm_delete' => 'Are you sure you want to delete this beneficiary?',
                'favorite' => 'Favorite',
            ],
            'es' => [
                'title' => 'Mis beneficiarios',
                'back' => '← Volver al panel',
                'add_beneficiary' => 'Agregar beneficiario',
                'no_beneficiaries' => 'Sin beneficiarios',
                'no_beneficiaries_text' => 'Aún no ha agregado beneficiarios. Agregue uno para facilitar sus transferencias.',
                'name' => 'Nombre',
                'iban' => 'IBAN',
                'bank' => 'Banco',
                'category' => 'Categoría',
                'actions' => 'Acciones',
                'edit' => 'Editar',
                'delete' => 'Eliminar',
                'confirm_delete' => '¿Está seguro de que desea eliminar este beneficiario?',
                'favorite' => 'Favorito',
            ]
        ];

        $t = $texts[$currentLocale];
    @endphp

    <x-slot name="title">{{ $t['title'] }}</x-slot>

    <!-- Header -->
    <div class="bg-gradient-to-r from-pink-600 to-pink-700 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('dashboard.index', ['locale' => $currentLocale]) }}" class="inline-flex items-center text-pink-100 hover:text-white mb-4 transition-colors">
                {{ $t['back'] }}
            </a>
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold">{{ $t['title'] }}</h1>
                <a href="{{ route('dashboard.beneficiaries.create', ['locale' => $currentLocale]) }}"
                   class="inline-flex items-center px-4 py-2 bg-white text-pink-600 rounded-md hover:bg-pink-50 transition-colors font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    {{ $t['add_beneficiary'] }}
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 rounded-md p-4">
                    <div class="flex">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="ml-3 text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @forelse($beneficiaries as $beneficiary)
                <div class="bg-white rounded-lg shadow-md p-6 mb-4 hover:shadow-lg transition-shadow">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center mb-2">
                                <h3 class="text-xl font-bold text-gray-900">{{ $beneficiary->name }}</h3>
                                @if($beneficiary->is_favorite)
                                    <span class="ml-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        {{ $t['favorite'] }}
                                    </span>
                                @endif
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
                                <div>
                                    <p class="text-xs text-gray-500">{{ $t['iban'] }}</p>
                                    <p class="font-mono text-sm font-medium mt-1">{{ trim($beneficiary->formatted_iban) }}</p>
                                </div>
                                @if($beneficiary->bank_name)
                                    <div>
                                        <p class="text-xs text-gray-500">{{ $t['bank'] }}</p>
                                        <p class="text-sm font-medium mt-1">{{ $beneficiary->bank_name }}</p>
                                    </div>
                                @endif
                                @if($beneficiary->category)
                                    <div>
                                        <p class="text-xs text-gray-500">{{ $t['category'] }}</p>
                                        <p class="text-sm mt-1">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                {{ $beneficiary->category }}
                                            </span>
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center space-x-2 ml-4">
                            <a href="{{ route('dashboard.beneficiaries.edit', ['locale' => $currentLocale, 'id' => $beneficiary->id]) }}"
                               class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                {{ $t['edit'] }}
                            </a>

                            <form method="POST" action="{{ route('dashboard.beneficiaries.destroy', ['locale' => $currentLocale, 'id' => $beneficiary->id]) }}"
                                  onsubmit="return confirm('{{ $t['confirm_delete'] }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center px-3 py-2 border border-red-300 rounded-md text-sm font-medium text-red-700 bg-white hover:bg-red-50 transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    {{ $t['delete'] }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">{{ $t['no_beneficiaries'] }}</h3>
                    <p class="mt-2 text-sm text-gray-500">{{ $t['no_beneficiaries_text'] }}</p>
                    <div class="mt-6">
                        <a href="{{ route('dashboard.beneficiaries.create', ['locale' => $currentLocale]) }}"
                           class="inline-flex items-center px-4 py-2 bg-pink-600 text-white rounded-md hover:bg-pink-700 transition-colors font-medium">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            {{ $t['add_beneficiary'] }}
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-layouts.app>
