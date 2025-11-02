<x-layouts.app>
    @php $currentLocale = app()->getLocale(); @endphp
    <x-slot name="title">{{ $currentLocale === 'fr' ? 'Carrière' : ($currentLocale === 'de' ? 'Karriere' : ($currentLocale === 'en' ? 'Career' : 'Carrera')) }}</x-slot>

    <div class="bg-gradient-to-r from-pink-600 to-pink-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                {{ $currentLocale === 'fr' ? 'Rejoignez notre équipe' : ($currentLocale === 'de' ? 'Treten Sie unserem Team bei' : ($currentLocale === 'en' ? 'Join our team' : 'Únase a nuestro equipo')) }}
            </h1>
            <p class="text-xl text-pink-100">{{ $currentLocale === 'fr' ? 'Opportunités de carrière chez Acrevis Bank' : ($currentLocale === 'de' ? 'Karrieremöglichkeiten bei Acrevis Bank' : ($currentLocale === 'en' ? 'Career opportunities at Acrevis Bank' : 'Oportunidades de carrera en Acrevis Bank')) }}</p>
        </div>
    </div>

    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">{{ $currentLocale === 'fr' ? 'Aucune offre pour le moment' : ($currentLocale === 'de' ? 'Derzeit keine Angebote' : ($currentLocale === 'en' ? 'No openings at the moment' : 'No hay ofertas en este momento')) }}</h3>
            <p class="mt-1 text-sm text-gray-500">{{ $currentLocale === 'fr' ? 'Envoyez votre candidature spontanée à careers@acrevis.ch' : ($currentLocale === 'de' ? 'Senden Sie Ihre Initiativbewerbung an careers@acrevis.ch' : ($currentLocale === 'en' ? 'Send your unsolicited application to careers@acrevis.ch' : 'Envíe su solicitud espontánea a careers@acrevis.ch')) }}</p>
        </div>
    </div>
</x-layouts.app>
