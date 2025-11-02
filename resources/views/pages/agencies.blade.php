<x-layouts.app>
    @php $currentLocale = app()->getLocale(); @endphp
    <x-slot name="title">{{ $currentLocale === 'fr' ? 'Nos Agences' : ($currentLocale === 'de' ? 'Unsere Filialen' : ($currentLocale === 'en' ? 'Our Branches' : 'Nuestras Sucursales')) }}</x-slot>

    <div class="bg-gradient-to-r from-pink-600 to-pink-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $currentLocale === 'fr' ? 'Nos Agences' : ($currentLocale === 'de' ? 'Unsere Filialen' : ($currentLocale === 'en' ? 'Our Branches' : 'Nuestras Sucursales')) }}</h1>
            <p class="text-xl text-pink-100">{{ $currentLocale === 'fr' ? 'Trouvez l\'agence la plus proche de chez vous' : ($currentLocale === 'de' ? 'Finden Sie die nächstgelegene Filiale' : ($currentLocale === 'en' ? 'Find the nearest branch' : 'Encuentre la sucursal más cercana')) }}</p>
        </div>
    </div>

    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold mb-2">St. Gallen (Siège)</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        St. Leonhardstrasse 25<br>
                        9001 St. Gallen<br>
                        +41 71 227 27 27
                    </p>
                    <p class="text-sm text-gray-500">{{ $currentLocale === 'fr' ? 'Lun-Ven: 8h-18h' : ($currentLocale === 'de' ? 'Mo-Fr: 8-18 Uhr' : ($currentLocale === 'en' ? 'Mon-Fri: 8am-6pm' : 'Lun-Vie: 8h-18h')) }}</p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold mb-2">Zürich</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        Bahnhofstrasse 45<br>
                        8001 Zürich<br>
                        +41 44 123 45 67
                    </p>
                    <p class="text-sm text-gray-500">{{ $currentLocale === 'fr' ? 'Lun-Ven: 8h-18h' : ($currentLocale === 'de' ? 'Mo-Fr: 8-18 Uhr' : ($currentLocale === 'en' ? 'Mon-Fri: 8am-6pm' : 'Lun-Vie: 8h-18h')) }}</p>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold mb-2">Genève</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        Rue du Rhône 12<br>
                        1204 Genève<br>
                        +41 22 345 67 89
                    </p>
                    <p class="text-sm text-gray-500">{{ $currentLocale === 'fr' ? 'Lun-Ven: 8h-18h' : ($currentLocale === 'de' ? 'Mo-Fr: 8-18 Uhr' : ($currentLocale === 'en' ? 'Mon-Fri: 8am-6pm' : 'Lun-Vie: 8h-18h')) }}</p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
