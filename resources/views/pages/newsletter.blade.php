<x-layouts.app>
    @php $currentLocale = app()->getLocale(); @endphp
    <x-slot name="title">Newsletter</x-slot>

    <div class="bg-gradient-to-r from-pink-600 to-pink-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Newsletter</h1>
            <p class="text-xl text-pink-100">{{ $currentLocale === 'fr' ? 'Restez informé de nos actualités' : ($currentLocale === 'de' ? 'Bleiben Sie über unsere Neuigkeiten informiert' : ($currentLocale === 'en' ? 'Stay informed about our news' : 'Manténgase informado de nuestras noticias')) }}</p>
        </div>
    </div>

    <div class="py-16 bg-gray-50">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md p-8">
                <h2 class="text-2xl font-bold mb-6">{{ $currentLocale === 'fr' ? 'Abonnez-vous à notre newsletter' : ($currentLocale === 'de' ? 'Abonnieren Sie unseren Newsletter' : ($currentLocale === 'en' ? 'Subscribe to our newsletter' : 'Suscríbase a nuestro boletín')) }}</h2>
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ $currentLocale === 'fr' ? 'Email' : ($currentLocale === 'de' ? 'E-Mail' : ($currentLocale === 'en' ? 'Email' : 'Correo electrónico')) }}</label>
                        <input type="email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500" placeholder="votre@email.com" required>
                    </div>
                    <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white py-3 rounded-md font-semibold transition-colors">
                        {{ $currentLocale === 'fr' ? 'S\'abonner' : ($currentLocale === 'de' ? 'Abonnieren' : ($currentLocale === 'en' ? 'Subscribe' : 'Suscribirse')) }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
