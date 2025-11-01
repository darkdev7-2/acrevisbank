@php
    $currentLocale = app()->getLocale();
    $currentSegment = session('segment', 'privat');

    $menuItems = [
        'accounts' => [
            'fr' => 'Comptes & Cartes',
            'de' => 'Konto & Karte',
            'en' => 'Accounts & Cards',
            'es' => 'Cuentas y Tarjetas',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />'
        ],
        'housing' => [
            'fr' => 'Financer un logement',
            'de' => 'Wohneigentum finanzieren',
            'en' => 'Finance Housing',
            'es' => 'Financiar Vivienda',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />'
        ],
        'invest' => [
            'fr' => 'Placer son argent',
            'de' => 'Geld anlegen',
            'en' => 'Invest Money',
            'es' => 'Invertir Dinero',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />'
        ],
        'planning' => [
            'fr' => 'Planification & Prévoyance',
            'de' => 'Finanzplanung & Vorsorge',
            'en' => 'Planning & Pension',
            'es' => 'Planificación y Previsión',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />'
        ],
        'about' => [
            'fr' => 'À propos de nous',
            'de' => 'Über uns',
            'en' => 'About us',
            'es' => 'Sobre nosotros',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />'
        ],
    ];
@endphp

<nav class="bg-white border-t border-gray-100" x-data="{ openMenu: null }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-start space-x-8 h-14">
            @foreach($menuItems as $key => $item)
            <div class="relative" @mouseenter="openMenu = '{{ $key }}'" @mouseleave="openMenu = null">
                <a href="{{ route('services.' . $key, ['locale' => $currentLocale]) }}"
                   class="flex items-center space-x-2 text-sm font-medium text-gray-700 hover:text-pink-600 transition-colors py-4 border-b-2 {{ request()->routeIs('services.' . $key) ? 'border-pink-600 text-pink-600' : 'border-transparent' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $item['icon'] !!}
                    </svg>
                    <span>{{ $item[$currentLocale] }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </a>

                <!-- Dropdown Menu (Mega Menu) -->
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

                        @if($key === 'accounts')
                        <div class="space-y-3">
                            <a href="{{ route('services.detail', ['locale' => $currentLocale, 'slug' => 'compte-prive']) }}" class="block text-sm text-gray-700 hover:text-pink-600">
                                {{ $currentLocale === 'fr' ? 'Compte privé' : ($currentLocale === 'de' ? 'Privatkonto' : ($currentLocale === 'en' ? 'Private Account' : 'Cuenta Privada')) }}
                            </a>
                            <a href="{{ route('services.detail', ['locale' => $currentLocale, 'slug' => 'cartes']) }}" class="block text-sm text-gray-700 hover:text-pink-600">
                                {{ $currentLocale === 'fr' ? 'Cartes' : ($currentLocale === 'de' ? 'Karten' : ($currentLocale === 'en' ? 'Cards' : 'Tarjetas')) }}
                            </a>
                            <a href="{{ route('services.detail', ['locale' => $currentLocale, 'slug' => 'epargne']) }}" class="block text-sm text-gray-700 hover:text-pink-600">
                                {{ $currentLocale === 'fr' ? 'Épargne' : ($currentLocale === 'de' ? 'Sparen' : ($currentLocale === 'en' ? 'Savings' : 'Ahorros')) }}
                            </a>
                            <a href="{{ route('services.detail', ['locale' => $currentLocale, 'slug' => 'paiements']) }}" class="block text-sm text-gray-700 hover:text-pink-600">
                                {{ $currentLocale === 'fr' ? 'Paiements' : ($currentLocale === 'de' ? 'Zahlen' : ($currentLocale === 'en' ? 'Payments' : 'Pagos')) }}
                            </a>
                            <a href="{{ route('ebanking.login', ['locale' => $currentLocale]) }}" class="block text-sm text-gray-700 hover:text-pink-600">
                                E-Banking
                            </a>
                        </div>
                        @elseif($key === 'housing')
                        <div class="space-y-3">
                            <a href="{{ route('services.detail', ['locale' => $currentLocale, 'slug' => 'hypotheque']) }}" class="block text-sm text-gray-700 hover:text-pink-600">
                                {{ $currentLocale === 'fr' ? 'Hypothèque' : ($currentLocale === 'de' ? 'Hypothek' : ($currentLocale === 'en' ? 'Mortgage' : 'Hipoteca')) }}
                            </a>
                            <a href="{{ route('credit.request', ['locale' => $currentLocale]) }}" class="block text-sm text-gray-700 hover:text-pink-600">
                                {{ $currentLocale === 'fr' ? 'Demande de crédit' : ($currentLocale === 'de' ? 'Kreditanfrage' : ($currentLocale === 'en' ? 'Credit Request' : 'Solicitud de Crédito')) }}
                            </a>
                        </div>
                        @elseif($key === 'invest')
                        <div class="space-y-3">
                            <a href="{{ route('services.detail', ['locale' => $currentLocale, 'slug' => 'placements']) }}" class="block text-sm text-gray-700 hover:text-pink-600">
                                {{ $currentLocale === 'fr' ? 'Placements' : ($currentLocale === 'de' ? 'Anlagen' : ($currentLocale === 'en' ? 'Investments' : 'Inversiones')) }}
                            </a>
                            <a href="{{ route('services.detail', ['locale' => $currentLocale, 'slug' => 'fonds']) }}" class="block text-sm text-gray-700 hover:text-pink-600">
                                {{ $currentLocale === 'fr' ? 'Fonds' : ($currentLocale === 'de' ? 'Fonds' : ($currentLocale === 'en' ? 'Funds' : 'Fondos')) }}
                            </a>
                        </div>
                        @elseif($key === 'planning')
                        <div class="space-y-3">
                            <a href="{{ route('services.detail', ['locale' => $currentLocale, 'slug' => 'prevoyance']) }}" class="block text-sm text-gray-700 hover:text-pink-600">
                                {{ $currentLocale === 'fr' ? 'Prévoyance' : ($currentLocale === 'de' ? 'Vorsorge' : ($currentLocale === 'en' ? 'Pension' : 'Previsión')) }}
                            </a>
                            <a href="{{ route('services.detail', ['locale' => $currentLocale, 'slug' => 'assurances']) }}" class="block text-sm text-gray-700 hover:text-pink-600">
                                {{ $currentLocale === 'fr' ? 'Assurances' : ($currentLocale === 'de' ? 'Versicherungen' : ($currentLocale === 'en' ? 'Insurance' : 'Seguros')) }}
                            </a>
                        </div>
                        @elseif($key === 'about')
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
                            <a href="{{ route('career', ['locale' => $currentLocale]) }}" class="block text-sm text-gray-700 hover:text-pink-600">
                                {{ $currentLocale === 'fr' ? 'Carrière' : ($currentLocale === 'de' ? 'Karriere' : ($currentLocale === 'en' ? 'Career' : 'Carrera')) }}
                            </a>
                        </div>
                        @endif

                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <a href="{{ route('services.' . $key, ['locale' => $currentLocale]) }}" class="text-sm font-medium text-pink-600 hover:text-pink-700">
                                {{ $currentLocale === 'fr' ? 'Tout voir' : ($currentLocale === 'de' ? 'Alles anzeigen' : ($currentLocale === 'en' ? 'View all' : 'Ver todo')) }} →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</nav>
