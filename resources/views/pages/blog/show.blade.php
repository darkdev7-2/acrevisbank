<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();
    @endphp

    <x-slot name="title">Article - Blog</x-slot>

    <div class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">
                    {{ $currentLocale === 'fr' ? 'Article non trouvé' :
                       ($currentLocale === 'de' ? 'Artikel nicht gefunden' :
                       ($currentLocale === 'en' ? 'Article not found' : 'Artículo no encontrado')) }}
                </h3>
                <p class="mt-1 text-sm text-gray-500">Slug: {{ $slug }}</p>
                <div class="mt-6">
                    <a href="{{ route('blog', ['locale' => $currentLocale]) }}" class="text-pink-600 hover:text-pink-700">
                        {{ $currentLocale === 'fr' ? '← Retour au blog' :
                           ($currentLocale === 'de' ? '← Zurück zum Blog' :
                           ($currentLocale === 'en' ? '← Back to blog' : '← Volver al blog')) }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
