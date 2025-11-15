<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();

        $texts = [
            'fr' => [
                'back' => '← Retour aux carrières',
                'published_on' => 'Publié le',
                'location' => 'Lieu',
                'department' => 'Département',
                'contract_type' => 'Type de contrat',
                'workload' => 'Taux d\'occupation',
                'description' => 'Description du poste',
                'requirements' => 'Profil recherché',
                'benefits' => 'Ce que nous offrons',
                'apply' => 'Postuler',
                'application_form' => 'Formulaire de candidature',
                'form_subtitle' => 'Remplissez le formulaire ci-dessous pour postuler à ce poste',
                'full_name' => 'Nom complet',
                'email' => 'Adresse e-mail',
                'phone' => 'Téléphone',
                'message' => 'Lettre de motivation',
                'message_placeholder' => 'Parlez-nous de vous et de votre intérêt pour ce poste...',
                'cv_upload' => 'CV (PDF)',
                'submit' => 'Envoyer ma candidature',
                'or_email' => 'Ou envoyez votre candidature par e-mail à',
                'other_positions' => 'Autres postes disponibles',
            ],
            'de' => [
                'back' => '← Zurück zu Karriere',
                'published_on' => 'Veröffentlicht am',
                'location' => 'Standort',
                'department' => 'Abteilung',
                'contract_type' => 'Vertragsart',
                'workload' => 'Arbeitspensum',
                'description' => 'Stellenbeschreibung',
                'requirements' => 'Gesuchtes Profil',
                'benefits' => 'Was wir bieten',
                'apply' => 'Bewerben',
                'application_form' => 'Bewerbungsformular',
                'form_subtitle' => 'Füllen Sie das untenstehende Formular aus, um sich für diese Stelle zu bewerben',
                'full_name' => 'Vollständiger Name',
                'email' => 'E-Mail-Adresse',
                'phone' => 'Telefon',
                'message' => 'Motivationsschreiben',
                'message_placeholder' => 'Erzählen Sie uns von sich und Ihrem Interesse an dieser Position...',
                'cv_upload' => 'Lebenslauf (PDF)',
                'submit' => 'Bewerbung senden',
                'or_email' => 'Oder senden Sie Ihre Bewerbung per E-Mail an',
                'other_positions' => 'Weitere verfügbare Stellen',
            ],
            'en' => [
                'back' => '← Back to careers',
                'published_on' => 'Published on',
                'location' => 'Location',
                'department' => 'Department',
                'contract_type' => 'Contract type',
                'workload' => 'Workload',
                'description' => 'Job description',
                'requirements' => 'Profile sought',
                'benefits' => 'What we offer',
                'apply' => 'Apply',
                'application_form' => 'Application form',
                'form_subtitle' => 'Fill out the form below to apply for this position',
                'full_name' => 'Full name',
                'email' => 'Email address',
                'phone' => 'Phone',
                'message' => 'Cover letter',
                'message_placeholder' => 'Tell us about yourself and your interest in this position...',
                'cv_upload' => 'CV (PDF)',
                'submit' => 'Submit application',
                'or_email' => 'Or send your application by email to',
                'other_positions' => 'Other available positions',
            ],
            'es' => [
                'back' => '← Volver a carreras',
                'published_on' => 'Publicado el',
                'location' => 'Ubicación',
                'department' => 'Departamento',
                'contract_type' => 'Tipo de contrato',
                'workload' => 'Carga de trabajo',
                'description' => 'Descripción del puesto',
                'requirements' => 'Perfil buscado',
                'benefits' => 'Lo que ofrecemos',
                'apply' => 'Aplicar',
                'application_form' => 'Formulario de solicitud',
                'form_subtitle' => 'Complete el formulario a continuación para solicitar este puesto',
                'full_name' => 'Nombre completo',
                'email' => 'Dirección de correo electrónico',
                'phone' => 'Teléfono',
                'message' => 'Carta de presentación',
                'message_placeholder' => 'Cuéntenos sobre usted y su interés en este puesto...',
                'cv_upload' => 'CV (PDF)',
                'submit' => 'Enviar solicitud',
                'or_email' => 'O envíe su solicitud por correo electrónico a',
                'other_positions' => 'Otros puestos disponibles',
            ]
        ];

        $t = $texts[$currentLocale];
    @endphp

    <x-slot name="title">{{ $career->getTranslation('title', $currentLocale) }}</x-slot>

    <!-- Hero -->
    <div class="bg-gradient-to-r from-pink-600 to-pink-700 text-white py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('career.index', ['locale' => $currentLocale]) }}" class="inline-flex items-center text-pink-100 hover:text-white mb-6 transition-colors">
                {{ $t['back'] }}
            </a>
            <h1 class="text-4xl md:text-5xl font-bold mb-6">
                {{ $career->getTranslation('title', $currentLocale) }}
            </h1>
            <div class="flex flex-wrap gap-4">
                <span class="inline-flex items-center px-4 py-2 bg-white/20 rounded-full text-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    {{ $career->location }}
                </span>
                <span class="inline-flex items-center px-4 py-2 bg-white/20 rounded-full text-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    {{ $career->department }}
                </span>
                <span class="inline-flex items-center px-4 py-2 bg-white/20 rounded-full text-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    {{ $career->contract_type }}
                </span>
                <span class="inline-flex items-center px-4 py-2 bg-white/20 rounded-full text-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $career->workload }}
                </span>
            </div>
            @if($career->published_at)
                <p class="mt-4 text-pink-100 text-sm">
                    {{ $t['published_on'] }} {{ $career->published_at->format('d.m.Y') }}
                </p>
            @endif
        </div>
    </div>

    <!-- Content -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Description -->
                    <div class="bg-white rounded-lg shadow-md p-8">
                        <h2 class="text-2xl font-bold mb-6 text-gray-900 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            {{ $t['description'] }}
                        </h2>
                        <div class="prose max-w-none text-gray-700">
                            {!! nl2br($career->getTranslation('description', $currentLocale)) !!}
                        </div>
                    </div>

                    <!-- Requirements -->
                    <div class="bg-white rounded-lg shadow-md p-8">
                        <h2 class="text-2xl font-bold mb-6 text-gray-900 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $t['requirements'] }}
                        </h2>
                        <div class="prose max-w-none text-gray-700">
                            {!! nl2br($career->getTranslation('requirements', $currentLocale)) !!}
                        </div>
                    </div>

                    <!-- Benefits -->
                    @if($career->getTranslation('benefits', $currentLocale))
                        <div class="bg-white rounded-lg shadow-md p-8">
                            <h2 class="text-2xl font-bold mb-6 text-gray-900 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                </svg>
                                {{ $t['benefits'] }}
                            </h2>
                            <div class="prose max-w-none text-gray-700">
                                {!! nl2br($career->getTranslation('benefits', $currentLocale)) !!}
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Application CTA -->
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                        <h3 class="text-xl font-bold mb-4 text-gray-900">{{ $t['apply'] }}</h3>
                        <a href="#application-form" class="block w-full bg-pink-600 hover:bg-pink-700 text-white font-semibold py-3 px-4 rounded-md transition-colors text-center mb-4">
                            {{ $t['submit'] }}
                        </a>
                        <div class="text-center text-sm text-gray-600">
                            <p class="mb-2">{{ $t['or_email'] }}</p>
                            <a href="mailto:jobs@acrevis.ch" class="text-pink-600 hover:text-pink-700 font-medium">
                                jobs@acrevis.ch
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Application Form -->
            <div id="application-form" class="mt-12 bg-white rounded-lg shadow-md p-8">
                <div class="max-w-3xl mx-auto">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold mb-2 text-gray-900">{{ $t['application_form'] }}</h2>
                        <p class="text-gray-600">{{ $t['form_subtitle'] }}</p>
                    </div>

                    <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <input type="hidden" name="career_id" value="{{ $career->id }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Full Name -->
                            <div>
                                <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ $t['full_name'] }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="full_name" name="full_name" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ $t['email'] }} <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="email" name="email" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                            </div>
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ $t['phone'] }} <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" id="phone" name="phone" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                        </div>

                        <!-- Cover Letter -->
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ $t['message'] }} <span class="text-red-500">*</span>
                            </label>
                            <textarea id="message" name="message" rows="6" required
                                      placeholder="{{ $t['message_placeholder'] }}"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500"></textarea>
                        </div>

                        <!-- CV Upload -->
                        <div>
                            <label for="cv" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ $t['cv_upload'] }} <span class="text-red-500">*</span>
                            </label>
                            <input type="file" id="cv" name="cv" accept=".pdf" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100">
                            <p class="mt-1 text-sm text-gray-500">PDF uniquement, 5 MB maximum</p>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white font-semibold py-4 rounded-md transition-colors">
                                {{ $t['submit'] }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Other Positions -->
            @php
                $otherCareers = \App\Models\Career::active()
                    ->where('id', '!=', $career->id)
                    ->orderBy('order')
                    ->take(3)
                    ->get();
            @endphp

            @if($otherCareers->count() > 0)
                <div class="mt-12">
                    <h2 class="text-2xl font-bold mb-6">{{ $t['other_positions'] }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($otherCareers as $other)
                            <a href="{{ route('career.show', ['locale' => $currentLocale, 'slug' => $other->slug]) }}"
                               class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow p-6 border border-gray-200">
                                <h3 class="font-bold text-lg mb-2 hover:text-pink-600">
                                    {{ $other->getTranslation('title', $currentLocale) }}
                                </h3>
                                <div class="space-y-1 text-sm text-gray-600 mb-4">
                                    <p class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        </svg>
                                        {{ $other->location }}
                                    </p>
                                    <p class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $other->workload }}
                                    </p>
                                </div>
                                <span class="text-pink-600 text-sm font-medium">
                                    {{ $currentLocale === 'fr' ? 'En savoir plus' :
                                       ($currentLocale === 'de' ? 'Mehr erfahren' :
                                       ($currentLocale === 'en' ? 'Learn more' : 'Más información')) }} →
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
