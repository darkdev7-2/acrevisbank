<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();
    @endphp

    <x-slot name="title">{{ $service->getTranslation('title', $currentLocale) }}</x-slot>
    <x-slot name="metaDescription">{{ $service->getTranslation('description', $currentLocale) }}</x-slot>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-pink-600 to-pink-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center mb-4">
                <a href="{{ route('services.index', ['locale' => $currentLocale]) }}"
                   class="text-white/80 hover:text-white flex items-center text-sm">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    {{ $currentLocale === 'fr' ? 'Retour aux services' :
                       ($currentLocale === 'de' ? 'Zurück zu den Dienstleistungen' :
                       ($currentLocale === 'en' ? 'Back to services' : 'Volver a servicios')) }}
                </a>
            </div>

            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm text-pink-100 mb-2">{{ $service->category }}</div>
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">
                        {{ $service->getTranslation('title', $currentLocale) }}
                    </h1>
                    <p class="text-xl md:text-2xl text-pink-100 max-w-3xl">
                        {{ $service->getTranslation('description', $currentLocale) }}
                    </p>
                </div>

                <div class="hidden md:block">
                    <div class="w-24 h-24 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Main Content Column -->
                <div class="lg:col-span-2">
                    <!-- Service Content -->
                    <div class="bg-white rounded-lg shadow-md p-8 mb-8 prose max-w-none">
                        {!! $service->getTranslation('content', $currentLocale) !!}
                    </div>

                    <!-- Features Section -->
                    @if($service->getTranslation('features', $currentLocale))
                    <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                        <h2 class="text-2xl font-bold mb-6">
                            {{ $currentLocale === 'fr' ? 'Caractéristiques' :
                               ($currentLocale === 'de' ? 'Merkmale' :
                               ($currentLocale === 'en' ? 'Features' : 'Características')) }}
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($service->getTranslation('features', $currentLocale) as $feature)
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-pink-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-gray-700">{{ $feature }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Benefits Section -->
                    @if($service->getTranslation('benefits', $currentLocale))
                    <div class="bg-gradient-to-r from-pink-50 to-purple-50 rounded-lg p-8">
                        <h2 class="text-2xl font-bold mb-6">
                            {{ $currentLocale === 'fr' ? 'Vos avantages' :
                               ($currentLocale === 'de' ? 'Ihre Vorteile' :
                               ($currentLocale === 'en' ? 'Your benefits' : 'Sus ventajas')) }}
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($service->getTranslation('benefits', $currentLocale) as $benefit)
                            <div class="flex items-start bg-white rounded-lg p-4">
                                <svg class="w-6 h-6 text-green-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-gray-700 font-medium">{{ $benefit }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- CTA Card -->
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6 sticky top-6">
                        <h3 class="text-xl font-bold mb-4">
                            {{ $currentLocale === 'fr' ? 'Intéressé(e) ?' :
                               ($currentLocale === 'de' ? 'Interessiert?' :
                               ($currentLocale === 'en' ? 'Interested?' : '¿Interesado?')) }}
                        </h3>
                        <p class="text-gray-600 mb-6">
                            {{ $currentLocale === 'fr' ? 'Nos conseillers sont à votre disposition pour répondre à vos questions.' :
                               ($currentLocale === 'de' ? 'Unsere Berater stehen Ihnen für Fragen zur Verfügung.' :
                               ($currentLocale === 'en' ? 'Our advisors are available to answer your questions.' : 'Nuestros asesores están a su disposición para responder a sus preguntas.')) }}
                        </p>

                        <div class="space-y-3">
                            <!-- Contact Button -->
                            <a href="{{ route('contact', ['locale' => $currentLocale]) }}"
                               class="block w-full bg-pink-600 hover:bg-pink-700 text-white text-center py-3 rounded-md font-semibold transition-colors">
                                {{ $currentLocale === 'fr' ? 'Demander un rendez-vous' :
                                   ($currentLocale === 'de' ? 'Termin anfragen' :
                                   ($currentLocale === 'en' ? 'Request appointment' : 'Solicitar cita')) }}
                            </a>

                            <!-- Phone Button -->
                            <a href="tel:+41712272727"
                               class="block w-full border-2 border-pink-600 text-pink-600 hover:bg-pink-50 text-center py-3 rounded-md font-semibold transition-colors flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                +41 71 227 27 27
                            </a>
                        </div>

                        <!-- Contact Info -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <div class="text-sm text-gray-600 space-y-2">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ $currentLocale === 'fr' ? 'Lun-Ven: 8h-18h' :
                                       ($currentLocale === 'de' ? 'Mo-Fr: 8-18 Uhr' :
                                       ($currentLocale === 'en' ? 'Mon-Fri: 8am-6pm' : 'Lun-Vie: 8h-18h')) }}
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <a href="mailto:info@acrevis.ch" class="text-pink-600 hover:underline">info@acrevis.ch</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Related Services -->
                    @if($relatedServices->count() > 0)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-bold mb-4">
                            {{ $currentLocale === 'fr' ? 'Services similaires' :
                               ($currentLocale === 'de' ? 'Ähnliche Dienstleistungen' :
                               ($currentLocale === 'en' ? 'Similar services' : 'Servicios similares')) }}
                        </h3>
                        <div class="space-y-3">
                            @foreach($relatedServices as $related)
                            <a href="{{ route('services.detail', ['locale' => $currentLocale, 'slug' => $related->slug]) }}"
                               class="block p-3 hover:bg-gray-50 rounded-md transition-colors group">
                                <div class="font-medium text-gray-900 group-hover:text-pink-600">
                                    {{ $related->getTranslation('title', $currentLocale) }}
                                </div>
                                <div class="text-sm text-gray-500 mt-1">
                                    {{ Str::limit($related->getTranslation('description', $currentLocale), 60) }}
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
