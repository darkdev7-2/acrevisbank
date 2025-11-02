<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();
        $selectedCategory = request('category');
        $selectedSegment = request('segment', 'privat');

        $translations = [
            'fr' => [
                'title' => 'Nos Services Bancaires',
                'subtitle' => 'Découvrez notre gamme complète de solutions bancaires adaptées à vos besoins',
                'all_categories' => 'Toutes les catégories',
                'privat' => 'Particuliers',
                'business' => 'Entreprises',
                'discover' => 'Découvrir',
            ],
            'de' => [
                'title' => 'Unsere Bankdienstleistungen',
                'subtitle' => 'Entdecken Sie unser umfassendes Angebot an Banklösungen für Ihre Bedürfnisse',
                'all_categories' => 'Alle Kategorien',
                'privat' => 'Privatkunden',
                'business' => 'Unternehmen',
                'discover' => 'Entdecken',
            ],
            'en' => [
                'title' => 'Our Banking Services',
                'subtitle' => 'Discover our complete range of banking solutions tailored to your needs',
                'all_categories' => 'All categories',
                'privat' => 'Individuals',
                'business' => 'Businesses',
                'discover' => 'Discover',
            ],
            'es' => [
                'title' => 'Nuestros Servicios Bancarios',
                'subtitle' => 'Descubra nuestra gama completa de soluciones bancarias adaptadas a sus necesidades',
                'all_categories' => 'Todas las categorías',
                'privat' => 'Particulares',
                'business' => 'Empresas',
                'discover' => 'Descubrir',
            ],
        ];

        $t = $translations[$currentLocale];
    @endphp

    <x-slot name="title">{{ $t['title'] }}</x-slot>
    <x-slot name="metaDescription">{{ $t['subtitle'] }}</x-slot>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-pink-600 to-pink-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $t['title'] }}</h1>
            <p class="text-xl md:text-2xl text-pink-100 max-w-3xl">{{ $t['subtitle'] }}</p>
        </div>
    </div>

    <!-- Segment Tabs -->
    <div class="bg-white border-b border-gray-200 sticky top-0 z-10 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <a href="{{ route('services.index', ['locale' => $currentLocale, 'segment' => 'privat']) }}"
                   class="@if($selectedSegment === 'privat') border-pink-600 text-pink-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    {{ $t['privat'] }}
                </a>
                <a href="{{ route('services.index', ['locale' => $currentLocale, 'segment' => 'business']) }}"
                   class="@if($selectedSegment === 'business') border-pink-600 text-pink-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    {{ $t['business'] }}
                </a>
            </nav>
        </div>
    </div>

    <!-- Services Content -->
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Category Filter -->
            <div class="mb-8">
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('services.index', ['locale' => $currentLocale, 'segment' => $selectedSegment]) }}"
                       class="@if(!$selectedCategory) bg-pink-600 text-white @else bg-white text-gray-700 hover:bg-gray-50 @endif px-4 py-2 rounded-full text-sm font-medium transition-colors border border-gray-200">
                        {{ $t['all_categories'] }}
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('services.index', ['locale' => $currentLocale, 'segment' => $selectedSegment, 'category' => $category]) }}"
                           class="@if($selectedCategory === $category) bg-pink-600 text-white @else bg-white text-gray-700 hover:bg-gray-50 @endif px-4 py-2 rounded-full text-sm font-medium transition-colors border border-gray-200">
                            {{ $category }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Services Grid -->
            @if($services->count() > 0)
                @php
                    $groupedServices = $services->groupBy('category');
                @endphp

                @foreach($groupedServices as $category => $categoryServices)
                    <div class="mb-12">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ $category }}</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($categoryServices as $service)
                                <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow overflow-hidden group">
                                    <!-- Service Icon Header -->
                                    <div class="bg-gradient-to-r from-pink-600 to-pink-700 p-6">
                                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                    </div>

                                    <!-- Service Content -->
                                    <div class="p-6">
                                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-pink-600 transition-colors">
                                            {{ $service->getTranslation('title', $currentLocale) }}
                                        </h3>
                                        <p class="text-gray-600 mb-4 line-clamp-3">
                                            {{ $service->getTranslation('description', $currentLocale) }}
                                        </p>

                                        <!-- Features Preview -->
                                        @if($service->getTranslation('features', $currentLocale) && count($service->getTranslation('features', $currentLocale)) > 0)
                                            <ul class="space-y-2 mb-6">
                                                @foreach(array_slice($service->getTranslation('features', $currentLocale), 0, 3) as $feature)
                                                    <li class="flex items-start text-sm text-gray-600">
                                                        <svg class="w-4 h-4 text-pink-600 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                        {{ $feature }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif

                                        <!-- CTA Button -->
                                        <a href="{{ route('services.detail', ['locale' => $currentLocale, 'slug' => $service->slug]) }}"
                                           class="inline-flex items-center text-pink-600 hover:text-pink-700 font-semibold group/link">
                                            {{ $t['discover'] }}
                                            <svg class="w-5 h-5 ml-2 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p class="mt-2 text-sm text-gray-500">
                        {{ $currentLocale === 'fr' ? 'Aucun service trouvé dans cette catégorie.' :
                           ($currentLocale === 'de' ? 'Keine Dienstleistungen in dieser Kategorie gefunden.' :
                           ($currentLocale === 'en' ? 'No services found in this category.' : 'No se encontraron servicios en esta categoría.')) }}
                    </p>
                </div>
            @endif

        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-pink-600 to-pink-700 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">
                {{ $currentLocale === 'fr' ? 'Des questions sur nos services ?' :
                   ($currentLocale === 'de' ? 'Fragen zu unseren Dienstleistungen?' :
                   ($currentLocale === 'en' ? 'Questions about our services?' : '¿Preguntas sobre nuestros servicios?')) }}
            </h2>
            <p class="text-pink-100 mb-8 text-lg">
                {{ $currentLocale === 'fr' ? 'Nos conseillers sont à votre disposition pour vous accompagner.' :
                   ($currentLocale === 'de' ? 'Unsere Berater stehen Ihnen zur Verfügung, um Sie zu begleiten.' :
                   ($currentLocale === 'en' ? 'Our advisors are available to assist you.' : 'Nuestros asesores están a su disposición para acompañarle.')) }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact', ['locale' => $currentLocale]) }}"
                   class="inline-block bg-white text-pink-600 hover:bg-pink-50 px-8 py-3 rounded-md font-semibold transition-colors">
                    {{ $currentLocale === 'fr' ? 'Nous contacter' :
                       ($currentLocale === 'de' ? 'Kontaktieren Sie uns' :
                       ($currentLocale === 'en' ? 'Contact us' : 'Contáctenos')) }}
                </a>
                <a href="tel:+41712272727"
                   class="inline-block border-2 border-white text-white hover:bg-white/10 px-8 py-3 rounded-md font-semibold transition-colors">
                    +41 71 227 27 27
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
