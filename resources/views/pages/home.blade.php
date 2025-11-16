<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();
        $currentSegment = session('segment', 'privat');

        // Load latest published articles
        $latestArticles = \App\Models\Article::where('is_published', true)
            ->where(function($query) use ($currentSegment) {
                $query->where('segment', $currentSegment)
                    ->orWhere('segment', 'both');
            })
            ->latest('published_at')
            ->take(2)
            ->get();

        // Load all active agencies grouped by city
        $agencies = \App\Models\Agency::where('is_active', true)
            ->orderBy('city')
            ->get()
            ->groupBy('city');

        // Get distinct cities for dropdown
        $cities = $agencies->keys();

        // Default city
        $defaultCity = $cities->first() ?? 'St.Gallen';
    @endphp

    <!-- Hero Section -->
    <section class="relative bg-cover bg-center h-[600px]" style="background-image: url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=1920&h=600&fit=crop');">
        <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/30"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
            <div class="max-w-2xl text-white">
                <h1 class="text-5xl font-bold mb-6">
                    @if($currentLocale === 'fr')
                        Actions, Obligations, Immobilier : Comment investir au mieux mon argent ?
                    @elseif($currentLocale === 'de')
                        Aktien, Obligationen, Immobilien: Wie lege ich mein Geld am besten an?
                    @elseif($currentLocale === 'en')
                        Stocks, Bonds, Real Estate: How do I best invest my money?
                    @else
                        Acciones, Bonos, Inmuebles: ¿Cómo invierto mejor mi dinero?
                    @endif
                </h1>
                <p class="text-xl mb-8">
                    @if($currentLocale === 'fr')
                        Découvrez nos solutions d'investissement personnalisées
                    @elseif($currentLocale === 'de')
                        Entdecken Sie unsere massgeschneiderten Anlagelösungen
                    @elseif($currentLocale === 'en')
                        Discover our tailored investment solutions
                    @else
                        Descubra nuestras soluciones de inversión personalizadas
                    @endif
                </p>
                <a href="{{ route('services.invest', ['locale' => $currentLocale]) }}" class="inline-block bg-pink-600 hover:bg-pink-700 text-white font-semibold px-8 py-4 rounded-md transition-colors">
                    @if($currentLocale === 'fr')
                        En savoir plus
                    @elseif($currentLocale === 'de')
                        Mehr Infos
                    @elseif($currentLocale === 'en')
                        Learn more
                    @else
                        Más información
                    @endif
                </a>
            </div>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Service Card 1 -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden group hover:shadow-xl transition-shadow">
                    <div class="h-64 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=600&h=400&fit=crop');"></div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-3 group-hover:text-pink-600 transition-colors">
                            @if($currentLocale === 'fr')
                                E-Banking et Mobile Banking
                            @elseif($currentLocale === 'de')
                                E-Banking und Mobile Banking
                            @elseif($currentLocale === 'en')
                                E-Banking and Mobile Banking
                            @else
                                E-Banking y Mobile Banking
                            @endif
                        </h3>
                        <p class="text-gray-600 mb-4">
                            @if($currentLocale === 'fr')
                                Gérez vos comptes en ligne 24/7 avec notre plateforme sécurisée
                            @elseif($currentLocale === 'de')
                                Verwalten Sie Ihre Konten online 24/7 mit unserer sicheren Plattform
                            @elseif($currentLocale === 'en')
                                Manage your accounts online 24/7 with our secure platform
                            @else
                                Gestione sus cuentas en línea 24/7 con nuestra plataforma segura
                            @endif
                        </p>
                        <a href="{{ route('services.index', ['locale' => $currentLocale, 'segment' => $currentSegment, 'category' => 'Comptes & Cartes']) }}" class="inline-flex items-center text-pink-600 hover:text-pink-700 font-medium">
                            @if($currentLocale === 'fr')
                                En savoir plus
                            @elseif($currentLocale === 'de')
                                Mehr Infos
                            @elseif($currentLocale === 'en')
                                Learn more
                            @else
                                Más información
                            @endif
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Service Card 2 -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden group hover:shadow-xl transition-shadow">
                    <div class="h-64 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1582407947304-fd86f028f716?w=600&h=400&fit=crop');"></div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-3 group-hover:text-pink-600 transition-colors">
                            @if($currentLocale === 'fr')
                                Financer un logement
                            @elseif($currentLocale === 'de')
                                Wohneigentum finanzieren
                            @elseif($currentLocale === 'en')
                                Finance Housing
                            @else
                                Financiar Vivienda
                            @endif
                        </h3>
                        <p class="text-gray-600 mb-4">
                            @if($currentLocale === 'fr')
                                Hypothèques avantageuses pour réaliser votre projet immobilier
                            @elseif($currentLocale === 'de')
                                Vorteilhafte Hypotheken für Ihr Immobilienprojekt
                            @elseif($currentLocale === 'en')
                                Advantageous mortgages for your real estate project
                            @else
                                Hipotecas ventajosas para su proyecto inmobiliario
                            @endif
                        </p>
                        <a href="{{ route('services.index', ['locale' => $currentLocale, 'segment' => $currentSegment, 'category' => 'Hypothèques & Financements']) }}" class="inline-flex items-center text-pink-600 hover:text-pink-700 font-medium">
                            @if($currentLocale === 'fr')
                                En savoir plus
                            @elseif($currentLocale === 'de')
                                Mehr Infos
                            @elseif($currentLocale === 'en')
                                Learn more
                            @else
                                Más información
                            @endif
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Service Card 3 -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden group hover:shadow-xl transition-shadow">
                    <div class="h-64 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?w=600&h=400&fit=crop');"></div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-3 group-hover:text-pink-600 transition-colors">
                            @if($currentLocale === 'fr')
                                Placements et Prévoyance
                            @elseif($currentLocale === 'de')
                                Anlagen und Vorsorge
                            @elseif($currentLocale === 'en')
                                Investments and Pension
                            @else
                                Inversiones y Previsión
                            @endif
                        </h3>
                        <p class="text-gray-600 mb-4">
                            @if($currentLocale === 'fr')
                                Planifiez votre avenir financier avec nos experts
                            @elseif($currentLocale === 'de')
                                Planen Sie Ihre finanzielle Zukunft mit unseren Experten
                            @elseif($currentLocale === 'en')
                                Plan your financial future with our experts
                            @else
                                Planifique su futuro financiero con nuestros expertos
                            @endif
                        </p>
                        <a href="{{ route('services.index', ['locale' => $currentLocale, 'segment' => $currentSegment, 'category' => 'Placements & Épargne']) }}" class="inline-flex items-center text-pink-600 hover:text-pink-700 font-medium">
                            @if($currentLocale === 'fr')
                                En savoir plus
                            @elseif($currentLocale === 'de')
                                Mehr Infos
                            @elseif($currentLocale === 'en')
                                Learn more
                            @else
                                Más información
                            @endif
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Credit Request CTA Section -->
    <section class="py-16 bg-gradient-to-r from-pink-600 to-purple-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="text-white">
                    <h2 class="text-4xl font-bold mb-4">
                        @if($currentLocale === 'fr')
                            Besoin d'un crédit ?
                        @elseif($currentLocale === 'de')
                            Kredit benötigt?
                        @elseif($currentLocale === 'en')
                            Need a loan?
                        @else
                            ¿Necesita un crédito?
                        @endif
                    </h2>
                    <p class="text-xl text-pink-100 mb-6">
                        @if($currentLocale === 'fr')
                            Obtenez une réponse rapide pour votre demande de crédit. Taux avantageux et procédure simplifiée.
                        @elseif($currentLocale === 'de')
                            Erhalten Sie eine schnelle Antwort auf Ihre Kreditanfrage. Günstige Zinssätze und vereinfachtes Verfahren.
                        @elseif($currentLocale === 'en')
                            Get a quick response to your loan application. Competitive rates and simplified process.
                        @else
                            Obtenga una respuesta rápida a su solicitud de crédito. Tasas competitivas y proceso simplificado.
                        @endif
                    </p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center">
                            <svg class="w-6 h-6 mr-3 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>
                                @if($currentLocale === 'fr')
                                    Réponse en 24 heures
                                @elseif($currentLocale === 'de')
                                    Antwort innerhalb von 24 Stunden
                                @elseif($currentLocale === 'en')
                                    Response within 24 hours
                                @else
                                    Respuesta en 24 horas
                                @endif
                            </span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-6 h-6 mr-3 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>
                                @if($currentLocale === 'fr')
                                    Taux à partir de 2.5%
                                @elseif($currentLocale === 'de')
                                    Zinssätze ab 2.5%
                                @elseif($currentLocale === 'en')
                                    Rates from 2.5%
                                @else
                                    Tasas desde 2.5%
                                @endif
                            </span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-6 h-6 mr-3 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>
                                @if($currentLocale === 'fr')
                                    Montants jusqu'à CHF 500'000
                                @elseif($currentLocale === 'de')
                                    Beträge bis CHF 500'000
                                @elseif($currentLocale === 'en')
                                    Amounts up to CHF 500'000
                                @else
                                    Montos hasta CHF 500'000
                                @endif
                            </span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-6 h-6 mr-3 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>
                                @if($currentLocale === 'fr')
                                    Sans engagement
                                @elseif($currentLocale === 'de')
                                    Unverbindlich
                                @elseif($currentLocale === 'en')
                                    No commitment
                                @else
                                    Sin compromiso
                                @endif
                            </span>
                        </li>
                    </ul>
                    <a href="{{ route('credit.request', ['locale' => $currentLocale]) }}" class="inline-block bg-white text-pink-600 hover:bg-gray-50 font-bold px-8 py-4 rounded-md transition-colors text-lg shadow-lg hover:shadow-xl">
                        @if($currentLocale === 'fr')
                            Demander un crédit maintenant
                        @elseif($currentLocale === 'de')
                            Jetzt Kredit beantragen
                        @elseif($currentLocale === 'en')
                            Apply for credit now
                        @else
                            Solicitar crédito ahora
                        @endif
                        <svg class="w-5 h-5 inline ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
                <div class="relative">
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg p-8">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="bg-white/20 rounded-lg p-6 text-center">
                                <div class="text-4xl font-bold text-white mb-2">2.5%</div>
                                <div class="text-sm text-pink-100">
                                    @if($currentLocale === 'fr')
                                        Taux dès
                                    @elseif($currentLocale === 'de')
                                        Zinssatz ab
                                    @elseif($currentLocale === 'en')
                                        Rate from
                                    @else
                                        Tasa desde
                                    @endif
                                </div>
                            </div>
                            <div class="bg-white/20 rounded-lg p-6 text-center">
                                <div class="text-4xl font-bold text-white mb-2">24h</div>
                                <div class="text-sm text-pink-100">
                                    @if($currentLocale === 'fr')
                                        Réponse rapide
                                    @elseif($currentLocale === 'de')
                                        Schnelle Antwort
                                    @elseif($currentLocale === 'en')
                                        Quick response
                                    @else
                                        Respuesta rápida
                                    @endif
                                </div>
                            </div>
                            <div class="bg-white/20 rounded-lg p-6 text-center">
                                <div class="text-4xl font-bold text-white mb-2">500K</div>
                                <div class="text-sm text-pink-100">
                                    @if($currentLocale === 'fr')
                                        CHF max
                                    @elseif($currentLocale === 'de')
                                        CHF max
                                    @elseif($currentLocale === 'en')
                                        CHF max
                                    @else
                                        CHF máx
                                    @endif
                                </div>
                            </div>
                            <div class="bg-white/20 rounded-lg p-6 text-center">
                                <div class="text-4xl font-bold text-white mb-2">0</div>
                                <div class="text-sm text-pink-100">
                                    @if($currentLocale === 'fr')
                                        Frais dossier
                                    @elseif($currentLocale === 'de')
                                        Gebühren
                                    @elseif($currentLocale === 'en')
                                        Setup fees
                                    @else
                                        Gastos apertura
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Aktuelles (News/Blog) Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-bold text-gray-900">
                    @if($currentLocale === 'fr')
                        Actualités
                    @elseif($currentLocale === 'de')
                        Aktuelles
                    @elseif($currentLocale === 'en')
                        News
                    @else
                        Noticias
                    @endif
                </h2>
                <a href="{{ route('blog', ['locale' => $currentLocale]) }}" class="text-pink-600 hover:text-pink-700 font-medium">
                    @if($currentLocale === 'fr')
                        Voir tout
                    @elseif($currentLocale === 'de')
                        Mehr sehen
                    @elseif($currentLocale === 'en')
                        View all
                    @else
                        Ver todo
                    @endif
                    →
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @forelse($latestArticles as $article)
                    <a href="{{ route('blog.show', ['locale' => $currentLocale, 'slug' => $article->slug]) }}" class="flex space-x-4 group">
                        <div class="flex-shrink-0 w-48 h-32 bg-gray-200 rounded-lg bg-cover bg-center" style="background-image: url('{{ $article->featured_image ?? 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=400&h=300&fit=crop' }}');"></div>
                        <div class="flex-1">
                            <span class="text-sm text-gray-500">
                                @if($currentLocale === 'fr')
                                    Actualités
                                @elseif($currentLocale === 'de')
                                    Aktuelles
                                @elseif($currentLocale === 'en')
                                    News
                                @else
                                    Noticias
                                @endif
                            </span>
                            <h3 class="text-lg font-semibold mb-2 group-hover:text-pink-600 transition-colors">
                                {{ $article->getTranslation('title', $currentLocale) }}
                            </h3>
                            <p class="text-sm text-gray-600 line-clamp-2">
                                {{ $article->getTranslation('excerpt', $currentLocale) }}
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-2 text-center text-gray-500">
                        {{ $currentLocale === 'fr' ? 'Aucun article pour le moment' :
                           ($currentLocale === 'de' ? 'Derzeit keine Artikel' :
                           ($currentLocale === 'en' ? 'No articles yet' : 'No hay artículos todavía')) }}
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Quick Links -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <a href="#" class="flex items-center space-x-2 text-gray-700 hover:text-pink-600">
                    <span class="text-sm">
                        @if($currentLocale === 'fr')
                            Actionnaires & Actionnariat
                        @elseif($currentLocale === 'de')
                            Aktionärinnen & Aktionäre
                        @elseif($currentLocale === 'en')
                            Shareholders
                        @else
                            Accionistas
                        @endif
                    </span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
                <a href="#" class="flex items-center space-x-2 text-gray-700 hover:text-pink-600">
                    <span class="text-sm">Kaspar&acrevis</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
                <a href="#" class="flex items-center space-x-2 text-gray-700 hover:text-pink-600">
                    <span class="text-sm">
                        @if($currentLocale === 'fr')
                            Taux hypothécaires
                        @elseif($currentLocale === 'de')
                            Zinssätze Hypotheken
                        @elseif($currentLocale === 'en')
                            Mortgage Rates
                        @else
                            Tasas Hipotecarias
                        @endif
                    </span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
                <a href="{{ route('blog', ['locale' => $currentLocale]) }}" class="flex items-center space-x-2 text-gray-700 hover:text-pink-600">
                    <span class="text-sm">Blog</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Avis Clients / Testimonials -->
    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">
                    @if($currentLocale === 'fr')
                        Ce que disent nos clients
                    @elseif($currentLocale === 'de')
                        Was unsere Kunden sagen
                    @elseif($currentLocale === 'en')
                        What our clients say
                    @else
                        Lo que dicen nuestros clientes
                    @endif
                </h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                    @if($currentLocale === 'fr')
                        Depuis plus de 10 ans, nous accompagnons nos clients avec professionnalisme et proximité
                    @elseif($currentLocale === 'de')
                        Seit über 10 Jahren begleiten wir unsere Kunden mit Professionalität und Nähe
                    @elseif($currentLocale === 'en')
                        For over 10 years, we have been supporting our clients with professionalism and proximity
                    @else
                        Durante más de 10 años, apoyamos a nuestros clientes con profesionalismo y cercanía
                    @endif
                </p>
            </div>

            <!-- Testimonials Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white rounded-xl border border-slate-200 p-8 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center mb-6">
                        <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center text-blue-700 font-bold text-xl mr-4">
                            MC
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900">Marc Chevallaz</h4>
                            <p class="text-sm text-slate-500">
                                @if($currentLocale === 'fr')
                                    Client depuis 8 ans
                                @elseif($currentLocale === 'de')
                                    Kunde seit 8 Jahren
                                @elseif($currentLocale === 'en')
                                    Client for 8 years
                                @else
                                    Cliente desde hace 8 años
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                    <p class="text-slate-700 leading-relaxed">
                        @if($currentLocale === 'fr')
                            "Un service de qualité et des conseillers toujours à l'écoute. J'apprécie particulièrement la simplicité de la plateforme en ligne et la rapidité des virements. Une banque qui comprend les besoins des particuliers."
                        @elseif($currentLocale === 'de')
                            "Qualitativ hochwertiger Service und Berater, die immer zuhören. Ich schätze besonders die Einfachheit der Online-Plattform und die Schnelligkeit der Überweisungen. Eine Bank, die die Bedürfnisse von Privatpersonen versteht."
                        @elseif($currentLocale === 'en')
                            "Quality service and advisors who always listen. I particularly appreciate the simplicity of the online platform and the speed of transfers. A bank that understands the needs of individuals."
                        @else
                            "Servicio de calidad y asesores que siempre escuchan. Aprecio especialmente la simplicidad de la plataforma en línea y la rapidez de las transferencias. Un banco que comprende las necesidades de los particulares."
                        @endif
                    </p>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white rounded-xl border border-slate-200 p-8 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center mb-6">
                        <div class="w-14 h-14 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-700 font-bold text-xl mr-4">
                            SD
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900">Sophie Dumont</h4>
                            <p class="text-sm text-slate-500">
                                @if($currentLocale === 'fr')
                                    Cliente depuis 3 ans
                                @elseif($currentLocale === 'de')
                                    Kundin seit 3 Jahren
                                @elseif($currentLocale === 'en')
                                    Client for 3 years
                                @else
                                    Cliente desde hace 3 años
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                    <p class="text-slate-700 leading-relaxed">
                        @if($currentLocale === 'fr')
                            "J'ai obtenu mon prêt hypothécaire rapidement et à un taux très compétitif. L'équipe m'a accompagnée tout au long du processus. Je recommande vivement pour les projets immobiliers."
                        @elseif($currentLocale === 'de')
                            "Ich habe meine Hypothek schnell und zu einem sehr wettbewerbsfähigen Zinssatz erhalten. Das Team hat mich während des gesamten Prozesses begleitet. Ich empfehle es sehr für Immobilienprojekte."
                        @elseif($currentLocale === 'en')
                            "I got my mortgage quickly and at a very competitive rate. The team supported me throughout the process. I highly recommend for real estate projects."
                        @else
                            "Obtuve mi hipoteca rápidamente y a una tasa muy competitiva. El equipo me acompañó durante todo el proceso. Lo recomiendo encarecidamente para proyectos inmobiliarios."
                        @endif
                    </p>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white rounded-xl border border-slate-200 p-8 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center mb-6">
                        <div class="w-14 h-14 bg-violet-100 rounded-full flex items-center justify-center text-violet-700 font-bold text-xl mr-4">
                            PL
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900">Pierre Lehmann</h4>
                            <p class="text-sm text-slate-500">
                                @if($currentLocale === 'fr')
                                    Client depuis 5 ans
                                @elseif($currentLocale === 'de')
                                    Kunde seit 5 Jahren
                                @elseif($currentLocale === 'en')
                                    Client for 5 years
                                @else
                                    Cliente desde hace 5 años
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                    <p class="text-slate-700 leading-relaxed">
                        @if($currentLocale === 'fr')
                            "Une banque à taille humaine qui privilégie la relation client. Mon conseiller me connait personnellement et me propose des solutions adaptées. Les frais sont transparents et compétitifs."
                        @elseif($currentLocale === 'de')
                            "Eine Bank mit menschlichem Maßstab, die die Kundenbeziehung priorisiert. Mein Berater kennt mich persönlich und bietet mir passende Lösungen. Die Gebühren sind transparent und wettbewerbsfähig."
                        @elseif($currentLocale === 'en')
                            "A human-sized bank that prioritizes client relationships. My advisor knows me personally and offers me suitable solutions. The fees are transparent and competitive."
                        @else
                            "Un banco a escala humana que prioriza la relación con el cliente. Mi asesor me conoce personalmente y me ofrece soluciones adecuadas. Las tarifas son transparentes y competitivas."
                        @endif
                    </p>
                </div>

                <!-- Testimonial 4 -->
                <div class="bg-white rounded-xl border border-slate-200 p-8 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center mb-6">
                        <div class="w-14 h-14 bg-rose-100 rounded-full flex items-center justify-center text-rose-700 font-bold text-xl mr-4">
                            AM
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900">Anne-Marie Fischer</h4>
                            <p class="text-sm text-slate-500">
                                @if($currentLocale === 'fr')
                                    Cliente depuis 1 an
                                @elseif($currentLocale === 'de')
                                    Kundin seit 1 Jahr
                                @elseif($currentLocale === 'en')
                                    Client for 1 year
                                @else
                                    Cliente desde hace 1 año
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                    <p class="text-slate-700 leading-relaxed">
                        @if($currentLocale === 'fr')
                            "Nouvelle cliente après 20 ans dans une grande banque, je ne regrette pas mon choix. L'ouverture de compte a été simple et rapide. Je me sens enfin écoutée et non juste un numéro."
                        @elseif($currentLocale === 'de')
                            "Neue Kundin nach 20 Jahren bei einer Großbank, ich bereue meine Wahl nicht. Die Kontoeröffnung war einfach und schnell. Ich fühle mich endlich gehört und nicht nur eine Nummer."
                        @elseif($currentLocale === 'en')
                            "New client after 20 years at a large bank, I don't regret my choice. Opening an account was simple and fast. I finally feel heard and not just a number."
                        @else
                            "Nueva cliente después de 20 años en un gran banco, no me arrepiento de mi elección. Abrir una cuenta fue simple y rápido. Finalmente me siento escuchada y no solo un número."
                        @endif
                    </p>
                </div>

                <!-- Testimonial 5 -->
                <div class="bg-white rounded-xl border border-slate-200 p-8 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center mb-6">
                        <div class="w-14 h-14 bg-cyan-100 rounded-full flex items-center justify-center text-cyan-700 font-bold text-xl mr-4">
                            TB
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900">Thomas Berset</h4>
                            <p class="text-sm text-slate-500">
                                @if($currentLocale === 'fr')
                                    Client depuis 12 ans
                                @elseif($currentLocale === 'de')
                                    Kunde seit 12 Jahren
                                @elseif($currentLocale === 'en')
                                    Client for 12 years
                                @else
                                    Cliente desde hace 12 años
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                    <p class="text-slate-700 leading-relaxed">
                        @if($currentLocale === 'fr')
                            "Client fidèle depuis plus d'une décennie. J'ai toujours eu des réponses rapides et un service irréprochable. La sécurité de mes transactions est excellente et l'application mobile très pratique."
                        @elseif($currentLocale === 'de')
                            "Treuer Kunde seit über einem Jahrzehnt. Ich hatte immer schnelle Antworten und einen tadellosen Service. Die Sicherheit meiner Transaktionen ist ausgezeichnet und die mobile App sehr praktisch."
                        @elseif($currentLocale === 'en')
                            "Loyal client for over a decade. I've always had quick responses and impeccable service. The security of my transactions is excellent and the mobile app very convenient."
                        @else
                            "Cliente leal desde hace más de una década. Siempre he tenido respuestas rápidas y un servicio impecable. La seguridad de mis transacciones es excelente y la aplicación móvil muy práctica."
                        @endif
                    </p>
                </div>

                <!-- Testimonial 6 -->
                <div class="bg-white rounded-xl border border-slate-200 p-8 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center mb-6">
                        <div class="w-14 h-14 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-700 font-bold text-xl mr-4">
                            CW
                        </div>
                        <div>
                            <h4 class="font-semibold text-slate-900">Caroline Weber</h4>
                            <p class="text-sm text-slate-500">
                                @if($currentLocale === 'fr')
                                    Cliente depuis 6 mois
                                @elseif($currentLocale === 'de')
                                    Kundin seit 6 Monaten
                                @elseif($currentLocale === 'en')
                                    Client for 6 months
                                @else
                                    Cliente desde hace 6 meses
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                    <p class="text-slate-700 leading-relaxed">
                        @if($currentLocale === 'fr')
                            "En tant que jeune entrepreneuse, j'avais besoin d'une banque réactive pour mes projets. Excellente communication, réponses claires et solutions adaptées aux PME. Un vrai partenariat."
                        @elseif($currentLocale === 'de')
                            "Als junge Unternehmerin brauchte ich eine reaktive Bank für meine Projekte. Ausgezeichnete Kommunikation, klare Antworten und Lösungen, die auf KMU zugeschnitten sind. Eine echte Partnerschaft."
                        @elseif($currentLocale === 'en')
                            "As a young entrepreneur, I needed a responsive bank for my projects. Excellent communication, clear answers and solutions tailored to SMEs. A real partnership."
                        @else
                            "Como joven empresaria, necesitaba un banco receptivo para mis proyectos. Excelente comunicación, respuestas claras y soluciones adaptadas a las PYMES. Una verdadera asociación."
                        @endif
                    </p>
                </div>
            </div>

            <!-- Trust Badge -->
            <div class="mt-16 text-center">
                <div class="inline-flex items-center justify-center px-6 py-3 bg-white rounded-full border border-slate-200 shadow-sm">
                    <svg class="w-5 h-5 text-emerald-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm font-medium text-slate-700">
                        @if($currentLocale === 'fr')
                            Plus de 15'000 clients nous font confiance
                        @elseif($currentLocale === 'de')
                            Über 15'000 Kunden vertrauen uns
                        @elseif($currentLocale === 'en')
                            Over 15,000 clients trust us
                        @else
                            Más de 15'000 clientes confían en nosotros
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Meine Bank in der Nähe -->
    <section class="py-16 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1920&h=600&fit=crop');"
             x-data="{
                selectedCity: '{{ $defaultCity }}',
                agencies: {!! json_encode($agencies->map(function($cityAgencies) use ($currentLocale) {
                    return $cityAgencies->map(function($agency) use ($currentLocale) {
                        return [
                            'name' => $agency->getTranslation('name', $currentLocale),
                            'address' => $agency->getTranslation('address', $currentLocale),
                            'city' => $agency->city,
                            'postal_code' => $agency->postal_code,
                            'phone' => $agency->phone,
                            'email' => $agency->email,
                        ];
                    });
                })) !!},
                get currentAgency() {
                    return this.agencies[this.selectedCity]?.[0] || {
                        name: 'Acrevis Bank',
                        city: this.selectedCity,
                        postal_code: '',
                        address: '',
                        phone: '',
                        email: ''
                    };
                }
             }">
        <div class="bg-black/40 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-md bg-white rounded-lg p-8 shadow-xl">
                    <h2 class="text-2xl font-bold mb-6">
                        @if($currentLocale === 'fr')
                            Ma banque à proximité
                        @elseif($currentLocale === 'de')
                            Meine Bank in der Nähe
                        @elseif($currentLocale === 'en')
                            My bank nearby
                        @else
                            Mi banco cerca
                        @endif
                    </h2>
                    <select x-model="selectedCity" class="w-full px-4 py-3 border border-gray-300 rounded-md mb-4 focus:ring-pink-500 focus:border-pink-500">
                        @foreach($cities as $city)
                            <option value="{{ $city }}">{{ $city }}</option>
                        @endforeach
                    </select>
                    <div class="mt-4">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-pink-600 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <div>
                                <p class="font-semibold" x-text="currentAgency.name"></p>
                                <p class="text-sm text-gray-600">
                                    <span x-text="currentAgency.postal_code"></span>
                                    <span x-text="currentAgency.city"></span>
                                </p>
                                <p class="text-sm text-gray-600" x-text="currentAgency.address"></p>
                                <template x-if="currentAgency.phone">
                                    <p class="text-sm text-gray-600 mt-2">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        <span x-text="currentAgency.phone"></span>
                                    </p>
                                </template>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('agencies', ['locale' => $currentLocale]) }}" class="mt-6 block w-full text-center bg-pink-600 hover:bg-pink-700 text-white font-semibold px-6 py-3 rounded-md transition-colors">
                        @if($currentLocale === 'fr')
                            Voir toutes les agences
                        @elseif($currentLocale === 'de')
                            Alle Standorte anzeigen
                        @elseif($currentLocale === 'en')
                            View all branches
                        @else
                            Ver todas las agencias
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </section>

</x-layouts.app>
