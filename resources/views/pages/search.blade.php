<x-layouts.app>
    <x-slot name="title">{{ __('Résultats de recherche') }}@if($query) : {{ $query }}@endif</x-slot>

    @php
        $currentLocale = app()->getLocale();
        $typeLabels = [
            'article' => ['fr' => 'Article', 'de' => 'Artikel', 'en' => 'Article', 'es' => 'Artículo'],
            'service' => ['fr' => 'Service', 'de' => 'Dienstleistung', 'en' => 'Service', 'es' => 'Servicio'],
            'page' => ['fr' => 'Page', 'de' => 'Seite', 'en' => 'Page', 'es' => 'Página'],
            'agency' => ['fr' => 'Agence', 'de' => 'Agentur', 'en' => 'Agency', 'es' => 'Agencia'],
        ];
    @endphp

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-pink-600 to-pink-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold mb-6">{{ __('Recherche') }}</h1>

            <!-- Search Form -->
            <form action="{{ route('search.index', ['locale' => $currentLocale]) }}" method="GET" class="max-w-3xl">
                <div class="relative">
                    <input
                        type="search"
                        name="q"
                        value="{{ $query }}"
                        placeholder="{{ __('Rechercher des services, articles, agences...') }}"
                        class="w-full px-6 py-4 pr-14 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-pink-300"
                        autofocus
                    >
                    <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 bg-pink-600 text-white p-3 rounded-lg hover:bg-pink-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </form>

            @if($query)
                <p class="mt-4 text-pink-100">
                    {{ $total }} {{ __('résultat(s) pour') }} <strong>"{{ $query }}"</strong>
                </p>
            @endif
        </div>
    </div>

    <!-- Results Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if(empty($query))
            <!-- Empty State -->
            <div class="text-center py-16">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('Que recherchez-vous ?') }}</h3>
                <p class="text-gray-600">{{ __('Entrez un mot-clé pour rechercher des services, articles, pages ou agences.') }}</p>
            </div>

        @elseif($total === 0)
            <!-- No Results -->
            <div class="text-center py-16">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('Aucun résultat trouvé') }}</h3>
                <p class="text-gray-600 mb-6">{{ __('Essayez avec d\'autres mots-clés ou vérifiez l\'orthographe.') }}</p>

                <!-- Suggestions -->
                <div class="max-w-2xl mx-auto">
                    <h4 class="font-medium text-gray-900 mb-4">{{ __('Suggestions :') }}</h4>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="{{ route('services.index', ['locale' => $currentLocale]) }}" class="p-4 border border-gray-200 rounded-lg hover:border-pink-600 hover:shadow-md transition-all">
                            <div class="text-2xl mb-2">💳</div>
                            <div class="text-sm font-medium">{{ __('Services') }}</div>
                        </a>
                        <a href="{{ route('blog', ['locale' => $currentLocale]) }}" class="p-4 border border-gray-200 rounded-lg hover:border-pink-600 hover:shadow-md transition-all">
                            <div class="text-2xl mb-2">📰</div>
                            <div class="text-sm font-medium">{{ __('Blog') }}</div>
                        </a>
                        <a href="{{ route('agencies', ['locale' => $currentLocale]) }}" class="p-4 border border-gray-200 rounded-lg hover:border-pink-600 hover:shadow-md transition-all">
                            <div class="text-2xl mb-2">📍</div>
                            <div class="text-sm font-medium">{{ __('Agences') }}</div>
                        </a>
                        <a href="{{ route('contact', ['locale' => $currentLocale]) }}" class="p-4 border border-gray-200 rounded-lg hover:border-pink-600 hover:shadow-md transition-all">
                            <div class="text-2xl mb-2">💬</div>
                            <div class="text-sm font-medium">{{ __('Contact') }}</div>
                        </a>
                    </div>
                </div>
            </div>

        @else
            <!-- Results Stats -->
            @if(isset($articleCount, $serviceCount, $pageCount, $agencyCount))
                <div class="flex flex-wrap gap-3 mb-8">
                    @if($articleCount > 0)
                        <span class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                            {{ $articleCount }} {{ $articleCount > 1 ? __('articles') : __('article') }}
                        </span>
                    @endif
                    @if($serviceCount > 0)
                        <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                            {{ $serviceCount }} {{ $serviceCount > 1 ? __('services') : __('service') }}
                        </span>
                    @endif
                    @if($pageCount > 0)
                        <span class="px-4 py-2 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">
                            {{ $pageCount }} {{ $pageCount > 1 ? __('pages') : __('page') }}
                        </span>
                    @endif
                    @if($agencyCount > 0)
                        <span class="px-4 py-2 bg-orange-100 text-orange-800 rounded-full text-sm font-medium">
                            {{ $agencyCount }} {{ $agencyCount > 1 ? __('agences') : __('agence') }}
                        </span>
                    @endif
                </div>
            @endif

            <!-- Results List -->
            <div class="space-y-6">
                @foreach($results as $result)
                    <a href="{{ $result['url'] }}" class="block bg-white rounded-lg border border-gray-200 hover:border-pink-600 hover:shadow-lg transition-all p-6 group">
                        <div class="flex items-start justify-between mb-2">
                            <div class="flex-1">
                                <!-- Type Badge -->
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                    {{ $result['type'] === 'article' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $result['type'] === 'service' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $result['type'] === 'page' ? 'bg-purple-100 text-purple-800' : '' }}
                                    {{ $result['type'] === 'agency' ? 'bg-orange-100 text-orange-800' : '' }}
                                ">
                                    @if($result['type'] === 'article') 📰
                                    @elseif($result['type'] === 'service') 💳
                                    @elseif($result['type'] === 'page') 📄
                                    @elseif($result['type'] === 'agency') 📍
                                    @endif
                                    {{ $typeLabels[$result['type']][$currentLocale] ?? $result['type'] }}
                                </span>
                            </div>

                            <svg class="w-5 h-5 text-gray-400 group-hover:text-pink-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>

                        <h3 class="text-xl font-semibold text-gray-900 group-hover:text-pink-600 transition-colors mb-2">
                            {{ $result['title'] }}
                        </h3>

                        <p class="text-gray-600 mb-3">
                            {{ $result['excerpt'] }}
                        </p>

                        <div class="flex items-center text-sm text-gray-500 space-x-4">
                            @if(isset($result['category']))
                                <span>{{ $result['category'] }}</span>
                            @endif
                            @if(isset($result['date']))
                                <span>{{ $result['date'] }}</span>
                            @endif
                            @if(isset($result['city']))
                                <span>📍 {{ $result['city'] }}</span>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</x-layouts.app>
