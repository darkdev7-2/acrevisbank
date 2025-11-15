<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();

        $texts = [
            'fr' => [
                'title' => 'Compte temporairement verrouillé',
                'subtitle' => 'Trop de tentatives échouées',
                'locked_message' => 'Votre compte a été temporairement verrouillé pour des raisons de sécurité en raison de trop nombreuses tentatives de vérification échouées.',
                'time_remaining' => 'Temps restant avant déverrouillage :',
                'minutes' => 'minutes',
                'what_to_do' => 'Que faire maintenant?',
                'wait' => 'Attendez la fin du verrouillage',
                'wait_desc' => 'Votre compte sera automatiquement déverrouillé une fois le délai écoulé.',
                'contact' => 'Contactez le support',
                'contact_desc' => 'Si vous pensez qu\'il s\'agit d\'une erreur ou si vous avez besoin d\'aide immédiate, notre équipe de support est là pour vous aider.',
                'contact_button' => 'Contacter le support',
                'security_tip' => 'Conseil de sécurité',
                'security_tip_desc' => 'Assurez-vous que vous êtes le seul à avoir accès à votre adresse e-mail. Si vous soupçonnez une activité suspecte, changez immédiatement votre mot de passe.',
            ],
            'de' => [
                'title' => 'Konto vorübergehend gesperrt',
                'subtitle' => 'Zu viele fehlgeschlagene Versuche',
                'locked_message' => 'Ihr Konto wurde aus Sicherheitsgründen vorübergehend gesperrt, da zu viele fehlgeschlagene Verifizierungsversuche unternommen wurden.',
                'time_remaining' => 'Verbleibende Zeit bis zur Entsperrung:',
                'minutes' => 'Minuten',
                'what_to_do' => 'Was nun?',
                'wait' => 'Warten Sie auf das Ende der Sperrung',
                'wait_desc' => 'Ihr Konto wird automatisch entsperrt, sobald die Frist abgelaufen ist.',
                'contact' => 'Support kontaktieren',
                'contact_desc' => 'Wenn Sie glauben, dass dies ein Fehler ist oder sofortige Hilfe benötigen, steht Ihnen unser Support-Team zur Verfügung.',
                'contact_button' => 'Support kontaktieren',
                'security_tip' => 'Sicherheitstipp',
                'security_tip_desc' => 'Stellen Sie sicher, dass nur Sie Zugriff auf Ihre E-Mail-Adresse haben. Wenn Sie verdächtige Aktivitäten vermuten, ändern Sie sofort Ihr Passwort.',
            ],
            'en' => [
                'title' => 'Account Temporarily Locked',
                'subtitle' => 'Too many failed attempts',
                'locked_message' => 'Your account has been temporarily locked for security reasons due to too many failed verification attempts.',
                'time_remaining' => 'Time remaining until unlock:',
                'minutes' => 'minutes',
                'what_to_do' => 'What to do now?',
                'wait' => 'Wait for the lockout to end',
                'wait_desc' => 'Your account will be automatically unlocked once the time has elapsed.',
                'contact' => 'Contact support',
                'contact_desc' => 'If you believe this is an error or need immediate assistance, our support team is here to help.',
                'contact_button' => 'Contact support',
                'security_tip' => 'Security tip',
                'security_tip_desc' => 'Make sure you are the only one with access to your email address. If you suspect suspicious activity, change your password immediately.',
            ],
            'es' => [
                'title' => 'Cuenta temporalmente bloqueada',
                'subtitle' => 'Demasiados intentos fallidos',
                'locked_message' => 'Su cuenta ha sido bloqueada temporalmente por razones de seguridad debido a demasiados intentos de verificación fallidos.',
                'time_remaining' => 'Tiempo restante hasta el desbloqueo:',
                'minutes' => 'minutos',
                'what_to_do' => '¿Qué hacer ahora?',
                'wait' => 'Espere a que termine el bloqueo',
                'wait_desc' => 'Su cuenta se desbloqueará automáticamente una vez transcurrido el tiempo.',
                'contact' => 'Contactar al soporte',
                'contact_desc' => 'Si cree que esto es un error o necesita ayuda inmediata, nuestro equipo de soporte está aquí para ayudarlo.',
                'contact_button' => 'Contactar al soporte',
                'security_tip' => 'Consejo de seguridad',
                'security_tip_desc' => 'Asegúrese de ser el único con acceso a su dirección de correo electrónico. Si sospecha actividad sospechosa, cambie su contraseña de inmediato.',
            ]
        ];

        $t = $texts[$currentLocale];
    @endphp

    <x-slot name="title">{{ $t['title'] }}</x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex items-center justify-center mb-8">
            <div class="text-center">
                <span class="text-3xl font-bold text-pink-600">acrevis</span>
                <p class="text-sm text-gray-600 mt-1">Meine Bank fürs Leben</p>
            </div>
        </div>

        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <!-- Lock Icon -->
                <div class="flex justify-center mb-6">
                    <div class="bg-red-100 rounded-full p-4">
                        <svg class="w-12 h-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                </div>

                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $t['title'] }}</h1>
                    <p class="text-sm text-gray-600">{{ $t['subtitle'] }}</p>
                </div>

                <!-- Lockout Message -->
                <div class="mb-6 bg-red-50 border border-red-200 rounded-md p-4">
                    <div class="flex">
                        <svg class="w-5 h-5 text-red-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">{{ $t['locked_message'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Timer -->
                <div class="mb-8 text-center">
                    <p class="text-sm text-gray-600 mb-2">{{ $t['time_remaining'] }}</p>
                    <div class="bg-gray-100 rounded-lg p-4">
                        <p class="text-4xl font-bold text-pink-600">{{ $remainingTime }}</p>
                        <p class="text-sm text-gray-600 mt-1">{{ $t['minutes'] }}</p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="space-y-6">
                    <h2 class="text-lg font-semibold text-gray-900">{{ $t['what_to_do'] }}</h2>

                    <!-- Wait Option -->
                    <div class="flex items-start space-x-3 p-4 bg-gray-50 rounded-lg">
                        <svg class="w-6 h-6 text-gray-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <h3 class="font-medium text-gray-900">{{ $t['wait'] }}</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ $t['wait_desc'] }}</p>
                        </div>
                    </div>

                    <!-- Contact Support Option -->
                    <div class="flex items-start space-x-3 p-4 bg-gray-50 rounded-lg">
                        <svg class="w-6 h-6 text-gray-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        <div class="flex-1">
                            <h3 class="font-medium text-gray-900">{{ $t['contact'] }}</h3>
                            <p class="text-sm text-gray-600 mt-1 mb-3">{{ $t['contact_desc'] }}</p>
                            <a href="{{ route('contact', ['locale' => $currentLocale]) }}"
                               class="inline-flex items-center px-4 py-2 bg-pink-600 hover:bg-pink-700 text-white text-sm font-medium rounded-md transition-colors">
                                {{ $t['contact_button'] }}
                            </a>
                        </div>
                    </div>

                    <!-- Security Tip -->
                    <div class="mt-6 p-4 bg-yellow-50 rounded border border-yellow-200">
                        <div class="flex">
                            <svg class="w-5 h-5 text-yellow-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="ml-3">
                                <h4 class="text-sm font-medium text-yellow-800">{{ $t['security_tip'] }}</h4>
                                <p class="text-xs text-yellow-700 mt-1">{{ $t['security_tip_desc'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
