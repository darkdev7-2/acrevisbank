@php
    $currentSegment = session('segment', 'privat');
    $currentLocale = app()->getLocale();

    $translations = [
        'privat' => ['fr' => 'Privé', 'de' => 'Privat', 'en' => 'Private', 'es' => 'Privado'],
        'business' => ['fr' => 'Entreprise', 'de' => 'Geschäftlich', 'en' => 'Business', 'es' => 'Empresa'],
        'career' => ['fr' => 'Carrière', 'de' => 'Karriere', 'en' => 'Career', 'es' => 'Carrera'],
        'newsletter' => ['fr' => 'Newsletter', 'de' => 'Newsletter', 'en' => 'Newsletter', 'es' => 'Newsletter'],
        'contact' => ['fr' => 'Contact & Aide', 'de' => 'Kontakt & Hilfe', 'en' => 'Contact & Help', 'es' => 'Contacto y Ayuda'],
        'search' => ['fr' => 'Rechercher', 'de' => 'Suche', 'en' => 'Search', 'es' => 'Buscar'],
        'ebanking' => ['fr' => 'E-Banking', 'de' => 'E-Banking', 'en' => 'E-Banking', 'es' => 'E-Banking'],
    ];
@endphp

<header class="bg-white border-b border-gray-200">
    <!-- Top Bar -->
    <div class="border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('home', ['locale' => $currentLocale]) }}" class="flex items-center">
                        <span class="text-3xl font-bold text-pink-600">acrevis</span>
                        <span class="ml-2 text-xs text-gray-600 font-light">Meine Bank fürs Leben</span>
                    </a>
                </div>

                <!-- Segment Switch -->
                <div class="flex items-center space-x-1 bg-gray-100 rounded-lg p-1">
                    <a href="{{ route('segment.switch', ['segment' => 'privat', 'locale' => $currentLocale]) }}"
                       class="px-4 py-2 rounded-md text-sm font-medium transition-colors {{ $currentSegment === 'privat' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                        {{ $translations['privat'][$currentLocale] }}
                    </a>
                    <a href="{{ route('segment.switch', ['segment' => 'business', 'locale' => $currentLocale]) }}"
                       class="px-4 py-2 rounded-md text-sm font-medium transition-colors {{ $currentSegment === 'business' ? 'bg-white text-gray-900 shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                        {{ $translations['business'][$currentLocale] }}
                    </a>
                </div>

                <!-- Top Right Icons -->
                <div class="flex items-center space-x-6">
                    <!-- Career -->
                    <a href="{{ route('career', ['locale' => $currentLocale]) }}" class="flex flex-col items-center group">
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-pink-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span class="text-xs text-gray-600 mt-1 group-hover:text-pink-600 transition-colors">{{ $translations['career'][$currentLocale] }}</span>
                    </a>

                    <!-- Newsletter -->
                    <a href="{{ route('newsletter', ['locale' => $currentLocale]) }}" class="flex flex-col items-center group">
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-pink-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span class="text-xs text-gray-600 mt-1 group-hover:text-pink-600 transition-colors">Newsletter</span>
                    </a>

                    <!-- Contact -->
                    <a href="{{ route('contact', ['locale' => $currentLocale]) }}" class="flex flex-col items-center group">
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-pink-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-xs text-gray-600 mt-1 group-hover:text-pink-600 transition-colors">{{ $translations['contact'][$currentLocale] }}</span>
                    </a>

                    <!-- Search -->
                    <button @click="$dispatch('open-search')" class="flex flex-col items-center group">
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-pink-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span class="text-xs text-gray-600 mt-1 group-hover:text-pink-600 transition-colors">{{ $translations['search'][$currentLocale] }}</span>
                    </button>

                    <!-- E-Banking -->
                    <a href="{{ route('ebanking.login', ['locale' => $currentLocale]) }}" class="flex flex-col items-center group">
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-pink-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <span class="text-xs text-gray-600 mt-1 group-hover:text-pink-600 transition-colors">E-Banking</span>
                    </a>

                    <!-- Language Switcher -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-1 text-sm font-medium text-gray-600 hover:text-gray-900">
                            <span class="uppercase">{{ $currentLocale }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false"
                             class="absolute right-0 mt-2 w-32 bg-white rounded-md shadow-lg py-1 z-50">
                            @foreach(['fr', 'de', 'en', 'es'] as $locale)
                                <a href="{{ route('locale.switch', ['locale' => $locale]) }}"
                                   class="block px-4 py-2 text-sm {{ $currentLocale === $locale ? 'bg-pink-50 text-pink-600' : 'text-gray-700 hover:bg-gray-100' }}">
                                    {{ strtoupper($locale) }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    @include('partials.navigation')
</header>
