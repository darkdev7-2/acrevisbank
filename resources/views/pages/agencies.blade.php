<x-layouts.app>
    @php
        use App\Models\Agency;
        $currentLocale = app()->getLocale();
        $agencies = Agency::where('is_active', true)->orderBy('city')->get();

        $openingHoursLabel = [
            'fr' => 'Horaires',
            'de' => 'Öffnungszeiten',
            'en' => 'Opening hours',
            'es' => 'Horario'
        ][$currentLocale];
    @endphp
    <x-slot name="title">{{ $currentLocale === 'fr' ? 'Nos Agences' : ($currentLocale === 'de' ? 'Unsere Filialen' : ($currentLocale === 'en' ? 'Our Branches' : 'Nuestras Sucursales')) }}</x-slot>

    <div class="bg-gradient-to-r from-pink-600 to-pink-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $currentLocale === 'fr' ? 'Nos Agences' : ($currentLocale === 'de' ? 'Unsere Filialen' : ($currentLocale === 'en' ? 'Our Branches' : 'Nuestras Sucursales')) }}</h1>
            <p class="text-xl text-pink-100">{{ $currentLocale === 'fr' ? 'Trouvez l\'agence la plus proche de chez vous' : ($currentLocale === 'de' ? 'Finden Sie die nächstgelegene Filiale' : ($currentLocale === 'en' ? 'Find the nearest branch' : 'Encuentre la sucursal más cercana')) }}</p>
            @if($agencies->count() > 0)
                <p class="text-pink-100 mt-2">{{ $agencies->count() }} {{ $currentLocale === 'fr' ? 'agences disponibles' : ($currentLocale === 'de' ? 'verfügbare Filialen' : ($currentLocale === 'en' ? 'branches available' : 'sucursales disponibles')) }}</p>
            @endif
        </div>
    </div>

    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($agencies->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($agencies as $agency)
                        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow" id="agency-{{ $agency->id }}">
                            <div class="flex items-start justify-between mb-3">
                                <h3 class="text-xl font-bold text-pink-600">
                                    {{ $agency->getTranslation('name', $currentLocale) }}
                                </h3>
                                @if($agency->latitude && $agency->longitude)
                                    <a href="https://maps.google.com/?q={{ $agency->latitude }},{{ $agency->longitude }}"
                                       target="_blank"
                                       class="text-gray-400 hover:text-pink-600 transition-colors"
                                       title="{{ $currentLocale === 'fr' ? 'Voir sur la carte' : ($currentLocale === 'de' ? 'Auf Karte anzeigen' : ($currentLocale === 'en' ? 'View on map' : 'Ver en mapa')) }}">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </a>
                                @endif
                            </div>

                            <!-- Address -->
                            <div class="text-gray-600 text-sm mb-4 space-y-1">
                                @if($agency->address)
                                    <p>{{ $agency->getTranslation('address', $currentLocale) }}</p>
                                @endif
                                @if($agency->postal_code && $agency->city)
                                    <p>{{ $agency->postal_code }} {{ $agency->city }}</p>
                                @endif
                                @if($agency->phone)
                                    <p class="mt-2">
                                        <a href="tel:{{ $agency->phone }}" class="text-pink-600 hover:text-pink-700 font-medium">
                                            {{ $agency->phone }}
                                        </a>
                                    </p>
                                @endif
                                @if($agency->email)
                                    <p>
                                        <a href="mailto:{{ $agency->email }}" class="text-pink-600 hover:text-pink-700">
                                            {{ $agency->email }}
                                        </a>
                                    </p>
                                @endif
                            </div>

                            <!-- Description -->
                            @if($agency->description)
                                <p class="text-sm text-gray-500 mb-3 line-clamp-2">
                                    {{ $agency->getTranslation('description', $currentLocale) }}
                                </p>
                            @endif

                            <!-- Opening Hours -->
                            @if($agency->opening_hours)
                                <div class="pt-3 border-t border-gray-200">
                                    <p class="text-xs font-semibold text-gray-700 mb-2">{{ $openingHoursLabel }}</p>
                                    <div class="text-xs text-gray-600 space-y-1">
                                        @php
                                            $dayLabels = [
                                                'monday' => ['fr' => 'Lun', 'de' => 'Mo', 'en' => 'Mon', 'es' => 'Lun'],
                                                'tuesday' => ['fr' => 'Mar', 'de' => 'Di', 'en' => 'Tue', 'es' => 'Mar'],
                                                'wednesday' => ['fr' => 'Mer', 'de' => 'Mi', 'en' => 'Wed', 'es' => 'Mié'],
                                                'thursday' => ['fr' => 'Jeu', 'de' => 'Do', 'en' => 'Thu', 'es' => 'Jue'],
                                                'friday' => ['fr' => 'Ven', 'de' => 'Fr', 'en' => 'Fri', 'es' => 'Vie'],
                                                'saturday' => ['fr' => 'Sam', 'de' => 'Sa', 'en' => 'Sat', 'es' => 'Sáb'],
                                                'sunday' => ['fr' => 'Dim', 'de' => 'So', 'en' => 'Sun', 'es' => 'Dom'],
                                            ];
                                        @endphp
                                        @foreach($agency->opening_hours as $day => $hours)
                                            <div class="flex justify-between">
                                                <span class="font-medium">{{ $dayLabels[$day][$currentLocale] ?? ucfirst($day) }}</span>
                                                <span>{{ $hours }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">
                        {{ $currentLocale === 'fr' ? 'Aucune agence disponible' : ($currentLocale === 'de' ? 'Keine Filiale verfügbar' : ($currentLocale === 'en' ? 'No branches available' : 'No hay sucursales disponibles')) }}
                    </h3>
                    <p class="text-gray-600">
                        {{ $currentLocale === 'fr' ? 'Veuillez nous contacter pour plus d\'informations.' : ($currentLocale === 'de' ? 'Bitte kontaktieren Sie uns für weitere Informationen.' : ($currentLocale === 'en' ? 'Please contact us for more information.' : 'Por favor contáctenos para más información.')) }}
                    </p>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
