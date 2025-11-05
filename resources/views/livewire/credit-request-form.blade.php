<div>
    @php
        $currentLocale = app()->getLocale();

        $texts = [
            'fr' => [
                'title' => 'Demande de crédit',
                'subtitle' => 'Complétez votre demande en 3 étapes simples',
                'step1' => 'Informations personnelles',
                'step2' => 'Coordonnées',
                'step3' => 'Détails du crédit',
                'progress' => 'Étape :current sur :total',
                'previous' => 'Précédent',
                'next' => 'Suivant',
                'submit' => 'Soumettre la demande',
                // Step 1 fields
                'first_name' => 'Prénom',
                'last_name' => 'Nom',
                'gender' => 'Genre',
                'gender_m' => 'Homme',
                'gender_f' => 'Femme',
                'gender_other' => 'Autre',
                'birth_date' => 'Date de naissance',
                'nationality' => 'Nationalité',
                'marital_status' => 'Statut matrimonial',
                'marital_single' => 'Célibataire',
                'marital_married' => 'Marié(e)',
                'marital_divorced' => 'Divorcé(e)',
                'marital_widowed' => 'Veuf/Veuve',
                'marital_partnership' => 'Partenariat',
                'profession' => 'Profession',
                // Step 2 fields
                'country' => 'Pays',
                'city' => 'Ville',
                'address' => 'Adresse',
                'email' => 'Email',
                'phone' => 'Téléphone',
                'whatsapp' => 'WhatsApp (optionnel)',
                // Step 3 fields
                'amount' => 'Montant demandé',
                'currency' => 'Devise',
                'duration_months' => 'Durée (en mois)',
                'purpose' => 'Objet du crédit',
                'has_other_credit' => 'Avez-vous d\'autres crédits en cours?',
                'yes' => 'Oui',
                'no' => 'Non',
                'other_credit_details' => 'Détails des autres crédits',
                'attachment' => 'Pièces justificatives (PDF, JPG, PNG - max 5MB)',
                'choose_file' => 'Choisir un fichier',
            ],
            'de' => [
                'title' => 'Kreditantrag',
                'subtitle' => 'Vervollständigen Sie Ihren Antrag in 3 einfachen Schritten',
                'step1' => 'Persönliche Informationen',
                'step2' => 'Kontaktdaten',
                'step3' => 'Kreditdetails',
                'progress' => 'Schritt :current von :total',
                'previous' => 'Zurück',
                'next' => 'Weiter',
                'submit' => 'Antrag einreichen',
                'first_name' => 'Vorname',
                'last_name' => 'Nachname',
                'gender' => 'Geschlecht',
                'gender_m' => 'Mann',
                'gender_f' => 'Frau',
                'gender_other' => 'Andere',
                'birth_date' => 'Geburtsdatum',
                'nationality' => 'Nationalität',
                'marital_status' => 'Familienstand',
                'marital_single' => 'Ledig',
                'marital_married' => 'Verheiratet',
                'marital_divorced' => 'Geschieden',
                'marital_widowed' => 'Verwitwet',
                'marital_partnership' => 'Partnerschaft',
                'profession' => 'Beruf',
                'country' => 'Land',
                'city' => 'Stadt',
                'address' => 'Adresse',
                'email' => 'E-Mail',
                'phone' => 'Telefon',
                'whatsapp' => 'WhatsApp (optional)',
                'amount' => 'Gewünschter Betrag',
                'currency' => 'Währung',
                'duration_months' => 'Laufzeit (in Monaten)',
                'purpose' => 'Verwendungszweck',
                'has_other_credit' => 'Haben Sie weitere laufende Kredite?',
                'yes' => 'Ja',
                'no' => 'Nein',
                'other_credit_details' => 'Details zu anderen Krediten',
                'attachment' => 'Belege (PDF, JPG, PNG - max 5MB)',
                'choose_file' => 'Datei auswählen',
            ],
            'en' => [
                'title' => 'Credit Application',
                'subtitle' => 'Complete your application in 3 simple steps',
                'step1' => 'Personal Information',
                'step2' => 'Contact Details',
                'step3' => 'Credit Details',
                'progress' => 'Step :current of :total',
                'previous' => 'Previous',
                'next' => 'Next',
                'submit' => 'Submit Application',
                'first_name' => 'First Name',
                'last_name' => 'Last Name',
                'gender' => 'Gender',
                'gender_m' => 'Male',
                'gender_f' => 'Female',
                'gender_other' => 'Other',
                'birth_date' => 'Date of Birth',
                'nationality' => 'Nationality',
                'marital_status' => 'Marital Status',
                'marital_single' => 'Single',
                'marital_married' => 'Married',
                'marital_divorced' => 'Divorced',
                'marital_widowed' => 'Widowed',
                'marital_partnership' => 'Partnership',
                'profession' => 'Profession',
                'country' => 'Country',
                'city' => 'City',
                'address' => 'Address',
                'email' => 'Email',
                'phone' => 'Phone',
                'whatsapp' => 'WhatsApp (optional)',
                'amount' => 'Requested Amount',
                'currency' => 'Currency',
                'duration_months' => 'Duration (in months)',
                'purpose' => 'Purpose of Credit',
                'has_other_credit' => 'Do you have other ongoing credits?',
                'yes' => 'Yes',
                'no' => 'No',
                'other_credit_details' => 'Details of other credits',
                'attachment' => 'Supporting Documents (PDF, JPG, PNG - max 5MB)',
                'choose_file' => 'Choose file',
            ],
            'es' => [
                'title' => 'Solicitud de Crédito',
                'subtitle' => 'Complete su solicitud en 3 sencillos pasos',
                'step1' => 'Información Personal',
                'step2' => 'Datos de Contacto',
                'step3' => 'Detalles del Crédito',
                'progress' => 'Paso :current de :total',
                'previous' => 'Anterior',
                'next' => 'Siguiente',
                'submit' => 'Enviar Solicitud',
                'first_name' => 'Nombre',
                'last_name' => 'Apellido',
                'gender' => 'Género',
                'gender_m' => 'Masculino',
                'gender_f' => 'Femenino',
                'gender_other' => 'Otro',
                'birth_date' => 'Fecha de Nacimiento',
                'nationality' => 'Nacionalidad',
                'marital_status' => 'Estado Civil',
                'marital_single' => 'Soltero/a',
                'marital_married' => 'Casado/a',
                'marital_divorced' => 'Divorciado/a',
                'marital_widowed' => 'Viudo/a',
                'marital_partnership' => 'Pareja de Hecho',
                'profession' => 'Profesión',
                'country' => 'País',
                'city' => 'Ciudad',
                'address' => 'Dirección',
                'email' => 'Correo Electrónico',
                'phone' => 'Teléfono',
                'whatsapp' => 'WhatsApp (opcional)',
                'amount' => 'Monto Solicitado',
                'currency' => 'Moneda',
                'duration_months' => 'Duración (en meses)',
                'purpose' => 'Propósito del Crédito',
                'has_other_credit' => '¿Tiene otros créditos en curso?',
                'yes' => 'Sí',
                'no' => 'No',
                'other_credit_details' => 'Detalles de otros créditos',
                'attachment' => 'Documentos Adjuntos (PDF, JPG, PNG - máx 5MB)',
                'choose_file' => 'Elegir archivo',
            ]
        ];

        $t = $texts[$currentLocale];
    @endphp

    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $t['title'] }}</h1>
            <p class="text-gray-600">{{ $t['subtitle'] }}</p>
        </div>

        <!-- Progress Bar -->
        <div class="mb-8">
            <div class="flex justify-between items-center mb-4">
                <span class="text-sm font-medium text-gray-700">
                    {{ str_replace([':current', ':total'], [$currentStep, $totalSteps], $t['progress']) }}
                </span>
                <span class="text-sm text-gray-600">{{ round(($currentStep / $totalSteps) * 100) }}%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-pink-600 h-2.5 rounded-full transition-all duration-300"
                     style="width: {{ ($currentStep / $totalSteps) * 100 }}%"></div>
            </div>
        </div>

        <!-- Step Indicators -->
        <div class="flex justify-between mb-8">
            <div class="flex flex-col items-center flex-1">
                <div class="w-10 h-10 rounded-full flex items-center justify-center font-semibold
                    {{ $currentStep >= 1 ? 'bg-pink-600 text-white' : 'bg-gray-200 text-gray-600' }}">
                    1
                </div>
                <span class="mt-2 text-sm {{ $currentStep >= 1 ? 'text-pink-600 font-medium' : 'text-gray-500' }}">
                    {{ $t['step1'] }}
                </span>
            </div>
            <div class="flex flex-col items-center flex-1">
                <div class="w-10 h-10 rounded-full flex items-center justify-center font-semibold
                    {{ $currentStep >= 2 ? 'bg-pink-600 text-white' : 'bg-gray-200 text-gray-600' }}">
                    2
                </div>
                <span class="mt-2 text-sm {{ $currentStep >= 2 ? 'text-pink-600 font-medium' : 'text-gray-500' }}">
                    {{ $t['step2'] }}
                </span>
            </div>
            <div class="flex flex-col items-center flex-1">
                <div class="w-10 h-10 rounded-full flex items-center justify-center font-semibold
                    {{ $currentStep >= 3 ? 'bg-pink-600 text-white' : 'bg-gray-200 text-gray-600' }}">
                    3
                </div>
                <span class="mt-2 text-sm {{ $currentStep >= 3 ? 'text-pink-600 font-medium' : 'text-gray-500' }}">
                    {{ $t['step3'] }}
                </span>
            </div>
        </div>

        <!-- Form -->
        <form wire:submit.prevent="nextStep" class="bg-white rounded-lg shadow-lg p-8">

            <!-- Loading Indicator -->
            <div wire:loading class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white rounded-lg p-6 flex items-center space-x-4">
                    <svg class="animate-spin h-8 w-8 text-pink-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="text-gray-700 font-medium">Traitement en cours...</span>
                </div>
            </div>

            <!-- Step 1: Personal Information -->
            @if($currentStep == 1)
            <div class="space-y-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ $t['step1'] }}</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- First Name -->
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $t['first_name'] }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="first_name"
                               wire:model="first_name"
                               class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500
                                      @error('first_name') border-red-500 @enderror">
                        @error('first_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $t['last_name'] }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="last_name"
                               wire:model="last_name"
                               class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500
                                      @error('last_name') border-red-500 @enderror">
                        @error('last_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Gender -->
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $t['gender'] }}
                        </label>
                        <select id="gender"
                                wire:model="gender"
                                class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                            <option value="">{{ $t['gender'] }}</option>
                            <option value="M">{{ $t['gender_m'] }}</option>
                            <option value="F">{{ $t['gender_f'] }}</option>
                            <option value="Other">{{ $t['gender_other'] }}</option>
                        </select>
                    </div>

                    <!-- Birth Date -->
                    <div>
                        <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $t['birth_date'] }}
                        </label>
                        <input type="date"
                               id="birth_date"
                               wire:model="birth_date"
                               class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nationality -->
                    <div>
                        <label for="nationality" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $t['nationality'] }}
                        </label>
                        <input type="text"
                               id="nationality"
                               wire:model="nationality"
                               class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                    </div>

                    <!-- Marital Status -->
                    <div>
                        <label for="marital_status" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $t['marital_status'] }}
                        </label>
                        <select id="marital_status"
                                wire:model="marital_status"
                                class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                            <option value="">{{ $t['marital_status'] }}</option>
                            <option value="single">{{ $t['marital_single'] }}</option>
                            <option value="married">{{ $t['marital_married'] }}</option>
                            <option value="divorced">{{ $t['marital_divorced'] }}</option>
                            <option value="widowed">{{ $t['marital_widowed'] }}</option>
                            <option value="partnership">{{ $t['marital_partnership'] }}</option>
                        </select>
                    </div>
                </div>

                <!-- Profession -->
                <div>
                    <label for="profession" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $t['profession'] }}
                    </label>
                    <input type="text"
                           id="profession"
                           wire:model="profession"
                           class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                </div>
            </div>
            @endif

            <!-- Step 2: Contact Information -->
            @if($currentStep == 2)
            <div class="space-y-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ $t['step2'] }}</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Country -->
                    <div>
                        <label for="country" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $t['country'] }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="country"
                               wire:model="country"
                               class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500
                                      @error('country') border-red-500 @enderror">
                        @error('country') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- City -->
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $t['city'] }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="city"
                               wire:model="city"
                               class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500
                                      @error('city') border-red-500 @enderror">
                        @error('city') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Address -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $t['address'] }} <span class="text-red-500">*</span>
                    </label>
                    <textarea id="address"
                              wire:model="address"
                              rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500
                                     @error('address') border-red-500 @enderror"></textarea>
                    @error('address') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $t['email'] }} <span class="text-red-500">*</span>
                    </label>
                    <input type="email"
                           id="email"
                           wire:model="email"
                           class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500
                                  @error('email') border-red-500 @enderror">
                    @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $t['phone'] }} <span class="text-red-500">*</span>
                        </label>
                        <input type="tel"
                               id="phone"
                               wire:model="phone"
                               class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500
                                      @error('phone') border-red-500 @enderror">
                        @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- WhatsApp -->
                    <div>
                        <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $t['whatsapp'] }}
                        </label>
                        <input type="tel"
                               id="whatsapp"
                               wire:model="whatsapp"
                               class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                    </div>
                </div>
            </div>
            @endif

            <!-- Step 3: Credit Details -->
            @if($currentStep == 3)
            <div class="space-y-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ $t['step3'] }}</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Amount -->
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $t['amount'] }} <span class="text-red-500">*</span>
                        </label>
                        <input type="number"
                               id="amount"
                               wire:model="amount"
                               min="1000"
                               max="1000000"
                               step="1000"
                               class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500
                                      @error('amount') border-red-500 @enderror">
                        @error('amount') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Currency -->
                    <div>
                        <label for="currency" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $t['currency'] }} <span class="text-red-500">*</span>
                        </label>
                        <select id="currency"
                                wire:model="currency"
                                class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500
                                       @error('currency') border-red-500 @enderror">
                            <option value="CHF">CHF - Franc Suisse</option>
                            <option value="EUR">EUR - Euro</option>
                            <option value="USD">USD - Dollar</option>
                        </select>
                        @error('currency') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Duration -->
                <div>
                    <label for="duration_months" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $t['duration_months'] }} <span class="text-red-500">*</span>
                    </label>
                    <input type="number"
                           id="duration_months"
                           wire:model="duration_months"
                           min="12"
                           max="360"
                           step="12"
                           class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500
                                  @error('duration_months') border-red-500 @enderror">
                    @error('duration_months') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Purpose -->
                <div>
                    <label for="purpose" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $t['purpose'] }} <span class="text-red-500">*</span>
                    </label>
                    <textarea id="purpose"
                              wire:model="purpose"
                              rows="4"
                              maxlength="1000"
                              class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500
                                     @error('purpose') border-red-500 @enderror"></textarea>
                    @error('purpose') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <!-- Has Other Credit -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $t['has_other_credit'] }}
                    </label>
                    <div class="flex space-x-4">
                        <label class="flex items-center">
                            <input type="radio"
                                   wire:model="has_other_credit"
                                   value="1"
                                   class="text-pink-600 focus:ring-pink-500">
                            <span class="ml-2 text-sm text-gray-700">{{ $t['yes'] }}</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio"
                                   wire:model="has_other_credit"
                                   value="0"
                                   class="text-pink-600 focus:ring-pink-500">
                            <span class="ml-2 text-sm text-gray-700">{{ $t['no'] }}</span>
                        </label>
                    </div>
                </div>

                <!-- Other Credit Details (shown only if has_other_credit is true) -->
                @if($has_other_credit)
                <div>
                    <label for="other_credit_details" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $t['other_credit_details'] }}
                    </label>
                    <textarea id="other_credit_details"
                              wire:model="other_credit_details"
                              rows="3"
                              maxlength="500"
                              class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500"></textarea>
                </div>
                @endif

                <!-- Attachment -->
                <div>
                    <label for="attachment" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $t['attachment'] }}
                    </label>
                    <input type="file"
                           id="attachment"
                           wire:model="attachment"
                           accept=".pdf,.jpg,.jpeg,.png"
                           class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                    @error('attachment') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror

                    <!-- File Preview -->
                    @if($attachment)
                    <div class="mt-2 text-sm text-gray-600">
                        <svg class="inline w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        {{ $attachment->getClientOriginalName() }}
                        ({{ number_format($attachment->getSize() / 1024, 2) }} KB)
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Navigation Buttons -->
            <div class="flex justify-between mt-8 pt-6 border-t border-gray-200">
                @if($currentStep > 1)
                <button type="button"
                        wire:click="previousStep"
                        wire:loading.attr="disabled"
                        class="px-6 py-3 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 font-medium transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    {{ $t['previous'] }}
                </button>
                @else
                <div></div>
                @endif

                @if($currentStep < $totalSteps)
                <button type="button"
                        wire:click="nextStep"
                        wire:loading.attr="disabled"
                        class="px-6 py-3 bg-pink-600 hover:bg-pink-700 text-white rounded-md font-medium transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center">
                    <span wire:loading.remove>{{ $t['next'] }}</span>
                    <span wire:loading>Vérification...</span>
                    <svg class="w-4 h-4 inline ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" wire:loading.remove>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
                @else
                <button type="button"
                        wire:click="submit"
                        wire:loading.attr="disabled"
                        class="px-8 py-3 bg-pink-600 hover:bg-pink-700 text-white rounded-md font-semibold transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" wire:loading.remove>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span wire:loading.remove>{{ $t['submit'] }}</span>
                    <span wire:loading>Envoi en cours...</span>
                </button>
                @endif
            </div>

        </form>
    </div>
</div>