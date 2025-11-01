<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();

        $texts = [
            'fr' => [
                'title' => 'Demande de crédit',
                'meta_desc' => 'Faites votre demande de crédit en ligne avec Acrevis Bank. Processus simple et rapide en 3 étapes.',
                'intro_title' => 'Demandez votre crédit en toute simplicité',
                'intro_text' => 'Remplissez notre formulaire en ligne en 3 étapes simples. Nous étudierons votre demande rapidement et vous contacterons dans les meilleurs délais.',
                'benefits_title' => 'Pourquoi choisir Acrevis Bank?',
                'benefit_1' => 'Processus simple et rapide',
                'benefit_1_desc' => 'Formulaire en ligne intuitif, réponse rapide',
                'benefit_2' => 'Taux compétitifs',
                'benefit_2_desc' => 'Conditions avantageuses adaptées à votre profil',
                'benefit_3' => 'Accompagnement personnalisé',
                'benefit_3_desc' => 'Conseiller dédié pour vous guider',
                'benefit_4' => 'Flexibilité',
                'benefit_4_desc' => 'Durées et montants adaptés à vos besoins',
                'info_title' => 'Informations importantes',
                'info_1' => 'Montant: de CHF 1\'000 à CHF 1\'000\'000',
                'info_2' => 'Durée: de 12 à 360 mois',
                'info_3' => 'Réponse sous 48h ouvrées',
                'info_4' => 'Documents nécessaires: pièce d\'identité, justificatifs de revenus',
            ],
            'de' => [
                'title' => 'Kreditantrag',
                'meta_desc' => 'Stellen Sie Ihren Kreditantrag online bei Acrevis Bank. Einfacher und schneller Prozess in 3 Schritten.',
                'intro_title' => 'Beantragen Sie Ihren Kredit ganz einfach',
                'intro_text' => 'Füllen Sie unser Online-Formular in 3 einfachen Schritten aus. Wir prüfen Ihren Antrag schnell und kontaktieren Sie umgehend.',
                'benefits_title' => 'Warum Acrevis Bank wählen?',
                'benefit_1' => 'Einfacher und schneller Prozess',
                'benefit_1_desc' => 'Intuitives Online-Formular, schnelle Antwort',
                'benefit_2' => 'Wettbewerbsfähige Zinssätze',
                'benefit_2_desc' => 'Vorteilhafte Konditionen für Ihr Profil',
                'benefit_3' => 'Persönliche Betreuung',
                'benefit_3_desc' => 'Dedizierter Berater zur Unterstützung',
                'benefit_4' => 'Flexibilität',
                'benefit_4_desc' => 'Laufzeiten und Beträge nach Ihren Bedürfnissen',
                'info_title' => 'Wichtige Informationen',
                'info_1' => 'Betrag: von CHF 1\'000 bis CHF 1\'000\'000',
                'info_2' => 'Laufzeit: von 12 bis 360 Monaten',
                'info_3' => 'Antwort innerhalb von 48 Arbeitsstunden',
                'info_4' => 'Erforderliche Dokumente: Ausweis, Einkommensnachweise',
            ],
            'en' => [
                'title' => 'Credit Application',
                'meta_desc' => 'Apply for credit online with Acrevis Bank. Simple and fast process in 3 steps.',
                'intro_title' => 'Apply for your credit with ease',
                'intro_text' => 'Fill out our online form in 3 simple steps. We will review your application quickly and contact you promptly.',
                'benefits_title' => 'Why choose Acrevis Bank?',
                'benefit_1' => 'Simple and fast process',
                'benefit_1_desc' => 'Intuitive online form, quick response',
                'benefit_2' => 'Competitive rates',
                'benefit_2_desc' => 'Advantageous conditions adapted to your profile',
                'benefit_3' => 'Personalized support',
                'benefit_3_desc' => 'Dedicated advisor to guide you',
                'benefit_4' => 'Flexibility',
                'benefit_4_desc' => 'Durations and amounts adapted to your needs',
                'info_title' => 'Important Information',
                'info_1' => 'Amount: from CHF 1,000 to CHF 1,000,000',
                'info_2' => 'Duration: from 12 to 360 months',
                'info_3' => 'Response within 48 business hours',
                'info_4' => 'Required documents: ID, proof of income',
            ],
            'es' => [
                'title' => 'Solicitud de Crédito',
                'meta_desc' => 'Solicite su crédito en línea con Acrevis Bank. Proceso simple y rápido en 3 pasos.',
                'intro_title' => 'Solicite su crédito con facilidad',
                'intro_text' => 'Complete nuestro formulario en línea en 3 simples pasos. Revisaremos su solicitud rápidamente y nos pondremos en contacto con usted a la brevedad.',
                'benefits_title' => '¿Por qué elegir Acrevis Bank?',
                'benefit_1' => 'Proceso simple y rápido',
                'benefit_1_desc' => 'Formulario en línea intuitivo, respuesta rápida',
                'benefit_2' => 'Tasas competitivas',
                'benefit_2_desc' => 'Condiciones ventajosas adaptadas a su perfil',
                'benefit_3' => 'Acompañamiento personalizado',
                'benefit_3_desc' => 'Asesor dedicado para guiarle',
                'benefit_4' => 'Flexibilidad',
                'benefit_4_desc' => 'Duraciones y montos adaptados a sus necesidades',
                'info_title' => 'Información Importante',
                'info_1' => 'Monto: de CHF 1.000 a CHF 1.000.000',
                'info_2' => 'Duración: de 12 a 360 meses',
                'info_3' => 'Respuesta en 48 horas hábiles',
                'info_4' => 'Documentos requeridos: identificación, comprobantes de ingresos',
            ]
        ];

        $t = $texts[$currentLocale];
    @endphp

    <x-slot name="title">{{ $t['title'] }}</x-slot>
    <x-slot name="metaDescription">{{ $t['meta_desc'] }}</x-slot>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-pink-600 to-pink-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $t['intro_title'] }}</h1>
                <p class="text-xl md:text-2xl max-w-3xl mx-auto">{{ $t['intro_text'] }}</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Benefits Section -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-center mb-12">{{ $t['benefits_title'] }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Benefit 1 -->
                    <div class="bg-white rounded-lg p-6 shadow-md text-center">
                        <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold mb-2">{{ $t['benefit_1'] }}</h3>
                        <p class="text-gray-600 text-sm">{{ $t['benefit_1_desc'] }}</p>
                    </div>

                    <!-- Benefit 2 -->
                    <div class="bg-white rounded-lg p-6 shadow-md text-center">
                        <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold mb-2">{{ $t['benefit_2'] }}</h3>
                        <p class="text-gray-600 text-sm">{{ $t['benefit_2_desc'] }}</p>
                    </div>

                    <!-- Benefit 3 -->
                    <div class="bg-white rounded-lg p-6 shadow-md text-center">
                        <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold mb-2">{{ $t['benefit_3'] }}</h3>
                        <p class="text-gray-600 text-sm">{{ $t['benefit_3_desc'] }}</p>
                    </div>

                    <!-- Benefit 4 -->
                    <div class="bg-white rounded-lg p-6 shadow-md text-center">
                        <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold mb-2">{{ $t['benefit_4'] }}</h3>
                        <p class="text-gray-600 text-sm">{{ $t['benefit_4_desc'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Livewire Form -->
            <div class="mb-16">
                @livewire('credit-request-form')
            </div>

            <!-- Important Information -->
            <div class="bg-white rounded-lg shadow-md p-8">
                <h2 class="text-2xl font-bold mb-6">{{ $t['info_title'] }}</h2>
                <ul class="space-y-3">
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-pink-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-gray-700">{{ $t['info_1'] }}</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-pink-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-gray-700">{{ $t['info_2'] }}</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-pink-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-gray-700">{{ $t['info_3'] }}</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-pink-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-gray-700">{{ $t['info_4'] }}</span>
                    </li>
                </ul>
            </div>

        </div>
    </div>

</x-layouts.app>
