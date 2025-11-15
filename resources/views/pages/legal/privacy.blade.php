<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();
        $translations = [
            'fr' => [
                'title' => 'Politique de Confidentialité',
                'subtitle' => 'Protection de vos données personnelles',
                'updated' => 'Dernière mise à jour : 1er novembre 2025',
                'toc' => 'Table des matières',
                'backToTop' => 'Retour en haut',
            ],
            'de' => [
                'title' => 'Datenschutzrichtlinie',
                'subtitle' => 'Schutz Ihrer persönlichen Daten',
                'updated' => 'Letzte Aktualisierung: 1. November 2025',
                'toc' => 'Inhaltsverzeichnis',
                'backToTop' => 'Nach oben',
            ],
            'en' => [
                'title' => 'Privacy Policy',
                'subtitle' => 'Protection of your personal data',
                'updated' => 'Last updated: November 1, 2025',
                'toc' => 'Table of Contents',
                'backToTop' => 'Back to top',
            ],
            'es' => [
                'title' => 'Política de Privacidad',
                'subtitle' => 'Protección de sus datos personales',
                'updated' => 'Última actualización: 1 de noviembre de 2025',
                'toc' => 'Tabla de contenidos',
                'backToTop' => 'Volver arriba',
            ],
        ];
        $t = $translations[$currentLocale];
    @endphp

    <x-slot name="title">{{ $t['title'] }}</x-slot>

    <!-- Hero -->
    <div class="bg-gradient-to-r from-pink-600 to-pink-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center mb-4">
                <svg class="w-12 h-12 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $t['title'] }}</h1>
            <p class="text-xl text-pink-100">{{ $t['subtitle'] }}</p>
            <p class="text-sm text-pink-200 mt-4 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ $t['updated'] }}
            </p>
        </div>
    </div>

    <!-- Content -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                <!-- Sidebar TOC (sticky) -->
                <aside class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                            {{ $t['toc'] }}
                        </h3>
                        <nav class="space-y-2">
                            <a href="#introduction" class="block text-sm text-gray-600 hover:text-pink-600 transition-colors">1. Introduction</a>
                            <a href="#donnees-collectees" class="block text-sm text-gray-600 hover:text-pink-600 transition-colors">2. Données collectées</a>
                            <a href="#utilisation" class="block text-sm text-gray-600 hover:text-pink-600 transition-colors">3. Utilisation des données</a>
                            <a href="#protection" class="block text-sm text-gray-600 hover:text-pink-600 transition-colors">4. Protection des données</a>
                            <a href="#droits" class="block text-sm text-gray-600 hover:text-pink-600 transition-colors">5. Vos droits</a>
                            <a href="#contact" class="block text-sm text-gray-600 hover:text-pink-600 transition-colors">6. Contact</a>
                        </nav>

                        <!-- Back to top button -->
                        <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
                                class="mt-6 w-full flex items-center justify-center text-pink-600 hover:text-pink-700 text-sm font-medium py-2 border border-pink-200 rounded-lg hover:bg-pink-50 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                            </svg>
                            {{ $t['backToTop'] }}
                        </button>
                    </div>
                </aside>

                <!-- Main Content -->
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-lg shadow-md p-8 space-y-8">
                        @if($currentLocale === 'fr')
                            <!-- Section 1 -->
                            <section id="introduction" class="scroll-mt-6">
                                <div class="flex items-start mb-4">
                                    <div class="flex-shrink-0 bg-pink-100 rounded-lg p-3 mr-4">
                                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h2 class="text-2xl font-bold text-gray-900">1. Introduction</h2>
                                        <p class="mt-3 text-gray-700 leading-relaxed">
                                            Acrevis Bank AG s'engage à protéger la confidentialité et la sécurité de vos données personnelles. Cette politique explique comment nous collectons, utilisons et protégeons vos informations conformément aux lois suisses et européennes sur la protection des données.
                                        </p>
                                    </div>
                                </div>
                            </section>

                            <hr class="border-gray-200">

                            <!-- Section 2 -->
                            <section id="donnees-collectees" class="scroll-mt-6">
                                <div class="flex items-start mb-4">
                                    <div class="flex-shrink-0 bg-pink-100 rounded-lg p-3 mr-4">
                                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h2 class="text-2xl font-bold text-gray-900">2. Données collectées</h2>
                                        <p class="mt-3 text-gray-700 mb-4">Nous collectons les catégories de données suivantes :</p>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="bg-gray-50 rounded-lg p-4">
                                                <div class="flex items-start">
                                                    <svg class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                    <div>
                                                        <h3 class="font-semibold text-gray-900">Informations d'identification</h3>
                                                        <p class="text-sm text-gray-600 mt-1">Nom, prénom, date de naissance, nationalité</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bg-gray-50 rounded-lg p-4">
                                                <div class="flex items-start">
                                                    <svg class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                    <div>
                                                        <h3 class="font-semibold text-gray-900">Coordonnées</h3>
                                                        <p class="text-sm text-gray-600 mt-1">Adresse, téléphone, email</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bg-gray-50 rounded-lg p-4">
                                                <div class="flex items-start">
                                                    <svg class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                    <div>
                                                        <h3 class="font-semibold text-gray-900">Données financières</h3>
                                                        <p class="text-sm text-gray-600 mt-1">Transactions, soldes, historiques</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bg-gray-50 rounded-lg p-4">
                                                <div class="flex items-start">
                                                    <svg class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                    <div>
                                                        <h3 class="font-semibold text-gray-900">Données de navigation</h3>
                                                        <p class="text-sm text-gray-600 mt-1">Cookies, logs, adresse IP</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <hr class="border-gray-200">

                            <!-- Section 3 -->
                            <section id="utilisation" class="scroll-mt-6">
                                <div class="flex items-start mb-4">
                                    <div class="flex-shrink-0 bg-pink-100 rounded-lg p-3 mr-4">
                                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h2 class="text-2xl font-bold text-gray-900">3. Utilisation des données</h2>
                                        <p class="mt-3 text-gray-700 mb-4">Vos données sont utilisées pour les finalités suivantes :</p>
                                        <ul class="space-y-3">
                                            <li class="flex items-start">
                                                <svg class="w-5 h-5 text-pink-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                <span class="text-gray-700">Fournir et gérer nos services bancaires</span>
                                            </li>
                                            <li class="flex items-start">
                                                <svg class="w-5 h-5 text-pink-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                <span class="text-gray-700">Respecter nos obligations légales et réglementaires</span>
                                            </li>
                                            <li class="flex items-start">
                                                <svg class="w-5 h-5 text-pink-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                <span class="text-gray-700">Prévenir la fraude et assurer la sécurité</span>
                                            </li>
                                            <li class="flex items-start">
                                                <svg class="w-5 h-5 text-pink-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                <span class="text-gray-700">Améliorer continuellement nos services</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </section>

                            <hr class="border-gray-200">

                            <!-- Section 4 -->
                            <section id="protection" class="scroll-mt-6">
                                <div class="flex items-start mb-4">
                                    <div class="flex-shrink-0 bg-pink-100 rounded-lg p-3 mr-4">
                                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h2 class="text-2xl font-bold text-gray-900">4. Protection des données</h2>
                                        <div class="mt-4 bg-gradient-to-r from-pink-50 to-purple-50 rounded-lg p-6 border border-pink-100">
                                            <p class="text-gray-700 leading-relaxed">
                                                Nous mettons en œuvre des mesures de sécurité strictes conformes aux normes bancaires suisses et internationales, incluant :
                                            </p>
                                            <ul class="mt-4 space-y-2">
                                                <li class="flex items-center text-gray-700">
                                                    <svg class="w-4 h-4 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Chiffrement end-to-end
                                                </li>
                                                <li class="flex items-center text-gray-700">
                                                    <svg class="w-4 h-4 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Authentification forte (2FA)
                                                </li>
                                                <li class="flex items-center text-gray-700">
                                                    <svg class="w-4 h-4 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Surveillance continue 24/7
                                                </li>
                                                <li class="flex items-center text-gray-700">
                                                    <svg class="w-4 h-4 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Conformité ISO 27001
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <hr class="border-gray-200">

                            <!-- Section 5 -->
                            <section id="droits" class="scroll-mt-6">
                                <div class="flex items-start mb-4">
                                    <div class="flex-shrink-0 bg-pink-100 rounded-lg p-3 mr-4">
                                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h2 class="text-2xl font-bold text-gray-900">5. Vos droits</h2>
                                        <p class="mt-3 text-gray-700 mb-4">Conformément à la législation, vous disposez des droits suivants :</p>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="border-l-4 border-pink-600 bg-gray-50 p-4">
                                                <h3 class="font-semibold text-gray-900 mb-2">Droit d'accès</h3>
                                                <p class="text-sm text-gray-600">Consulter les données que nous détenons sur vous</p>
                                            </div>
                                            <div class="border-l-4 border-pink-600 bg-gray-50 p-4">
                                                <h3 class="font-semibold text-gray-900 mb-2">Droit de rectification</h3>
                                                <p class="text-sm text-gray-600">Corriger vos données inexactes</p>
                                            </div>
                                            <div class="border-l-4 border-pink-600 bg-gray-50 p-4">
                                                <h3 class="font-semibold text-gray-900 mb-2">Droit à l'effacement</h3>
                                                <p class="text-sm text-gray-600">Demander la suppression de vos données</p>
                                            </div>
                                            <div class="border-l-4 border-pink-600 bg-gray-50 p-4">
                                                <h3 class="font-semibold text-gray-900 mb-2">Droit à la portabilité</h3>
                                                <p class="text-sm text-gray-600">Récupérer vos données dans un format structuré</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <hr class="border-gray-200">

                            <!-- Section 6 -->
                            <section id="contact" class="scroll-mt-6">
                                <div class="flex items-start mb-4">
                                    <div class="flex-shrink-0 bg-pink-100 rounded-lg p-3 mr-4">
                                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h2 class="text-2xl font-bold text-gray-900">6. Contact</h2>
                                        <p class="mt-3 text-gray-700 mb-6">Pour toute question concernant vos données personnelles, contactez notre Délégué à la Protection des Données :</p>
                                        <div class="bg-gradient-to-r from-pink-600 to-pink-700 text-white rounded-lg p-6">
                                            <div class="space-y-4">
                                                <div class="flex items-start">
                                                    <svg class="w-5 h-5 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                    </svg>
                                                    <div>
                                                        <p class="font-semibold">Email</p>
                                                        <a href="mailto:privacy@acrevis.ch" class="text-pink-100 hover:text-white">privacy@acrevis.ch</a>
                                                    </div>
                                                </div>
                                                <div class="flex items-start">
                                                    <svg class="w-5 h-5 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                    </svg>
                                                    <div>
                                                        <p class="font-semibold">Téléphone</p>
                                                        <a href="tel:+41712272727" class="text-pink-100 hover:text-white">+41 71 227 27 27</a>
                                                    </div>
                                                </div>
                                                <div class="flex items-start">
                                                    <svg class="w-5 h-5 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    </svg>
                                                    <div>
                                                        <p class="font-semibold">Adresse</p>
                                                        <p class="text-pink-100">Acrevis Bank AG<br>St. Leonhardstrasse 25<br>9001 St. Gallen, Suisse</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        @else
                            <!-- Add other languages content here with same structure -->
                            <p class="text-gray-600">Content for {{ $currentLocale }} coming soon...</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
