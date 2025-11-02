<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();

        $texts = [
            'fr' => [
                'title' => 'Connexion',
                'email' => 'Adresse e-mail',
                'password' => 'Mot de passe',
                'remember' => 'Se souvenir de moi',
                'login' => 'Se connecter',
                'forgot' => 'Mot de passe oublié?',
                'no_account' => 'Pas encore de compte?',
                'register' => 'Créer un compte',
                'info_title' => 'Informations',
                'secure_title' => 'Connexion sécurisée',
                'secure_desc' => 'Vos données sont protégées avec un cryptage SSL 256 bits',
            ],
            'de' => [
                'title' => 'Anmeldung',
                'email' => 'E-Mail-Adresse',
                'password' => 'Passwort',
                'remember' => 'Angemeldet bleiben',
                'login' => 'Anmelden',
                'forgot' => 'Passwort vergessen?',
                'no_account' => 'Noch kein Konto?',
                'register' => 'Konto erstellen',
                'info_title' => 'Informationen',
                'secure_title' => 'Sichere Verbindung',
                'secure_desc' => 'Ihre Daten werden mit 256-Bit-SSL-Verschlüsselung geschützt',
            ],
            'en' => [
                'title' => 'Login',
                'email' => 'Email address',
                'password' => 'Password',
                'remember' => 'Remember me',
                'login' => 'Log in',
                'forgot' => 'Forgot password?',
                'no_account' => 'No account yet?',
                'register' => 'Create account',
                'info_title' => 'Information',
                'secure_title' => 'Secure connection',
                'secure_desc' => 'Your data is protected with 256-bit SSL encryption',
            ],
            'es' => [
                'title' => 'Iniciar sesión',
                'email' => 'Dirección de correo electrónico',
                'password' => 'Contraseña',
                'remember' => 'Recordarme',
                'login' => 'Iniciar sesión',
                'forgot' => '¿Olvidó su contraseña?',
                'no_account' => '¿Aún no tiene cuenta?',
                'register' => 'Crear cuenta',
                'info_title' => 'Información',
                'secure_title' => 'Conexión segura',
                'secure_desc' => 'Sus datos están protegidos con cifrado SSL de 256 bits',
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
            <!-- Login Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <h1 class="text-2xl font-bold mb-6">{{ $t['title'] }}</h1>

                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 rounded-md p-4">
                            <div class="flex">
                                <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">
                                        {{ $currentLocale === 'fr' ? 'Erreur de connexion' :
                                           ($currentLocale === 'de' ? 'Anmeldefehler' :
                                           ($currentLocale === 'en' ? 'Login error' : 'Error de inicio de sesión')) }}
                                    </h3>
                                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
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

                    <form method="POST" action="{{ route('login', ['locale' => $currentLocale]) }}" class="space-y-6">
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

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ $t['password'] }}
                            </label>
                            <input type="password"
                                   id="password"
                                   name="password"
                                   required
                                   autocomplete="current-password"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500 @error('password') border-red-500 @enderror">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center">
                            <input type="checkbox"
                                   id="remember"
                                   name="remember"
                                   class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded">
                            <label for="remember" class="ml-2 block text-sm text-gray-700">
                                {{ $t['remember'] }}
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                                class="w-full bg-pink-600 hover:bg-pink-700 text-white font-semibold py-3 rounded-md transition-colors">
                            {{ $t['login'] }}
                        </button>

                        <!-- Forgot Password & Register Links -->
                        <div class="flex flex-col sm:flex-row justify-between items-center text-sm space-y-2 sm:space-y-0">
                            <a href="{{ route('password.request', ['locale' => $currentLocale]) }}" class="text-pink-600 hover:text-pink-700 font-medium">
                                {{ $t['forgot'] }}
                            </a>
                            <div class="text-gray-600">
                                {{ $t['no_account'] }}
                                <a href="{{ route('register', ['locale' => $currentLocale]) }}" class="text-pink-600 hover:text-pink-700 font-medium">
                                    {{ $t['register'] }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-gray-50 rounded-lg p-6">
                    <h2 class="text-lg font-semibold mb-4">{{ $t['info_title'] }}</h2>

                    <div class="space-y-6">
                        <!-- Secure Connection -->
                        <div class="flex items-start space-x-3">
                            <svg class="w-6 h-6 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <div>
                                <h3 class="font-medium text-gray-900">{{ $t['secure_title'] }}</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ $t['secure_desc'] }}</p>
                            </div>
                        </div>

                        <!-- Contact Support -->
                        <div class="mt-6 p-4 bg-white rounded border border-gray-200">
                            <h3 class="font-semibold text-sm mb-2">
                                {{ $currentLocale === 'fr' ? 'Besoin d\'aide?' :
                                   ($currentLocale === 'de' ? 'Brauchen Sie Hilfe?' :
                                   ($currentLocale === 'en' ? 'Need help?' : '¿Necesita ayuda?')) }}
                            </h3>
                            <p class="text-xs text-gray-600 mb-3">
                                {{ $currentLocale === 'fr' ? 'Notre service client est disponible du lundi au vendredi de 8h à 17h.' :
                                   ($currentLocale === 'de' ? 'Unser Kundendienst ist von Montag bis Freitag von 8:00 bis 17:00 Uhr verfügbar.' :
                                   ($currentLocale === 'en' ? 'Our customer service is available Monday to Friday from 8am to 5pm.' : 'Nuestro servicio al cliente está disponible de lunes a viernes de 8:00 a 17:00.')) }}
                            </p>
                            <a href="{{ route('contact', ['locale' => $currentLocale]) }}" class="text-pink-600 hover:text-pink-700 text-sm font-medium">
                                {{ $currentLocale === 'fr' ? 'Nous contacter →' :
                                   ($currentLocale === 'de' ? 'Kontaktieren Sie uns →' :
                                   ($currentLocale === 'en' ? 'Contact us →' : 'Contáctenos →')) }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
