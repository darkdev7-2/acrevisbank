<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();
    @endphp

    <x-slot name="title">Blog</x-slot>

    <div class="bg-gradient-to-r from-pink-600 to-pink-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Blog</h1>
            <p class="text-xl text-pink-100">
                {{ $currentLocale === 'fr' ? 'Actualités et conseils financiers' :
                   ($currentLocale === 'de' ? 'Nachrichten und Finanzberatung' :
                   ($currentLocale === 'en' ? 'News and financial advice' : 'Noticias y consejos financieros')) }}
            </p>
        </div>
    </div>

    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($articles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($articles as $article)
                        <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                            <a href="{{ route('blog.show', ['locale' => $currentLocale, 'slug' => $article->slug]) }}">
                                <div class="h-56 bg-cover bg-center" style="background-image: url('{{ $article->featured_image ?? 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=600&h=400&fit=crop' }}');"></div>
                            </a>
                            <div class="p-6">
                                <div class="flex items-center space-x-2 text-sm text-gray-500 mb-3">
                                    <span>{{ $article->published_at->format('d.m.Y') }}</span>
                                    @if($article->category)
                                        <span>•</span>
                                        <span>{{ $article->category->getTranslation('name', $currentLocale) }}</span>
                                    @endif
                                    @if($article->is_featured)
                                        <span class="ml-auto bg-pink-100 text-pink-600 px-2 py-1 rounded text-xs font-semibold">
                                            {{ $currentLocale === 'fr' ? 'À la une' :
                                               ($currentLocale === 'de' ? 'Hervorgehoben' :
                                               ($currentLocale === 'en' ? 'Featured' : 'Destacado')) }}
                                        </span>
                                    @endif
                                </div>
                                <a href="{{ route('blog.show', ['locale' => $currentLocale, 'slug' => $article->slug]) }}">
                                    <h2 class="text-xl font-bold mb-3 hover:text-pink-600 transition-colors">
                                        {{ $article->getTranslation('title', $currentLocale) }}
                                    </h2>
                                </a>
                                <p class="text-gray-600 mb-4 line-clamp-3">
                                    {{ $article->getTranslation('excerpt', $currentLocale) }}
                                </p>
                                <div class="flex items-center justify-between">
                                    <a href="{{ route('blog.show', ['locale' => $currentLocale, 'slug' => $article->slug]) }}"
                                       class="inline-flex items-center text-pink-600 hover:text-pink-700 font-medium text-sm">
                                        {{ $currentLocale === 'fr' ? 'Lire la suite' :
                                           ($currentLocale === 'de' ? 'Weiterlesen' :
                                           ($currentLocale === 'en' ? 'Read more' : 'Leer más')) }}
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                    <span class="text-sm text-gray-500">
                                        {{ $article->views }} {{ $currentLocale === 'fr' ? 'vues' :
                                           ($currentLocale === 'de' ? 'Ansichten' :
                                           ($currentLocale === 'en' ? 'views' : 'vistas')) }}
                                    </span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">
                        {{ $currentLocale === 'fr' ? 'Aucun article pour le moment' :
                           ($currentLocale === 'de' ? 'Derzeit keine Artikel' :
                           ($currentLocale === 'en' ? 'No articles yet' : 'No hay artículos todavía')) }}
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        {{ $currentLocale === 'fr' ? 'Consultez bientôt nos actualités et conseils financiers.' :
                           ($currentLocale === 'de' ? 'Lesen Sie bald unsere Neuigkeiten und Finanzberatung.' :
                           ($currentLocale === 'en' ? 'Check back soon for our news and financial advice.' : 'Consulte pronto nuestras noticias y consejos financieros.')) }}
                    </p>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
