@php
    $currentLocale = app()->getLocale();
    $currentSegment = session('segment', 'privat');

    // Menu items for PRIVAT segment
    $privatMenuItems = [
        'accounts' => [
            'fr' => 'Comptes & Cartes',
            'de' => 'Konto & Karte',
            'en' => 'Accounts & Cards',
            'es' => 'Cuentas y Tarjetas',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />',
            'category' => 'Comptes & Cartes'
        ],
        'housing' => [
            'fr' => 'Financer un logement',
            'de' => 'Wohneigentum finanzieren',
            'en' => 'Finance Housing',
            'es' => 'Financiar Vivienda',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />',
            'category' => 'Hypothèques & Financements'
        ],
        'invest' => [
            'fr' => 'Placer son argent',
            'de' => 'Geld anlegen',
            'en' => 'Invest Money',
            'es' => 'Invertir Dinero',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />',
            'category' => 'Placements & Épargne'
        ],
        'planning' => [
            'fr' => 'Planification & Prévoyance',
            'de' => 'Finanzplanung & Vorsorge',
            'en' => 'Planning & Pension',
            'es' => 'Planificación y Previsión',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />',
            'category' => 'Prévoyance'
        ],
        'about' => [
            'fr' => 'Notre banque',
            'de' => 'Unsere Bank',
            'en' => 'Our bank',
            'es' => 'Nuestro banco',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />',
            'category' => null
        ],
    ];

    // Menu items for BUSINESS segment
    $businessMenuItems = [
        'business-accounts' => [
            'fr' => 'Comptes entreprise',
            'de' => 'Geschäftskonten',
            'en' => 'Business accounts',
            'es' => 'Cuentas empresariales',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />',
            'category' => 'Entreprises'
        ],
        'business-credit' => [
            'fr' => 'Crédits & Financements',
            'de' => 'Kredite & Finanzierung',
            'en' => 'Loans & Financing',
            'es' => 'Créditos y Financiación',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />',
            'category' => 'Entreprises'
        ],
        'business-payments' => [
            'fr' => 'Paiements & Cash',
            'de' => 'Zahlungen & Cash',
            'en' => 'Payments & Cash',
            'es' => 'Pagos y Efectivo',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />',
            'category' => 'Entreprises'
        ],
        'business-invest' => [
            'fr' => 'Placements entreprise',
            'de' => 'Unternehmensanlagen',
            'en' => 'Business investments',
            'es' => 'Inversiones empresariales',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />',
            'category' => 'Entreprises'
        ],
        'about' => [
            'fr' => 'Notre banque',
            'de' => 'Unsere Bank',
            'en' => 'Our bank',
            'es' => 'Nuestro banco',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />',
            'category' => null
        ],
    ];

    $menuItems = $currentSegment === 'business' ? $businessMenuItems : $privatMenuItems;
@endphp

<nav class="bg-white border-t border-gray-100" x-data="{ openMenu: null }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-start space-x-8 h-14">
            @foreach($menuItems as $key => $item)
            <div class="relative" @mouseenter="openMenu = '{{ $key }}'" @mouseleave="openMenu = null">
                @php
                    $url = $item['category']
                        ? route('services.index', ['locale' => $currentLocale, 'segment' => $currentSegment, 'category' => $item['category']])
                        : ($key === 'about' ? route('about', ['locale' => $currentLocale]) : route('services.index', ['locale' => $currentLocale, 'segment' => $currentSegment]));
                @endphp
                <a href="{{ $url }}"
                   class="flex items-center space-x-2 text-sm font-medium text-gray-700 hover:text-pink-600 transition-colors py-4 border-b-2 border-transparent hover:border-pink-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $item['icon'] !!}
                    </svg>
                    <span>{{ $item[$currentLocale] }}</span>
                    @if($item['category'])
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                    @endif
                </a>

                <!-- Dropdown Menu (Mega Menu) -->
                @if($item['category'])
                @php
                    $categoryServices = \App\Models\Service::where('category', $item['category'])
                        ->where('is_active', true)
                        ->orderBy('order')
                        ->take(5)
                        ->get();
                @endphp
                <div x-show="openMenu === '{{ $key }}'"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 translate-y-1"
                     class="absolute left-0 mt-0 w-96 bg-white rounded-b-lg shadow-xl border border-gray-200 z-50"
                     @mouseenter="openMenu = '{{ $key }}'"
                     @mouseleave="openMenu = null">
                    <div class="p-6">
                        <h3 class="text-sm font-semibold text-gray-900 mb-4">{{ $item[$currentLocale] }}</h3>
                        <div class="space-y-3">
                            @forelse($categoryServices as $service)
                                <a href="{{ route('services.detail', ['locale' => $currentLocale, 'slug' => $service->slug]) }}"
                                   class="block text-sm text-gray-700 hover:text-pink-600 transition-colors">
                                    {{ $service->getTranslation('title', $currentLocale) }}
                                </a>
                            @empty
                                <p class="text-sm text-gray-500">
                                    {{ $currentLocale === 'fr' ? 'Aucun service disponible' :
                                       ($currentLocale === 'de' ? 'Keine Dienstleistungen verfügbar' :
                                       ($currentLocale === 'en' ? 'No services available' : 'No hay servicios disponibles')) }}
                                </p>
                            @endforelse
                        </div>
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <a href="{{ $url }}" class="text-sm font-medium text-pink-600 hover:text-pink-700">
                                {{ $currentLocale === 'fr' ? 'Tout voir' : ($currentLocale === 'de' ? 'Alles anzeigen' : ($currentLocale === 'en' ? 'View all' : 'Ver todo')) }} →
                            </a>
                        </div>
                    </div>
                </div>
                @elseif($key === 'about')
                <div x-show="openMenu === '{{ $key }}'"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 translate-y-1"
                     class="absolute left-0 mt-0 w-96 bg-white rounded-b-lg shadow-xl border border-gray-200 z-50"
                     @mouseenter="openMenu = '{{ $key }}'"
                     @mouseleave="openMenu = null">
                    <div class="p-6">
                        <h3 class="text-sm font-semibold text-gray-900 mb-4">{{ $item[$currentLocale] }}</h3>
                        <div class="space-y-3">
                            <a href="{{ route('about', ['locale' => $currentLocale]) }}" class="block text-sm text-gray-700 hover:text-pink-600">
                                {{ $currentLocale === 'fr' ? 'À propos' : ($currentLocale === 'de' ? 'Über uns' : ($currentLocale === 'en' ? 'About' : 'Nosotros')) }}
                            </a>
                            <a href="{{ route('agencies', ['locale' => $currentLocale]) }}" class="block text-sm text-gray-700 hover:text-pink-600">
                                {{ $currentLocale === 'fr' ? 'Nos agences' : ($currentLocale === 'de' ? 'Unsere Standorte' : ($currentLocale === 'en' ? 'Our branches' : 'Nuestras agencias')) }}
                            </a>
                            <a href="{{ route('blog', ['locale' => $currentLocale]) }}" class="block text-sm text-gray-700 hover:text-pink-600">
                                Blog
                            </a>
                            <a href="{{ route('career.index', ['locale' => $currentLocale]) }}" class="block text-sm text-gray-700 hover:text-pink-600">
                                {{ $currentLocale === 'fr' ? 'Carrières' : ($currentLocale === 'de' ? 'Karriere' : ($currentLocale === 'en' ? 'Careers' : 'Carreras')) }}
                            </a>
                            <a href="{{ route('contact', ['locale' => $currentLocale]) }}" class="block text-sm text-gray-700 hover:text-pink-600">
                                Contact
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</nav>
