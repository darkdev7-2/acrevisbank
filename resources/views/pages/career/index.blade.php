<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();

        $texts = [
            'fr' => [
                'title' => 'Carrières',
                'subtitle' => 'Rejoignez notre équipe',
                'description' => 'Découvrez nos opportunités de carrière et construisez votre avenir avec nous',
                'filter_by' => 'Filtrer par',
                'department' => 'Département',
                'location' => 'Lieu',
                'contract_type' => 'Type de contrat',
                'all' => 'Tous',
                'reset_filters' => 'Réinitialiser les filtres',
                'positions_available' => 'postes disponibles',
                'apply_now' => 'Postuler',
                'view_details' => 'Voir les détails',
                'no_jobs' => 'Aucun poste disponible',
                'no_jobs_desc' => 'Il n\'y a actuellement aucun poste correspondant à vos critères.',
                'workload' => 'Taux d\'occupation',
            ],
            'de' => [
                'title' => 'Karriere',
                'subtitle' => 'Werden Sie Teil unseres Teams',
                'description' => 'Entdecken Sie unsere Karrieremöglichkeiten und bauen Sie Ihre Zukunft mit uns',
                'filter_by' => 'Filtern nach',
                'department' => 'Abteilung',
                'location' => 'Standort',
                'contract_type' => 'Vertragsart',
                'all' => 'Alle',
                'reset_filters' => 'Filter zurücksetzen',
                'positions_available' => 'verfügbare Stellen',
                'apply_now' => 'Jetzt bewerben',
                'view_details' => 'Details anzeigen',
                'no_jobs' => 'Keine Stellen verfügbar',
                'no_jobs_desc' => 'Es gibt derzeit keine Stellen, die Ihren Kriterien entsprechen.',
                'workload' => 'Arbeitspensum',
            ],
            'en' => [
                'title' => 'Careers',
                'subtitle' => 'Join our team',
                'description' => 'Discover our career opportunities and build your future with us',
                'filter_by' => 'Filter by',
                'department' => 'Department',
                'location' => 'Location',
                'contract_type' => 'Contract type',
                'all' => 'All',
                'reset_filters' => 'Reset filters',
                'positions_available' => 'positions available',
                'apply_now' => 'Apply now',
                'view_details' => 'View details',
                'no_jobs' => 'No positions available',
                'no_jobs_desc' => 'There are currently no positions matching your criteria.',
                'workload' => 'Workload',
            ],
            'es' => [
                'title' => 'Carreras',
                'subtitle' => 'Únase a nuestro equipo',
                'description' => 'Descubra nuestras oportunidades de carrera y construya su futuro con nosotros',
                'filter_by' => 'Filtrar por',
                'department' => 'Departamento',
                'location' => 'Ubicación',
                'contract_type' => 'Tipo de contrato',
                'all' => 'Todos',
                'reset_filters' => 'Restablecer filtros',
                'positions_available' => 'puestos disponibles',
                'apply_now' => 'Aplicar ahora',
                'view_details' => 'Ver detalles',
                'no_jobs' => 'No hay puestos disponibles',
                'no_jobs_desc' => 'Actualmente no hay puestos que coincidan con sus criterios.',
                'workload' => 'Carga de trabajo',
            ]
        ];

        $t = $texts[$currentLocale];
    @endphp

    <x-slot name="title">{{ $t['title'] }}</x-slot>

    <!-- Header Section -->
    <div class="bg-gradient-to-r from-pink-600 to-pink-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $t['title'] }}</h1>
            <p class="text-xl text-pink-100 mb-2">{{ $t['subtitle'] }}</p>
            <p class="text-pink-100">{{ $t['description'] }}</p>
            <div class="mt-6">
                <span class="inline-flex items-center px-4 py-2 bg-white/20 rounded-full text-sm font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    {{ $careers->count() }} {{ $t['positions_available'] }}
                </span>
            </div>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="bg-white border-b sticky top-0 z-10 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <form method="GET" action="{{ route('career.index', ['locale' => $currentLocale]) }}" class="flex flex-wrap gap-4 items-end">
                <div class="flex-1 min-w-[200px]">
                    <label for="department" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ $t['department'] }}
                    </label>
                    <select name="department" id="department" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                        <option value="">{{ $t['all'] }}</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>
                                {{ $dept }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex-1 min-w-[200px]">
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ $t['location'] }}
                    </label>
                    <select name="location" id="location" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                        <option value="">{{ $t['all'] }}</option>
                        @foreach($locations as $loc)
                            <option value="{{ $loc }}" {{ request('location') == $loc ? 'selected' : '' }}>
                                {{ $loc }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex-1 min-w-[200px]">
                    <label for="contract_type" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ $t['contract_type'] }}
                    </label>
                    <select name="contract_type" id="contract_type" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                        <option value="">{{ $t['all'] }}</option>
                        @foreach($contractTypes as $type)
                            <option value="{{ $type }}" {{ request('contract_type') == $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="px-6 py-2 bg-pink-600 text-white rounded-md hover:bg-pink-700 transition-colors font-medium">
                        {{ $t['filter_by'] }}
                    </button>
                    <a href="{{ route('career.index', ['locale' => $currentLocale]) }}" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-colors font-medium">
                        {{ $t['reset_filters'] }}
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Jobs Grid -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($careers->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    @foreach($careers as $career)
                        <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow p-6 border border-gray-200">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <h2 class="text-2xl font-bold text-gray-900 mb-2">
                                        {{ $career->getTranslation('title', $currentLocale) }}
                                    </h2>
                                    <div class="flex flex-wrap gap-2 mb-3">
                                        <span class="inline-flex items-center px-3 py-1 bg-pink-100 text-pink-700 rounded-full text-sm font-medium">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                            </svg>
                                            {{ $career->department }}
                                        </span>
                                        <span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            {{ $career->location }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <span class="font-medium">{{ $career->contract_type }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ $t['workload'] }}: <span class="font-medium">{{ $career->workload }}</span></span>
                                </div>
                            </div>

                            <p class="text-gray-600 mb-6 line-clamp-3">
                                {!! Str::limit(strip_tags($career->getTranslation('description', $currentLocale)), 200) !!}
                            </p>

                            <div class="flex items-center gap-3">
                                <a href="{{ route('career.show', ['locale' => $currentLocale, 'slug' => $career->slug]) }}"
                                   class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-pink-600 text-white rounded-md hover:bg-pink-700 transition-colors font-medium">
                                    {{ $t['apply_now'] }}
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                                <a href="{{ route('career.show', ['locale' => $currentLocale, 'slug' => $career->slug]) }}"
                                   class="px-6 py-3 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-colors font-medium">
                                    {{ $t['view_details'] }}
                                </a>
                            </div>

                            @if($career->published_at)
                                <div class="mt-4 pt-4 border-t text-xs text-gray-500">
                                    {{ $currentLocale === 'fr' ? 'Publié le' :
                                       ($currentLocale === 'de' ? 'Veröffentlicht am' :
                                       ($currentLocale === 'en' ? 'Published on' : 'Publicado el')) }}
                                    {{ $career->published_at->format('d.m.Y') }}
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 bg-white rounded-lg shadow">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">{{ $t['no_jobs'] }}</h3>
                    <p class="mt-1 text-sm text-gray-500">{{ $t['no_jobs_desc'] }}</p>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
