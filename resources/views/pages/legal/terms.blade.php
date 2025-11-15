<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();
        $translations = [
            'fr' => [
                'title' => 'Conditions Générales',
                'subtitle' => 'Conditions d\'utilisation de nos services bancaires',
                'updated' => 'Dernière mise à jour : 1er novembre 2025',
                'toc' => 'Table des matières',
                'backToTop' => 'Retour en haut',
            ],
            'de' => [
                'title' => 'Allgemeine Geschäftsbedingungen',
                'subtitle' => 'Nutzungsbedingungen unserer Bankdienstleistungen',
                'updated' => 'Letzte Aktualisierung: 1. November 2025',
                'toc' => 'Inhaltsverzeichnis',
                'backToTop' => 'Nach oben',
            ],
            'en' => [
                'title' => 'Terms and Conditions',
                'subtitle' => 'Terms of use for our banking services',
                'updated' => 'Last updated: November 1, 2025',
                'toc' => 'Table of Contents',
                'backToTop' => 'Back to top',
            ],
            'es' => [
                'title' => 'Términos y Condiciones',
                'subtitle' => 'Condiciones de uso de nuestros servicios bancarios',
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
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

                <!-- Sidebar TOC -->
                <aside class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                            {{ $t['toc'] }}
                        </h3>
                        <nav class="space-y-2">
                            <a href="#acceptation" class="block text-sm text-gray-600 hover:text-pink-600 transition-colors">1. Acceptation</a>
                            <a href="#services" class="block text-sm text-gray-600 hover:text-pink-600 transition-colors">2. Services bancaires</a>
                            <a href="#ouverture" class="block text-sm text-gray-600 hover:text-pink-600 transition-colors">3. Ouverture de compte</a>
                            <a href="#securite" class="block text-sm text-gray-600 hover:text-pink-600 transition-colors">4. Sécurité</a>
                            <a href="#frais" class="block text-sm text-gray-600 hover:text-pink-600 transition-colors">5. Frais</a>
                            <a href="#resiliation" class="block text-sm text-gray-600 hover:text-pink-600 transition-colors">6. Résiliation</a>
                            <a href="#droit" class="block text-sm text-gray-600 hover:text-pink-600 transition-colors">7. Droit applicable</a>
                            <a href="#contact" class="block text-sm text-gray-600 hover:text-pink-600 transition-colors">8. Contact</a>
                        </nav>

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
                            <section id="acceptation" class="scroll-mt-6">
                                <div class="flex items-start mb-4">
                                    <div class="flex-shrink-0 bg-pink-100 rounded-lg p-3 mr-4">
                                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h2 class="text-2xl font-bold text-gray-900">1. Acceptation des conditions</h2>
                                        <p class="mt-3 text-gray-700 leading-relaxed">
                                            En utilisant les services d'Acrevis Bank AG, vous acceptez d'être lié par ces conditions générales. Si vous n'acceptez pas ces conditions, veuillez ne pas utiliser nos services.
                                        </p>
                                        <div class="mt-4 bg-yellow-50 border-l-4 border-yellow-400 p-4">
                                            <p class="text-sm text-yellow-800">
                                                <strong>Important :</strong> L'utilisation de nos services implique l'acceptation tacite de ces conditions.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <hr class="border-gray-200">

                            <!-- Section 2 -->
                            <section id="services" class="scroll-mt-6">
                                <div class="flex items-start mb-4">
                                    <div class="flex-shrink-0 bg-pink-100 rounded-lg p-3 mr-4">
                                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h2 class="text-2xl font-bold text-gray-900">2. Services bancaires</h2>
                                        <p class="mt-3 text-gray-700 mb-4">Acrevis Bank AG propose une gamme complète de services bancaires :</p>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-pink-600">
                                                <h3 class="font-semibold text-gray-900 mb-2">Comptes & Cartes</h3>
                                                <p class="text-sm text-gray-600">Comptes courants, épargne, cartes de débit et crédit</p>
                                            </div>
                                            <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-pink-600">
                                                <h3 class="font-semibold text-gray-900 mb-2">Crédits & Hypothèques</h3>
                                                <p class="text-sm text-gray-600">Prêts personnels, hypothèques résidentielles</p>
                                            </div>
                                            <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-pink-600">
                                                <h3 class="font-semibold text-gray-900 mb-2">Placements</h3>
                                                <p class="text-sm text-gray-600">Gestion de fortune, placements, épargne</p>
                                            </div>
                                            <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-pink-600">
                                                <h3 class="font-semibold text-gray-900 mb-2">Services numériques</h3>
                                                <p class="text-sm text-gray-600">E-banking, mobile banking, API</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <hr class="border-gray-200">

                            <!-- Section 3 -->
                            <section id="ouverture" class="scroll-mt-6">
                                <div class="flex items-start mb-4">
                                    <div class="flex-shrink-0 bg-pink-100 rounded-lg p-3 mr-4">
                                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h2 class="text-2xl font-bold text-gray-900">3. Ouverture de compte</h2>
                                        <p class="mt-3 text-gray-700 mb-4">Pour ouvrir un compte chez Acrevis Bank AG, vous devez remplir les conditions suivantes :</p>
                                        <ul class="space-y-3">
                                            <li class="flex items-start">
                                                <svg class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                <span class="text-gray-700">Être majeur (18 ans minimum)</span>
                                            </li>
                                            <li class="flex items-start">
                                                <svg class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                <span class="text-gray-700">Fournir une pièce d'identité valide (passeport, carte d'identité)</span>
                                            </li>
                                            <li class="flex items-start">
                                                <svg class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                <span class="text-gray-700">Justifier de votre domicile (facture récente, attestation)</span>
                                            </li>
                                            <li class="flex items-start">
                                                <svg class="w-5 h-5 text-green-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                <span class="text-gray-700">Respecter les obligations de lutte contre le blanchiment d'argent (LBA)</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </section>

                            <hr class="border-gray-200">

                            <!-- Section 4 -->
                            <section id="securite" class="scroll-mt-6">
                                <div class="flex items-start mb-4">
                                    <div class="flex-shrink-0 bg-pink-100 rounded-lg p-3 mr-4">
                                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h2 class="text-2xl font-bold text-gray-900">4. Sécurité et confidentialité</h2>
                                        <div class="mt-4 bg-gradient-to-r from-red-50 to-orange-50 rounded-lg p-6 border border-red-200">
                                            <div class="flex items-start">
                                                <svg class="w-6 h-6 text-red-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                                </svg>
                                                <div>
                                                    <p class="text-gray-800 font-semibold mb-2">Responsabilité du client</p>
                                                    <p class="text-gray-700 text-sm">
                                                        Vous êtes responsable de la confidentialité de vos codes d'accès, mots de passe et dispositifs d'authentification. En cas de perte, vol ou utilisation non autorisée, vous devez <strong>immédiatement</strong> nous en informer au +41 71 227 27 27.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <hr class="border-gray-200">

                            <!-- Section 5 -->
                            <section id="frais" class="scroll-mt-6">
                                <div class="flex items-start mb-4">
                                    <div class="flex-shrink-0 bg-pink-100 rounded-lg p-3 mr-4">
                                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h2 class="text-2xl font-bold text-gray-900">5. Frais et commissions</h2>
                                        <p class="mt-3 text-gray-700">
                                            Les frais applicables sont détaillés dans notre brochure tarifaire disponible en agence et sur notre site internet. Nous nous réservons le droit de modifier nos tarifs avec un préavis de <strong>30 jours</strong>.
                                        </p>
                                        <div class="mt-4 bg-blue-50 border-l-4 border-blue-400 p-4">
                                            <p class="text-sm text-blue-800">
                                                <strong>Info :</strong> Consultez notre brochure tarifaire pour connaître tous les frais applicables à votre compte et vos opérations.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <hr class="border-gray-200">

                            <!-- Section 6 -->
                            <section id="resiliation" class="scroll-mt-6">
                                <div class="flex items-start mb-4">
                                    <div class="flex-shrink-0 bg-pink-100 rounded-lg p-3 mr-4">
                                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h2 class="text-2xl font-bold text-gray-900">6. Résiliation</h2>
                                        <div class="mt-4 space-y-4">
                                            <div class="bg-gray-50 rounded-lg p-4">
                                                <p class="font-semibold text-gray-900 mb-2">Résiliation par le client</p>
                                                <p class="text-sm text-gray-700">Vous pouvez résilier votre relation bancaire à tout moment moyennant un préavis de <strong>30 jours</strong>.</p>
                                            </div>
                                            <div class="bg-gray-50 rounded-lg p-4">
                                                <p class="font-semibold text-gray-900 mb-2">Résiliation par la banque</p>
                                                <p class="text-sm text-gray-700">Acrevis Bank AG peut également résilier la relation bancaire en respectant un préavis de <strong>60 jours</strong>.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <hr class="border-gray-200">

                            <!-- Section 7 -->
                            <section id="droit" class="scroll-mt-6">
                                <div class="flex items-start mb-4">
                                    <div class="flex-shrink-0 bg-pink-100 rounded-lg p-3 mr-4">
                                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h2 class="text-2xl font-bold text-gray-900">7. Droit applicable et juridiction</h2>
                                        <div class="mt-4 bg-gray-50 rounded-lg p-6">
                                            <div class="space-y-3">
                                                <div class="flex items-center">
                                                    <svg class="w-5 h-5 text-pink-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    <p class="text-gray-700"><strong>Droit applicable :</strong> Droit suisse</p>
                                                </div>
                                                <div class="flex items-center">
                                                    <svg class="w-5 h-5 text-pink-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    <p class="text-gray-700"><strong>For juridique :</strong> St. Gallen, Suisse</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <hr class="border-gray-200">

                            <!-- Section 8 -->
                            <section id="contact" class="scroll-mt-6">
                                <div class="flex items-start mb-4">
                                    <div class="flex-shrink-0 bg-pink-100 rounded-lg p-3 mr-4">
                                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h2 class="text-2xl font-bold text-gray-900">8. Contact</h2>
                                        <p class="mt-3 text-gray-700 mb-6">Pour toute question concernant ces conditions :</p>
                                        <div class="bg-gradient-to-r from-pink-600 to-pink-700 text-white rounded-lg p-6">
                                            <div class="space-y-4">
                                                <div class="flex items-start">
                                                    <svg class="w-5 h-5 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                    </svg>
                                                    <div>
                                                        <p class="font-semibold">Email</p>
                                                        <a href="mailto:info@acrevis.ch" class="text-pink-100 hover:text-white">info@acrevis.ch</a>
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
                            <p class="text-gray-600">Content for {{ $currentLocale }} coming soon...</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
