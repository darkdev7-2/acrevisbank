<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();

        $texts = [
            'fr' => [
                'title' => 'Réinitialiser le mot de passe',
                'subtitle' => 'Entrez votre nouveau mot de passe',
                'email' => 'Adresse e-mail',
                'password' => 'Nouveau mot de passe',
                'password_confirmation' => 'Confirmer le mot de passe',
                'reset' => 'Réinitialiser le mot de passe',
                'password_hint' => 'Minimum 8 caractères',
            ],
            'de' => [
                'title' => 'Passwort zurücksetzen',
                'subtitle' => 'Geben Sie Ihr neues Passwort ein',
                'email' => 'E-Mail-Adresse',
                'password' => 'Neues Passwort',
                'password_confirmation' => 'Passwort bestätigen',
                'reset' => 'Passwort zurücksetzen',
                'password_hint' => 'Mindestens 8 Zeichen',
            ],
            'en' => [
                'title' => 'Reset password',
                'subtitle' => 'Enter your new password',
                'email' => 'Email address',
                'password' => 'New password',
                'password_confirmation' => 'Confirm password',
                'reset' => 'Reset password',
                'password_hint' => 'Minimum 8 characters',
            ],
            'es' => [
                'title' => 'Restablecer contraseña',
                'subtitle' => 'Ingrese su nueva contraseña',
                'email' => 'Dirección de correo electrónico',
                'password' => 'Nueva contraseña',
                'password_confirmation' => 'Confirmar contraseña',
                'reset' => 'Restablecer contraseña',
                'password_hint' => 'Mínimo 8 caracteres',
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

            <form method="POST" action="{{ route('password.update', ['locale' => $currentLocale]) }}" class="space-y-6">
                @csrf

                <!-- Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $t['email'] }}
                    </label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email', $request->email) }}"
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

                <!-- Submit Button -->
                <button type="submit"
                        class="w-full bg-pink-600 hover:bg-pink-700 text-white font-semibold py-3 rounded-md transition-colors">
                    {{ $t['reset'] }}
                </button>
            </form>
        </div>
    </div>

</x-layouts.app>
