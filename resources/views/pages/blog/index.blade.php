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
        </div>
    </div>
</x-layouts.app>
