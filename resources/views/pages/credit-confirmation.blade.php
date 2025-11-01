<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();

        $texts = [
            'fr' => [
                'title' => 'Demande reçue',
                'thank_you' => 'Merci pour votre demande!',
                'message' => 'Votre demande de crédit a été envoyée avec succès.',
                'next_steps' => 'Prochaines étapes',
                'step_1' => 'Traitement de votre demande',
                'step_1_desc' => 'Notre équipe analysera votre dossier dans les 48 heures ouvrées.',
                'step_2' => 'Vérification des documents',
                'step_2_desc' => 'Nous pourrions vous contacter pour des informations complémentaires.',
                'step_3' => 'Décision',
                'step_3_desc' => 'Vous recevrez notre réponse par email et/ou téléphone.',
                'reference' => 'Numéro de référence',
                'contact_title' => 'Questions?',
                'contact_text' => 'N\'hésitez pas à nous contacter si vous avez des questions concernant votre demande.',
                'phone' => 'Téléphone',
                'email' => 'Email',
                'back_home' => 'Retour à l\'accueil',
                'confirmation_email' => 'Un email de confirmation a été envoyé à votre adresse.',
            ],
            'de' => [
                'title' => 'Antrag erhalten',
                'thank_you' => 'Vielen Dank für Ihren Antrag!',
                'message' => 'Ihr Kreditantrag wurde erfolgreich übermittelt.',
                'next_steps' => 'Nächste Schritte',
                'step_1' => 'Bearbeitung Ihres Antrags',
                'step_1_desc' => 'Unser Team wird Ihren Antrag innerhalb von 48 Arbeitsstunden prüfen.',
                'step_2' => 'Überprüfung der Dokumente',
                'step_2_desc' => 'Wir können Sie für zusätzliche Informationen kontaktieren.',
                'step_3' => 'Entscheidung',
                'step_3_desc' => 'Sie erhalten unsere Antwort per E-Mail und/oder Telefon.',
                'reference' => 'Referenznummer',
                'contact_title' => 'Fragen?',
                'contact_text' => 'Zögern Sie nicht, uns zu kontaktieren, wenn Sie Fragen zu Ihrem Antrag haben.',
                'phone' => 'Telefon',
                'email' => 'E-Mail',
                'back_home' => 'Zurück zur Startseite',
                'confirmation_email' => 'Eine Bestätigungs-E-Mail wurde an Ihre Adresse gesendet.',
            ],
            'en' => [
                'title' => 'Application Received',
                'thank_you' => 'Thank you for your application!',
                'message' => 'Your credit application has been successfully submitted.',
                'next_steps' => 'Next Steps',
                'step_1' => 'Processing your application',
                'step_1_desc' => 'Our team will review your application within 48 business hours.',
                'step_2' => 'Document verification',
                'step_2_desc' => 'We may contact you for additional information.',
                'step_3' => 'Decision',
                'step_3_desc' => 'You will receive our response by email and/or phone.',
                'reference' => 'Reference number',
                'contact_title' => 'Questions?',
                'contact_text' => 'Don\'t hesitate to contact us if you have questions about your application.',
                'phone' => 'Phone',
                'email' => 'Email',
                'back_home' => 'Back to home',
                'confirmation_email' => 'A confirmation email has been sent to your address.',
            ],
            'es' => [
                'title' => 'Solicitud recibida',
                'thank_you' => '¡Gracias por su solicitud!',
                'message' => 'Su solicitud de crédito ha sido enviada con éxito.',
                'next_steps' => 'Próximos pasos',
                'step_1' => 'Procesamiento de su solicitud',
                'step_1_desc' => 'Nuestro equipo revisará su solicitud en 48 horas hábiles.',
                'step_2' => 'Verificación de documentos',
                'step_2_desc' => 'Podríamos contactarle para información adicional.',
                'step_3' => 'Decisión',
                'step_3_desc' => 'Recibirá nuestra respuesta por correo y/o teléfono.',
                'reference' => 'Número de referencia',
                'contact_title' => '¿Preguntas?',
                'contact_text' => 'No dude en contactarnos si tiene preguntas sobre su solicitud.',
                'phone' => 'Teléfono',
                'email' => 'Correo',
                'back_home' => 'Volver al inicio',
                'confirmation_email' => 'Se ha enviado un correo de confirmación a su dirección.',
            ]
        ];

        $t = $texts[$currentLocale];
    @endphp

    <x-slot name="title">{{ $t['title'] }}</x-slot>

    <div class="min-h-screen bg-gray-50 py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Success Message -->
            <div class="bg-white rounded-lg shadow-lg p-8 text-center mb-8">
                <!-- Success Icon -->
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $t['thank_you'] }}</h1>
                <p class="text-xl text-gray-600 mb-6">{{ $t['message'] }}</p>

                @if(session('message'))
                <div class="bg-green-50 border border-green-200 rounded-md p-4 mb-6">
                    <p class="text-green-800 font-medium">{{ session('message') }}</p>
                </div>
                @endif

                <p class="text-sm text-gray-500">{{ $t['confirmation_email'] }}</p>

                <!-- Reference Number (if available) -->
                @if(session('reference_number'))
                <div class="mt-6 p-4 bg-gray-50 rounded-md">
                    <p class="text-sm font-medium text-gray-700 mb-1">{{ $t['reference'] }}</p>
                    <p class="text-2xl font-bold text-pink-600">{{ session('reference_number') }}</p>
                </div>
                @endif
            </div>

            <!-- Next Steps -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">{{ $t['next_steps'] }}</h2>

                <div class="space-y-6">
                    <!-- Step 1 -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-pink-100 rounded-full flex items-center justify-center">
                                <span class="text-pink-600 font-bold text-lg">1</span>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $t['step_1'] }}</h3>
                            <p class="text-gray-600">{{ $t['step_1_desc'] }}</p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-pink-100 rounded-full flex items-center justify-center">
                                <span class="text-pink-600 font-bold text-lg">2</span>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $t['step_2'] }}</h3>
                            <p class="text-gray-600">{{ $t['step_2_desc'] }}</p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-pink-100 rounded-full flex items-center justify-center">
                                <span class="text-pink-600 font-bold text-lg">3</span>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $t['step_3'] }}</h3>
                            <p class="text-gray-600">{{ $t['step_3_desc'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">{{ $t['contact_title'] }}</h2>
                <p class="text-gray-600 mb-6">{{ $t['contact_text'] }}</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-pink-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-700">{{ $t['phone'] }}</p>
                            <a href="tel:+41712272727" class="text-pink-600 hover:text-pink-700 font-semibold">+41 71 227 27 27</a>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-pink-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-700">{{ $t['email'] }}</p>
                            <a href="mailto:info@acrevis.ch" class="text-pink-600 hover:text-pink-700 font-semibold">info@acrevis.ch</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back to Home Button -->
            <div class="text-center">
                <a href="{{ route('home', ['locale' => $currentLocale]) }}"
                   class="inline-block px-8 py-3 bg-pink-600 hover:bg-pink-700 text-white font-semibold rounded-md transition-colors">
                    {{ $t['back_home'] }}
                </a>
            </div>

        </div>
    </div>

</x-layouts.app>
