<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();

        $texts = [
            'fr' => [
                'title' => 'Vérification à deux facteurs',
                'subtitle' => 'Sécurité renforcée',
                'code_sent' => 'Un code de vérification a été envoyé à votre adresse e-mail :',
                'enter_code' => 'Code de vérification',
                'code_placeholder' => 'Entrez le code à 6 chiffres',
                'verify' => 'Vérifier',
                'resend' => 'Renvoyer le code',
                'resend_info' => 'Vous n\'avez pas reçu le code?',
                'expires' => 'Ce code expire dans 10 minutes.',
                'security_info' => 'Pour votre sécurité',
                'security_desc' => 'Ne partagez jamais ce code avec qui que ce soit. Notre équipe ne vous demandera jamais ce code par téléphone ou par e-mail.',
                'info_title' => 'Pourquoi cette étape?',
                'info_desc' => 'L\'authentification à deux facteurs protège votre compte en ajoutant une couche de sécurité supplémentaire.',
            ],
            'de' => [
                'title' => 'Zwei-Faktor-Verifizierung',
                'subtitle' => 'Erhöhte Sicherheit',
                'code_sent' => 'Ein Verifizierungscode wurde an Ihre E-Mail-Adresse gesendet:',
                'enter_code' => 'Verifizierungscode',
                'code_placeholder' => 'Geben Sie den 6-stelligen Code ein',
                'verify' => 'Verifizieren',
                'resend' => 'Code erneut senden',
                'resend_info' => 'Code nicht erhalten?',
                'expires' => 'Dieser Code läuft in 10 Minuten ab.',
                'security_info' => 'Für Ihre Sicherheit',
                'security_desc' => 'Teilen Sie diesen Code niemals mit jemandem. Unser Team wird Sie niemals telefonisch oder per E-Mail nach diesem Code fragen.',
                'info_title' => 'Warum dieser Schritt?',
                'info_desc' => 'Die Zwei-Faktor-Authentifizierung schützt Ihr Konto durch eine zusätzliche Sicherheitsebene.',
            ],
            'en' => [
                'title' => 'Two-Factor Verification',
                'subtitle' => 'Enhanced Security',
                'code_sent' => 'A verification code has been sent to your email address:',
                'enter_code' => 'Verification Code',
                'code_placeholder' => 'Enter 6-digit code',
                'verify' => 'Verify',
                'resend' => 'Resend code',
                'resend_info' => 'Didn\'t receive the code?',
                'expires' => 'This code expires in 10 minutes.',
                'security_info' => 'For your security',
                'security_desc' => 'Never share this code with anyone. Our team will never ask for this code by phone or email.',
                'info_title' => 'Why this step?',
                'info_desc' => 'Two-factor authentication protects your account by adding an extra layer of security.',
            ],
            'es' => [
                'title' => 'Verificación de dos factores',
                'subtitle' => 'Seguridad mejorada',
                'code_sent' => 'Se ha enviado un código de verificación a su dirección de correo electrónico:',
                'enter_code' => 'Código de verificación',
                'code_placeholder' => 'Ingrese el código de 6 dígitos',
                'verify' => 'Verificar',
                'resend' => 'Reenviar código',
                'resend_info' => '¿No recibió el código?',
                'expires' => 'Este código caduca en 10 minutos.',
                'security_info' => 'Para su seguridad',
                'security_desc' => 'Nunca comparta este código con nadie. Nuestro equipo nunca le pedirá este código por teléfono o correo electrónico.',
                'info_title' => '¿Por qué este paso?',
                'info_desc' => 'La autenticación de dos factores protege su cuenta al agregar una capa adicional de seguridad.',
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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- 2FA Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold">{{ $t['title'] }}</h1>
                        <p class="text-sm text-gray-600 mt-2">{{ $t['subtitle'] }}</p>
                    </div>

                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 rounded-md p-4">
                            <div class="flex">
                                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div class="ml-3">
                                    <ul class="text-sm text-red-700 list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="mb-6 bg-green-50 border border-green-200 rounded-md p-4">
                            <div class="flex">
                                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="ml-3 text-sm text-green-700">{{ session('status') }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="mb-6 bg-blue-50 border border-blue-200 rounded-md p-4">
                        <div class="flex">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <div class="ml-3">
                                <p class="text-sm text-blue-700">
                                    {{ $t['code_sent'] }} <strong>{{ auth()->user()->email }}</strong>
                                </p>
                                <p class="text-xs text-blue-600 mt-1">{{ $t['expires'] }}</p>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('two-factor.verify') }}" class="space-y-6">
                        @csrf

                        <!-- Code -->
                        <div>
                            <label for="code" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ $t['enter_code'] }}
                            </label>
                            <input type="text"
                                   id="code"
                                   name="code"
                                   maxlength="6"
                                   pattern="[0-9]{6}"
                                   required
                                   autofocus
                                   autocomplete="off"
                                   class="w-full px-4 py-3 text-center text-2xl font-mono tracking-widest border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500 @error('code') border-red-500 @enderror"
                                   placeholder="000000">
                            @error('code')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                                class="w-full bg-pink-600 hover:bg-pink-700 text-white font-semibold py-3 rounded-md transition-colors">
                            {{ $t['verify'] }}
                        </button>
                    </form>

                    <!-- Resend Code -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600 mb-2">{{ $t['resend_info'] }}</p>
                        <form method="POST" action="{{ route('two-factor.resend') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-pink-600 hover:text-pink-700 font-medium text-sm">
                                {{ $t['resend'] }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Info Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-gray-50 rounded-lg p-6">
                    <h2 class="text-lg font-semibold mb-4">{{ $t['info_title'] }}</h2>

                    <div class="space-y-6">
                        <!-- Security Info -->
                        <div class="flex items-start space-x-3">
                            <svg class="w-6 h-6 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <div>
                                <h3 class="font-medium text-gray-900">{{ $t['security_info'] }}</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ $t['info_desc'] }}</p>
                            </div>
                        </div>

                        <!-- Warning -->
                        <div class="mt-6 p-4 bg-yellow-50 rounded border border-yellow-200">
                            <div class="flex">
                                <svg class="w-5 h-5 text-yellow-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <div class="ml-3">
                                    <p class="text-xs text-yellow-800">{{ $t['security_desc'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
