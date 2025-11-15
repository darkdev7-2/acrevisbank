<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();

        $texts = [
            'fr' => [
                'title' => 'Mot de passe oublié',
                'subtitle' => 'Entrez votre adresse e-mail et nous vous enverrons un lien pour réinitialiser votre mot de passe',
                'email' => 'Adresse e-mail',
                'send' => 'Envoyer le lien de réinitialisation',
                'back' => 'Retour à la connexion',
            ],
            'de' => [
                'title' => 'Passwort vergessen',
                'subtitle' => 'Geben Sie Ihre E-Mail-Adresse ein und wir senden Ihnen einen Link zum Zurücksetzen Ihres Passworts',
                'email' => 'E-Mail-Adresse',
                'send' => 'Rücksetzungslink senden',
                'back' => 'Zurück zur Anmeldung',
            ],
            'en' => [
                'title' => 'Forgot password',
                'subtitle' => 'Enter your email address and we will send you a link to reset your password',
                'email' => 'Email address',
                'send' => 'Send reset link',
                'back' => 'Back to login',
            ],
            'es' => [
                'title' => 'Contraseña olvidada',
                'subtitle' => 'Ingrese su dirección de correo electrónico y le enviaremos un enlace para restablecer su contraseña',
                'email' => 'Dirección de correo electrónico',
                'send' => 'Enviar enlace de restablecimiento',
                'back' => 'Volver al inicio de sesión',
            ]
        ];

        $t = $texts[$currentLocale];
    @endphp

    <x-slot name="title">{{ $t['title'] }}</x-slot>

    <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex items-center justify-center mb-8">
            <div class="text-center">
                <span class="text-3xl font-bold text-pink-600">acrevis</span>
                <p class="text-sm text-gray-600 mt-1">Meine Bank fürs Leben</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="text-center mb-8">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-pink-100 mb-4">
                    <svg class="h-6 w-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $t['title'] }}</h1>
                <p class="text-gray-600 mt-2 text-sm">{{ $t['subtitle'] }}</p>
            </div>

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

            <form method="POST" action="{{ route('password.email', ['locale' => $currentLocale]) }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $t['email'] }}
                    </label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           autocomplete="email"
                           class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        class="w-full bg-pink-600 hover:bg-pink-700 text-white font-semibold py-3 rounded-md transition-colors">
                    {{ $t['send'] }}
                </button>

                <!-- Back to Login -->
                <div class="text-center">
                    <a href="{{ route('login', ['locale' => $currentLocale]) }}" class="text-sm text-pink-600 hover:text-pink-700 font-medium">
                        ← {{ $t['back'] }}
                    </a>
                </div>
            </form>
        </div>

        <!-- Help -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-600">
                {{ $currentLocale === 'fr' ? 'Besoin d\'aide?' :
                   ($currentLocale === 'de' ? 'Brauchen Sie Hilfe?' :
                   ($currentLocale === 'en' ? 'Need help?' : '¿Necesita ayuda?')) }}
                <a href="{{ route('contact', ['locale' => $currentLocale]) }}" class="text-pink-600 hover:text-pink-700 font-medium">
                    {{ $currentLocale === 'fr' ? 'Contactez-nous' :
                       ($currentLocale === 'de' ? 'Kontaktieren Sie uns' :
                       ($currentLocale === 'en' ? 'Contact us' : 'Contáctenos')) }}
                </a>
            </p>
        </div>
    </div>

</x-layouts.app>
