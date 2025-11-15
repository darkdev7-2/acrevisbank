<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();

        $translations = [
            'fr' => [
                'title' => 'Mentions Légales',
                'subtitle' => 'Informations légales et de contact de la banque',
                'toc' => 'Sommaire',
                'backToTop' => 'Retour en haut',
                'lastUpdate' => 'Dernière mise à jour',
                'company' => 'Entreprise',
                'contact' => 'Contact',
                'supervision' => 'Surveillance',
                'management' => 'Direction',
                'insurance' => 'Garantie des dépôts',
                'copyright' => 'Droits d\'auteur',
                'liability' => 'Responsabilité',
                'contactUs' => 'Contactez-nous',
            ],
            'de' => [
                'title' => 'Impressum',
                'subtitle' => 'Rechtliche Informationen und Kontakt der Bank',
                'toc' => 'Inhaltsverzeichnis',
                'backToTop' => 'Nach oben',
                'lastUpdate' => 'Letzte Aktualisierung',
                'company' => 'Unternehmen',
                'contact' => 'Kontakt',
                'supervision' => 'Aufsicht',
                'management' => 'Geschäftsleitung',
                'insurance' => 'Einlagensicherung',
                'copyright' => 'Urheberrecht',
                'liability' => 'Haftung',
                'contactUs' => 'Kontaktieren Sie uns',
            ],
            'en' => [
                'title' => 'Legal Notice',
                'subtitle' => 'Legal information and contact of the bank',
                'toc' => 'Table of Contents',
                'backToTop' => 'Back to top',
                'lastUpdate' => 'Last updated',
                'company' => 'Company',
                'contact' => 'Contact',
                'supervision' => 'Supervision',
                'management' => 'Management',
                'insurance' => 'Deposit Guarantee',
                'copyright' => 'Copyright',
                'liability' => 'Liability',
                'contactUs' => 'Contact us',
            ],
            'es' => [
                'title' => 'Aviso Legal',
                'subtitle' => 'Información legal y de contacto del banco',
                'toc' => 'Tabla de contenidos',
                'backToTop' => 'Volver arriba',
                'lastUpdate' => 'Última actualización',
                'company' => 'Empresa',
                'contact' => 'Contacto',
                'supervision' => 'Supervisión',
                'management' => 'Dirección',
                'insurance' => 'Garantía de depósitos',
                'copyright' => 'Derechos de autor',
                'liability' => 'Responsabilidad',
                'contactUs' => 'Contáctenos',
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
            <p class="text-xl text-pink-100 max-w-3xl">{{ $t['subtitle'] }}</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                <!-- Sidebar with Table of Contents -->
                <aside class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 text-pink-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                            </svg>
                            {{ $t['toc'] }}
                        </h3>
                        <nav class="space-y-2">
                            <a href="#entreprise" class="block text-sm text-gray-600 hover:text-pink-600 transition-colors py-1">{{ $t['company'] }}</a>
                            <a href="#contact" class="block text-sm text-gray-600 hover:text-pink-600 transition-colors py-1">{{ $t['contact'] }}</a>
                            <a href="#surveillance" class="block text-sm text-gray-600 hover:text-pink-600 transition-colors py-1">{{ $t['supervision'] }}</a>
                            <a href="#direction" class="block text-sm text-gray-600 hover:text-pink-600 transition-colors py-1">{{ $t['management'] }}</a>
                            <a href="#garantie" class="block text-sm text-gray-600 hover:text-pink-600 transition-colors py-1">{{ $t['insurance'] }}</a>
                            <a href="#copyright" class="block text-sm text-gray-600 hover:text-pink-600 transition-colors py-1">{{ $t['copyright'] }}</a>
                            <a href="#responsabilite" class="block text-sm text-gray-600 hover:text-pink-600 transition-colors py-1">{{ $t['liability'] }}</a>
                        </nav>

                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
                                    class="w-full text-sm text-pink-600 hover:text-pink-700 font-medium flex items-center justify-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                                </svg>
                                {{ $t['backToTop'] }}
                            </button>
                        </div>
                    </div>
                </aside>

                <!-- Main Content Column -->
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-lg shadow-md p-8 lg:p-12">

                        <!-- Last Update Badge -->
                        <div class="mb-8 inline-flex items-center px-3 py-1 bg-pink-50 text-pink-700 rounded-full text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $t['lastUpdate'] }}: {{ date('d.m.Y') }}
                        </div>

                        <div class="space-y-12">

                            <!-- 1. Entreprise -->
                            <section id="entreprise" class="scroll-mt-6">
                                <div class="flex items-start mb-4">
                                    <div class="flex-shrink-0 bg-pink-100 rounded-lg p-3 mr-4">
                                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $t['company'] }}</h2>

                                        <div class="bg-gray-50 rounded-lg p-6">
                                            <p class="text-lg font-bold text-gray-900 mb-3">Acrevis Bank AG</p>
                                            <div class="space-y-2 text-gray-700">
                                                <p class="flex items-center">
                                                    <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    </svg>
                                                    St. Leonhardstrasse 25, 9001 St. Gallen
                                                </p>
                                                <p class="flex items-center">
                                                    <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    Suisse / Schweiz / Switzerland
                                                </p>
                                            </div>
                                        </div>

                                        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="bg-blue-50 border border-blue-100 rounded-lg p-4">
                                                <p class="text-sm font-medium text-blue-900 mb-1">N° IDE / UID</p>
                                                <p class="text-blue-700">CHE-123.456.789</p>
                                            </div>
                                            <div class="bg-blue-50 border border-blue-100 rounded-lg p-4">
                                                <p class="text-sm font-medium text-blue-900 mb-1">
                                                    @if($currentLocale === 'fr') Registre du commerce
                                                    @elseif($currentLocale === 'de') Handelsregister
                                                    @elseif($currentLocale === 'en') Commercial Register
                                                    @else Registro Mercantil @endif
                                                </p>
                                                <p class="text-blue-700">St. Gallen</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <!-- 2. Contact -->
                            <section id="contact" class="scroll-mt-6">
                                <div class="flex items-start mb-4">
                                    <div class="flex-shrink-0 bg-pink-100 rounded-lg p-3 mr-4">
                                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $t['contact'] }}</h2>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <a href="tel:+41712272727" class="bg-gradient-to-br from-pink-50 to-purple-50 border border-pink-100 rounded-lg p-5 hover:shadow-md transition-all group">
                                                <div class="flex items-center mb-2">
                                                    <svg class="w-5 h-5 text-pink-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                    </svg>
                                                    <span class="text-sm font-medium text-gray-600">
                                                        @if($currentLocale === 'fr') Téléphone
                                                        @elseif($currentLocale === 'de') Telefon
                                                        @elseif($currentLocale === 'en') Phone
                                                        @else Teléfono @endif
                                                    </span>
                                                </div>
                                                <p class="text-lg font-bold text-pink-600 group-hover:text-pink-700">+41 71 227 27 27</p>
                                            </a>

                                            <a href="mailto:info@acrevis.ch" class="bg-gradient-to-br from-pink-50 to-purple-50 border border-pink-100 rounded-lg p-5 hover:shadow-md transition-all group">
                                                <div class="flex items-center mb-2">
                                                    <svg class="w-5 h-5 text-pink-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                                    </svg>
                                                    <span class="text-sm font-medium text-gray-600">Email</span>
                                                </div>
                                                <p class="text-lg font-bold text-pink-600 group-hover:text-pink-700">info@acrevis.ch</p>
                                            </a>

                                            <a href="https://www.acrevis.ch" target="_blank" class="bg-gradient-to-br from-pink-50 to-purple-50 border border-pink-100 rounded-lg p-5 hover:shadow-md transition-all group">
                                                <div class="flex items-center mb-2">
                                                    <svg class="w-5 h-5 text-pink-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                                    </svg>
                                                    <span class="text-sm font-medium text-gray-600">Web</span>
                                                </div>
                                                <p class="text-lg font-bold text-pink-600 group-hover:text-pink-700">www.acrevis.ch</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <!-- 3. Surveillance -->
                            <section id="surveillance" class="scroll-mt-6">
                                <div class="flex items-start mb-4">
                                    <div class="flex-shrink-0 bg-pink-100 rounded-lg p-3 mr-4">
                                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $t['supervision'] }}</h2>

                                        <div class="bg-blue-50 border-l-4 border-blue-500 rounded-r-lg p-6">
                                            <div class="flex items-start">
                                                <svg class="w-6 h-6 text-blue-500 mr-3 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                <div>
                                                    <p class="font-bold text-blue-900 mb-2">
                                                        @if($currentLocale === 'fr') Autorité fédérale de surveillance des marchés financiers
                                                        @elseif($currentLocale === 'de') Eidgenössische Finanzmarktaufsicht
                                                        @elseif($currentLocale === 'en') Swiss Financial Market Supervisory Authority
                                                        @else Autoridad Federal de Supervisión de los Mercados Financieros @endif
                                                    </p>
                                                    <p class="text-blue-800 font-semibold text-lg">FINMA</p>
                                                    <p class="text-blue-700 mt-2 text-sm">
                                                        @if($currentLocale === 'fr')
                                                            Acrevis Bank AG est soumise à la surveillance de la FINMA et opère conformément à la législation bancaire suisse.
                                                        @elseif($currentLocale === 'de')
                                                            Die Acrevis Bank AG untersteht der Aufsicht der FINMA und operiert gemäss schweizerischem Bankengesetz.
                                                        @elseif($currentLocale === 'en')
                                                            Acrevis Bank AG is supervised by FINMA and operates in accordance with Swiss banking law.
                                                        @else
                                                            Acrevis Bank AG está supervisada por FINMA y opera de acuerdo con la ley bancaria suiza.
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <!-- 4. Direction -->
                            <section id="direction" class="scroll-mt-6">
                                <div class="flex items-start mb-4">
                                    <div class="flex-shrink-0 bg-pink-100 rounded-lg p-3 mr-4">
                                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $t['management'] }}</h2>

                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <div class="bg-white border border-gray-200 rounded-lg p-5 hover:shadow-md transition-shadow">
                                                <div class="w-12 h-12 bg-pink-100 rounded-full flex items-center justify-center mb-3">
                                                    <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                    </svg>
                                                </div>
                                                <p class="text-sm text-gray-500 mb-1">CEO</p>
                                                <p class="font-bold text-gray-900">Dr. Thomas Müller</p>
                                            </div>

                                            <div class="bg-white border border-gray-200 rounded-lg p-5 hover:shadow-md transition-shadow">
                                                <div class="w-12 h-12 bg-pink-100 rounded-full flex items-center justify-center mb-3">
                                                    <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                    </svg>
                                                </div>
                                                <p class="text-sm text-gray-500 mb-1">CFO</p>
                                                <p class="font-bold text-gray-900">Markus Weber</p>
                                            </div>

                                            <div class="bg-white border border-gray-200 rounded-lg p-5 hover:shadow-md transition-shadow">
                                                <div class="w-12 h-12 bg-pink-100 rounded-full flex items-center justify-center mb-3">
                                                    <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                    </svg>
                                                </div>
                                                <p class="text-sm text-gray-500 mb-1">COO</p>
                                                <p class="font-bold text-gray-900">Sandra Schneider</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <!-- 5. Garantie des dépôts -->
                            <section id="garantie" class="scroll-mt-6">
                                <div class="flex items-start mb-4">
                                    <div class="flex-shrink-0 bg-pink-100 rounded-lg p-3 mr-4">
                                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $t['insurance'] }}</h2>

                                        <div class="bg-green-50 border-l-4 border-green-500 rounded-r-lg p-6">
                                            <div class="flex items-start">
                                                <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                <div>
                                                    <p class="font-bold text-green-900 text-lg mb-3">
                                                        @if($currentLocale === 'fr')
                                                            Protection jusqu'à CHF 100'000 par client
                                                        @elseif($currentLocale === 'de')
                                                            Schutz bis CHF 100'000 pro Kunde
                                                        @elseif($currentLocale === 'en')
                                                            Protection up to CHF 100,000 per customer
                                                        @else
                                                            Protección hasta CHF 100,000 por cliente
                                                        @endif
                                                    </p>
                                                    <p class="text-green-800 leading-relaxed">
                                                        @if($currentLocale === 'fr')
                                                            Les dépôts des clients d'Acrevis Bank AG sont protégés par le système de garantie des dépôts suisse (esisuisse) jusqu'à un montant de CHF 100'000 par client. Cette garantie s'applique automatiquement et sans formalités particulières.
                                                        @elseif($currentLocale === 'de')
                                                            Die Kundeneinlagen der Acrevis Bank AG sind durch das schweizerische Einlagensicherungssystem (esisuisse) bis zu einem Betrag von CHF 100'000 pro Kunde geschützt. Diese Garantie gilt automatisch und ohne besondere Formalitäten.
                                                        @elseif($currentLocale === 'en')
                                                            Customer deposits at Acrevis Bank AG are protected by the Swiss deposit guarantee system (esisuisse) up to an amount of CHF 100,000 per customer. This guarantee applies automatically and without any special formalities.
                                                        @else
                                                            Los depósitos de clientes de Acrevis Bank AG están protegidos por el sistema de garantía de depósitos suizo (esisuisse) hasta un monto de CHF 100,000 por cliente. Esta garantía se aplica automáticamente y sin formalidades especiales.
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <!-- 6. Copyright -->
                            <section id="copyright" class="scroll-mt-6">
                                <div class="flex items-start mb-4">
                                    <div class="flex-shrink-0 bg-pink-100 rounded-lg p-3 mr-4">
                                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $t['copyright'] }}</h2>

                                        <div class="prose max-w-none text-gray-700">
                                            <p class="text-lg mb-4">© {{ date('Y') }} Acrevis Bank AG.
                                                @if($currentLocale === 'fr')
                                                    Tous droits réservés.
                                                @elseif($currentLocale === 'de')
                                                    Alle Rechte vorbehalten.
                                                @elseif($currentLocale === 'en')
                                                    All rights reserved.
                                                @else
                                                    Todos los derechos reservados.
                                                @endif
                                            </p>
                                            <p>
                                                @if($currentLocale === 'fr')
                                                    L'ensemble du contenu de ce site web, y compris mais sans s'y limiter, les textes, graphiques, logos, icônes, images, clips audio, téléchargements numériques et compilations de données, est la propriété d'Acrevis Bank AG ou de ses fournisseurs de contenu et est protégé par les lois suisses et internationales sur le droit d'auteur.
                                                @elseif($currentLocale === 'de')
                                                    Der gesamte Inhalt dieser Website, einschließlich, aber nicht beschränkt auf Texte, Grafiken, Logos, Symbole, Bilder, Audioclips, digitale Downloads und Datenzusammenstellungen, ist Eigentum der Acrevis Bank AG oder ihrer Inhaltsanbieter und durch schweizerische und internationale Urheberrechtsgesetze geschützt.
                                                @elseif($currentLocale === 'en')
                                                    All content on this website, including but not limited to text, graphics, logos, icons, images, audio clips, digital downloads, and data compilations, is the property of Acrevis Bank AG or its content suppliers and is protected by Swiss and international copyright laws.
                                                @else
                                                    Todo el contenido de este sitio web, incluyendo pero no limitado a textos, gráficos, logotipos, iconos, imágenes, clips de audio, descargas digitales y compilaciones de datos, es propiedad de Acrevis Bank AG o de sus proveedores de contenido y está protegido por las leyes suizas e internacionales de derechos de autor.
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <!-- 7. Responsabilité -->
                            <section id="responsabilite" class="scroll-mt-6">
                                <div class="flex items-start mb-4">
                                    <div class="flex-shrink-0 bg-pink-100 rounded-lg p-3 mr-4">
                                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $t['liability'] }}</h2>

                                        <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-r-lg p-6 mb-4">
                                            <div class="flex items-start">
                                                <svg class="w-6 h-6 text-yellow-500 mr-3 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                                </svg>
                                                <div class="text-yellow-800">
                                                    @if($currentLocale === 'fr')
                                                        <p class="font-bold mb-2">Limitation de responsabilité</p>
                                                        <p class="text-sm leading-relaxed">
                                                            Les informations publiées sur ce site web sont fournies à titre informatif uniquement. Acrevis Bank AG s'efforce d'assurer l'exactitude et l'actualité des informations, mais ne peut garantir leur exhaustivité ou leur exactitude absolue. L'utilisation des informations se fait aux propres risques de l'utilisateur.
                                                        </p>
                                                    @elseif($currentLocale === 'de')
                                                        <p class="font-bold mb-2">Haftungsausschluss</p>
                                                        <p class="text-sm leading-relaxed">
                                                            Die auf dieser Website veröffentlichten Informationen dienen ausschliesslich zu Informationszwecken. Die Acrevis Bank AG bemüht sich um Richtigkeit und Aktualität der Informationen, kann jedoch deren Vollständigkeit oder absolute Genauigkeit nicht garantieren. Die Nutzung der Informationen erfolgt auf eigenes Risiko des Benutzers.
                                                        </p>
                                                    @elseif($currentLocale === 'en')
                                                        <p class="font-bold mb-2">Limitation of Liability</p>
                                                        <p class="text-sm leading-relaxed">
                                                            The information published on this website is provided for informational purposes only. Acrevis Bank AG strives to ensure the accuracy and timeliness of the information but cannot guarantee its completeness or absolute accuracy. Use of the information is at the user's own risk.
                                                        </p>
                                                    @else
                                                        <p class="font-bold mb-2">Limitación de responsabilidad</p>
                                                        <p class="text-sm leading-relaxed">
                                                            La información publicada en este sitio web se proporciona únicamente con fines informativos. Acrevis Bank AG se esfuerza por garantizar la exactitud y actualidad de la información, pero no puede garantizar su exhaustividad o exactitud absoluta. El uso de la información es bajo el propio riesgo del usuario.
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="prose max-w-none text-gray-700 text-sm">
                                            <p>
                                                @if($currentLocale === 'fr')
                                                    Acrevis Bank AG décline toute responsabilité pour les dommages directs ou indirects résultant de l'accès au site web, de son utilisation ou de l'impossibilité d'y accéder, sauf en cas de faute grave ou de négligence intentionnelle.
                                                @elseif($currentLocale === 'de')
                                                    Die Acrevis Bank AG lehnt jede Haftung für direkte oder indirekte Schäden ab, die sich aus dem Zugriff auf die Website, ihrer Nutzung oder der Unmöglichkeit des Zugriffs ergeben, ausser bei grobem Verschulden oder vorsätzlicher Fahrlässigkeit.
                                                @elseif($currentLocale === 'en')
                                                    Acrevis Bank AG disclaims any liability for direct or indirect damages resulting from access to the website, its use or inability to access it, except in cases of gross negligence or intentional misconduct.
                                                @else
                                                    Acrevis Bank AG rechaza cualquier responsabilidad por daños directos o indirectos resultantes del acceso al sitio web, su uso o la imposibilidad de acceder a él, excepto en casos de negligencia grave o mala conducta intencional.
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Contact CTA Section -->
    <div class="bg-gradient-to-r from-pink-600 to-pink-700 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">
                @if($currentLocale === 'fr')
                    Des questions ?
                @elseif($currentLocale === 'de')
                    Fragen?
                @elseif($currentLocale === 'en')
                    Questions?
                @else
                    ¿Preguntas?
                @endif
            </h2>
            <p class="text-pink-100 mb-8 text-lg">
                @if($currentLocale === 'fr')
                    Notre équipe est à votre disposition pour toute information complémentaire.
                @elseif($currentLocale === 'de')
                    Unser Team steht Ihnen für weitere Informationen zur Verfügung.
                @elseif($currentLocale === 'en')
                    Our team is available for any additional information.
                @else
                    Nuestro equipo está a su disposición para cualquier información adicional.
                @endif
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact', ['locale' => $currentLocale]) }}"
                   class="inline-block bg-white text-pink-600 hover:bg-pink-50 px-8 py-3 rounded-md font-semibold transition-colors">
                    {{ $t['contactUs'] }}
                </a>
                <a href="tel:+41712272727"
                   class="inline-block border-2 border-white text-white hover:bg-white/10 px-8 py-3 rounded-md font-semibold transition-colors">
                    +41 71 227 27 27
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>
