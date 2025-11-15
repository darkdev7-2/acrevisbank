<div>
    @php
        $currentLocale = app()->getLocale();
        $texts = [
            'fr' => [
                'search' => 'Rechercher...',
                'no_results' => 'Aucun résultat trouvé',
                'min_chars' => 'Tapez au moins 2 caractères pour rechercher',
                'service' => 'Service',
                'article' => 'Article',
                'close' => 'Fermer',
            ],
            'de' => [
                'search' => 'Suchen...',
                'no_results' => 'Keine Ergebnisse gefunden',
                'min_chars' => 'Geben Sie mindestens 2 Zeichen ein, um zu suchen',
                'service' => 'Dienstleistung',
                'article' => 'Artikel',
                'close' => 'Schließen',
            ],
            'en' => [
                'search' => 'Search...',
                'no_results' => 'No results found',
                'min_chars' => 'Type at least 2 characters to search',
                'service' => 'Service',
                'article' => 'Article',
                'close' => 'Close',
            ],
            'es' => [
                'search' => 'Buscar...',
                'no_results' => 'No se encontraron resultados',
                'min_chars' => 'Escriba al menos 2 caracteres para buscar',
                'service' => 'Servicio',
                'article' => 'Artículo',
                'close' => 'Cerrar',
            ]
        ];
        $t = $texts[$currentLocale];
    @endphp

    <!-- Modal Overlay -->
    <div x-data="{ show: @entangle('isOpen') }"
         x-show="show"
         x-cloak
         @keydown.escape.window="$wire.close()"
         class="fixed inset-0 z-50 overflow-y-auto"
         style="display: none;">

        <!-- Backdrop -->
        <div x-show="show"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity"
             @click="$wire.close()">
        </div>

        <!-- Modal Content -->
        <div class="flex min-h-screen items-start justify-center p-4 pt-20">
            <div x-show="show"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="w-full max-w-2xl bg-white rounded-lg shadow-xl overflow-hidden"
                 @click.stop>

                <!-- Search Input -->
                <div class="p-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text"
                               wire:model.live.debounce.300ms="query"
                               placeholder="{{ $t['search'] }}"
                               class="flex-1 text-lg border-0 focus:ring-0 focus:outline-none"
                               autofocus>
                        <button @click="$wire.close()" class="text-gray-400 hover:text-gray-600 ml-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Results -->
                <div class="max-h-96 overflow-y-auto p-4">
                    @if(strlen($query) < 2)
                        <p class="text-center text-gray-500 py-8">{{ $t['min_chars'] }}</p>
                    @elseif(empty($results))
                        <p class="text-center text-gray-500 py-8">{{ $t['no_results'] }}</p>
                    @else
                        <div class="space-y-2">
                            @foreach($results as $result)
                                <a href="{{ $result['url'] }}"
                                   wire:click="close"
                                   class="block p-4 hover:bg-gray-50 rounded-lg transition-colors group">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            @if($result['type'] === 'service')
                                                <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center group-hover:bg-pink-200 transition-colors">
                                                    <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @else
                                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4 flex-1">
                                            <div class="flex items-center justify-between">
                                                <h3 class="text-sm font-semibold text-gray-900 group-hover:text-pink-600 transition-colors">
                                                    {{ $result['title'] }}
                                                </h3>
                                                <span class="text-xs text-gray-500 ml-2">
                                                    {{ $result['type'] === 'service' ? $t['service'] : $t['article'] }}
                                                </span>
                                            </div>
                                            <p class="text-sm text-gray-600 mt-1 line-clamp-2">
                                                {{ $result['description'] }}
                                            </p>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400 ml-2 flex-shrink-0 group-hover:text-pink-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Loading Indicator -->
                <div wire:loading class="absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center">
                    <svg class="animate-spin h-8 w-8 text-pink-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>

            </div>
        </div>
    </div>
</div>
