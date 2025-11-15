<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();

        $texts = [
            'fr' => [
                'title' => 'Créer un compte',
                'subtitle' => 'Rejoignez Acrevis Bank aujourd\'hui',
                'first_name' => 'Prénom',
                'last_name' => 'Nom',
                'email' => 'Adresse e-mail',
                'password' => 'Mot de passe',
                'password_confirmation' => 'Confirmer le mot de passe',
                'terms' => 'J\'accepte les',
                'terms_link' => 'conditions d\'utilisation',
                'and' => 'et la',
                'privacy_link' => 'politique de confidentialité',
                'register' => 'Créer mon compte',
                'already' => 'Vous avez déjà un compte?',
                'login' => 'Se connecter',
                'password_hint' => 'Minimum 8 caractères',
            ],
            'de' => [
                'title' => 'Konto erstellen',
                'subtitle' => 'Treten Sie noch heute der Acrevis Bank bei',
                'first_name' => 'Vorname',
                'last_name' => 'Nachname',
                'email' => 'E-Mail-Adresse',
                'password' => 'Passwort',
                'password_confirmation' => 'Passwort bestätigen',
                'terms' => 'Ich akzeptiere die',
                'terms_link' => 'Nutzungsbedingungen',
                'and' => 'und die',
                'privacy_link' => 'Datenschutzrichtlinie',
                'register' => 'Konto erstellen',
                'already' => 'Haben Sie bereits ein Konto?',
                'login' => 'Anmelden',
                'password_hint' => 'Mindestens 8 Zeichen',
            ],
            'en' => [
                'title' => 'Create an account',
                'subtitle' => 'Join Acrevis Bank today',
                'first_name' => 'First name',
                'last_name' => 'Last name',
                'email' => 'Email address',
                'password' => 'Password',
                'password_confirmation' => 'Confirm password',
                'terms' => 'I accept the',
                'terms_link' => 'terms of service',
                'and' => 'and the',
                'privacy_link' => 'privacy policy',
                'register' => 'Create my account',
                'already' => 'Already have an account?',
                'login' => 'Log in',
                'password_hint' => 'Minimum 8 characters',
            ],
            'es' => [
                'title' => 'Crear una cuenta',
                'subtitle' => 'Únase a Acrevis Bank hoy',
                'first_name' => 'Nombre',
                'last_name' => 'Apellido',
                'email' => 'Dirección de correo electrónico',
                'password' => 'Contraseña',
                'password_confirmation' => 'Confirmar contraseña',
                'terms' => 'Acepto los',
                'terms_link' => 'términos de servicio',
                'and' => 'y la',
                'privacy_link' => 'política de privacidad',
                'register' => 'Crear mi cuenta',
                'already' => '¿Ya tiene una cuenta?',
                'login' => 'Iniciar sesión',
                'password_hint' => 'Mínimo 8 caracteres',
            ]
        ];

        $t = $texts[$currentLocale];
    @endphp

    <x-slot name="title">{{ $t['title'] }}</x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex items-center justify-center mb-8">
            <div class="text-center">
                <span class="text-3xl font-bold text-pink-600">acrevis</span>
                <p class="text-sm text-gray-600 mt-1">Meine Bank fürs Leben</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">{{ $t['title'] }}</h1>
                <p class="text-gray-600 mt-2">{{ $t['subtitle'] }}</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-md p-4">
                    <div class="flex">
                        <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">
                                {{ $currentLocale === 'fr' ? 'Erreur lors de l\'inscription' :
                                   ($currentLocale === 'de' ? 'Fehler bei der Registrierung' :
                                   ($currentLocale === 'en' ? 'Registration error' : 'Error de registro')) }}
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

            <form method="POST" action="{{ route('register', ['locale' => $currentLocale]) }}" class="space-y-6">
                @csrf

                <!-- Name Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- First Name -->
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $t['first_name'] }}
                        </label>
                        <input type="text"
                               id="first_name"
                               name="name"
                               value="{{ old('name') }}"
                               required
                               autofocus
                               autocomplete="given-name"
                               class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500 @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

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
                           autocomplete="new-password"
                           class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500 @error('password') border-red-500 @enderror">
                    <p class="mt-1 text-sm text-gray-500">{{ $t['password_hint'] }}</p>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Confirmation -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $t['password_confirmation'] }}
                    </label>
                    <input type="password"
                           id="password_confirmation"
                           name="password_confirmation"
                           required
                           autocomplete="new-password"
                           class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                </div>

                <!-- Terms & Privacy -->
                <div class="flex items-start">
                    <input type="checkbox"
                           id="terms"
                           name="terms"
                           required
                           class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded mt-1">
                    <label for="terms" class="ml-2 block text-sm text-gray-700">
                        {{ $t['terms'] }}
                        <a href="{{ route('legal.terms', ['locale' => $currentLocale]) }}" target="_blank" class="text-pink-600 hover:text-pink-700 font-medium">
                            {{ $t['terms_link'] }}
                        </a>
                        {{ $t['and'] }}
                        <a href="{{ route('legal.privacy', ['locale' => $currentLocale]) }}" target="_blank" class="text-pink-600 hover:text-pink-700 font-medium">
                            {{ $t['privacy_link'] }}
                        </a>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        class="w-full bg-pink-600 hover:bg-pink-700 text-white font-semibold py-3 rounded-md transition-colors">
                    {{ $t['register'] }}
                </button>

                <!-- Login Link -->
                <div class="text-center text-sm text-gray-600">
                    {{ $t['already'] }}
                    <a href="{{ route('login', ['locale' => $currentLocale]) }}" class="text-pink-600 hover:text-pink-700 font-medium">
                        {{ $t['login'] }}
                    </a>
                </div>
            </form>
        </div>

        <!-- Security Notice -->
        <div class="mt-8 text-center text-sm text-gray-500">
            <svg class="w-5 h-5 inline-block mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
            {{ $currentLocale === 'fr' ? 'Vos données sont protégées avec un cryptage SSL 256 bits' :
               ($currentLocale === 'de' ? 'Ihre Daten werden mit 256-Bit-SSL-Verschlüsselung geschützt' :
               ($currentLocale === 'en' ? 'Your data is protected with 256-bit SSL encryption' : 'Sus datos están protegidos con cifrado SSL de 256 bits')) }}
        </div>
    </div>

</x-layouts.app>
