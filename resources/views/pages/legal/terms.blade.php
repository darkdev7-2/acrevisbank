<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();
        $translations = [
            'fr' => [
                'title' => 'Conditions Générales',
                'subtitle' => 'Conditions d\'utilisation de nos services',
                'updated' => 'Dernière mise à jour : 1er novembre 2025',
            ],
            'de' => [
                'title' => 'Allgemeine Geschäftsbedingungen',
                'subtitle' => 'Nutzungsbedingungen unserer Dienstleistungen',
                'updated' => 'Letzte Aktualisierung: 1. November 2025',
            ],
            'en' => [
                'title' => 'Terms and Conditions',
                'subtitle' => 'Terms of use for our services',
                'updated' => 'Last updated: November 1, 2025',
            ],
            'es' => [
                'title' => 'Términos y Condiciones',
                'subtitle' => 'Condiciones de uso de nuestros servicios',
                'updated' => 'Última actualización: 1 de noviembre de 2025',
            ],
        ];
        $t = $translations[$currentLocale];
    @endphp

    <x-slot name="title">{{ $t['title'] }}</x-slot>

    <!-- Hero -->
    <div class="bg-gradient-to-r from-pink-600 to-pink-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $t['title'] }}</h1>
            <p class="text-xl text-pink-100">{{ $t['subtitle'] }}</p>
            <p class="text-sm text-pink-200 mt-4">{{ $t['updated'] }}</p>
        </div>
    </div>

    <!-- Content -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md p-8 prose max-w-none">
                @if($currentLocale === 'fr')
                    <h2>1. Acceptation des conditions</h2>
                    <p>En utilisant les services d'Acrevis Bank AG, vous acceptez d'être lié par ces conditions générales. Si vous n'acceptez pas ces conditions, veuillez ne pas utiliser nos services.</p>

                    <h2>2. Services bancaires</h2>
                    <p>Acrevis Bank AG propose une gamme complète de services bancaires incluant :</p>
                    <ul>
                        <li>Comptes courants et d'épargne</li>
                        <li>Crédits et hypothèques</li>
                        <li>Placements et gestion de fortune</li>
                        <li>Services de prévoyance</li>
                        <li>E-banking et mobile banking</li>
                    </ul>

                    <h2>3. Ouverture de compte</h2>
                    <p>Pour ouvrir un compte, vous devez :</p>
                    <ul>
                        <li>Être majeur (18 ans minimum)</li>
                        <li>Fournir une pièce d'identité valide</li>
                        <li>Justifier de votre domicile</li>
                        <li>Respecter les obligations de lutte contre le blanchiment d'argent</li>
                    </ul>

                    <h2>4. Sécurité et confidentialité</h2>
                    <p>Vous êtes responsable de la confidentialité de vos codes d'accès. En cas de perte ou de vol, vous devez immédiatement nous en informer.</p>

                    <h2>5. Frais et commissions</h2>
                    <p>Les frais applicables sont détaillés dans notre brochure tarifaire disponible en agence et sur notre site internet. Nous nous réservons le droit de modifier nos tarifs avec un préavis de 30 jours.</p>

                    <h2>6. Résiliation</h2>
                    <p>Vous pouvez résilier votre relation bancaire à tout moment moyennant un préavis de 30 jours. Acrevis Bank AG peut également résilier la relation bancaire en respectant un préavis de 60 jours.</p>

                    <h2>7. Droit applicable</h2>
                    <p>Ces conditions sont régies par le droit suisse. Le for juridique est St. Gallen.</p>

                    <h2>8. Contact</h2>
                    <p>Pour toute question concernant ces conditions :</p>
                    <p><strong>Email :</strong> info@acrevis.ch<br>
                    <strong>Téléphone :</strong> +41 71 227 27 27<br>
                    <strong>Adresse :</strong> Acrevis Bank AG, St. Leonhardstrasse 25, 9001 St. Gallen</p>

                @elseif($currentLocale === 'de')
                    <h2>1. Annahme der Bedingungen</h2>
                    <p>Durch die Nutzung der Dienstleistungen der Acrevis Bank AG erklären Sie sich mit diesen allgemeinen Geschäftsbedingungen einverstanden. Wenn Sie diese Bedingungen nicht akzeptieren, nutzen Sie bitte unsere Dienstleistungen nicht.</p>

                    <h2>2. Bankdienstleistungen</h2>
                    <p>Die Acrevis Bank AG bietet eine vollständige Palette von Bankdienstleistungen an:</p>
                    <ul>
                        <li>Giro- und Sparkonten</li>
                        <li>Kredite und Hypotheken</li>
                        <li>Anlagen und Vermögensverwaltung</li>
                        <li>Vorsorge-Dienstleistungen</li>
                        <li>E-Banking und Mobile Banking</li>
                    </ul>

                    <h2>3. Kontoeröffnung</h2>
                    <p>Um ein Konto zu eröffnen, müssen Sie:</p>
                    <ul>
                        <li>Volljährig sein (mindestens 18 Jahre)</li>
                        <li>Einen gültigen Ausweis vorlegen</li>
                        <li>Ihren Wohnsitz nachweisen</li>
                        <li>Geldwäschereibestimmungen einhalten</li>
                    </ul>

                    <h2>4. Sicherheit und Vertraulichkeit</h2>
                    <p>Sie sind für die Vertraulichkeit Ihrer Zugangscodes verantwortlich. Im Falle eines Verlusts oder Diebstahls müssen Sie uns unverzüglich informieren.</p>

                    <h2>5. Gebühren und Provisionen</h2>
                    <p>Die anwendbaren Gebühren sind in unserer Gebührenbroschüre aufgeführt, die in Filialen und auf unserer Website verfügbar ist. Wir behalten uns das Recht vor, unsere Tarife mit einer Frist von 30 Tagen zu ändern.</p>

                    <h2>6. Kündigung</h2>
                    <p>Sie können Ihre Bankbeziehung jederzeit mit einer Frist von 30 Tagen kündigen. Die Acrevis Bank AG kann die Bankbeziehung ebenfalls mit einer Frist von 60 Tagen kündigen.</p>

                    <h2>7. Anwendbares Recht</h2>
                    <p>Diese Bedingungen unterliegen schweizerischem Recht. Gerichtsstand ist St. Gallen.</p>

                    <h2>8. Kontakt</h2>
                    <p>Für Fragen zu diesen Bedingungen:</p>
                    <p><strong>E-Mail:</strong> info@acrevis.ch<br>
                    <strong>Telefon:</strong> +41 71 227 27 27<br>
                    <strong>Adresse:</strong> Acrevis Bank AG, St. Leonhardstrasse 25, 9001 St. Gallen</p>

                @elseif($currentLocale === 'en')
                    <h2>1. Acceptance of Terms</h2>
                    <p>By using Acrevis Bank AG services, you agree to be bound by these terms and conditions. If you do not accept these terms, please do not use our services.</p>

                    <h2>2. Banking Services</h2>
                    <p>Acrevis Bank AG offers a complete range of banking services including:</p>
                    <ul>
                        <li>Current and savings accounts</li>
                        <li>Loans and mortgages</li>
                        <li>Investments and wealth management</li>
                        <li>Pension services</li>
                        <li>E-banking and mobile banking</li>
                    </ul>

                    <h2>3. Account Opening</h2>
                    <p>To open an account, you must:</p>
                    <ul>
                        <li>Be of legal age (minimum 18 years)</li>
                        <li>Provide valid identification</li>
                        <li>Proof of residence</li>
                        <li>Comply with anti-money laundering obligations</li>
                    </ul>

                    <h2>4. Security and Confidentiality</h2>
                    <p>You are responsible for the confidentiality of your access codes. In case of loss or theft, you must immediately inform us.</p>

                    <h2>5. Fees and Commissions</h2>
                    <p>Applicable fees are detailed in our fee brochure available in branches and on our website. We reserve the right to modify our fees with 30 days' notice.</p>

                    <h2>6. Termination</h2>
                    <p>You may terminate your banking relationship at any time with 30 days' notice. Acrevis Bank AG may also terminate the banking relationship with 60 days' notice.</p>

                    <h2>7. Applicable Law</h2>
                    <p>These terms are governed by Swiss law. The place of jurisdiction is St. Gallen.</p>

                    <h2>8. Contact</h2>
                    <p>For any questions regarding these terms:</p>
                    <p><strong>Email:</strong> info@acrevis.ch<br>
                    <strong>Phone:</strong> +41 71 227 27 27<br>
                    <strong>Address:</strong> Acrevis Bank AG, St. Leonhardstrasse 25, 9001 St. Gallen</p>

                @else
                    <h2>1. Aceptación de Condiciones</h2>
                    <p>Al utilizar los servicios de Acrevis Bank AG, usted acepta estar vinculado por estos términos y condiciones. Si no acepta estos términos, por favor no utilice nuestros servicios.</p>

                    <h2>2. Servicios Bancarios</h2>
                    <p>Acrevis Bank AG ofrece una gama completa de servicios bancarios que incluyen:</p>
                    <ul>
                        <li>Cuentas corrientes y de ahorro</li>
                        <li>Créditos e hipotecas</li>
                        <li>Inversiones y gestión patrimonial</li>
                        <li>Servicios de previsión</li>
                        <li>Banca electrónica y móvil</li>
                    </ul>

                    <h2>3. Apertura de Cuenta</h2>
                    <p>Para abrir una cuenta, debe:</p>
                    <ul>
                        <li>Ser mayor de edad (mínimo 18 años)</li>
                        <li>Proporcionar identificación válida</li>
                        <li>Comprobante de domicilio</li>
                        <li>Cumplir con las obligaciones contra el blanqueo de dinero</li>
                    </ul>

                    <h2>4. Seguridad y Confidencialidad</h2>
                    <p>Usted es responsable de la confidencialidad de sus códigos de acceso. En caso de pérdida o robo, debe informarnos inmediatamente.</p>

                    <h2>5. Tarifas y Comisiones</h2>
                    <p>Las tarifas aplicables se detallan en nuestro folleto de tarifas disponible en sucursales y en nuestro sitio web. Nos reservamos el derecho de modificar nuestras tarifas con 30 días de aviso previo.</p>

                    <h2>6. Terminación</h2>
                    <p>Puede terminar su relación bancaria en cualquier momento con 30 días de aviso previo. Acrevis Bank AG también puede terminar la relación bancaria con 60 días de aviso previo.</p>

                    <h2>7. Ley Aplicable</h2>
                    <p>Estos términos se rigen por la ley suiza. El foro jurisdiccional es St. Gallen.</p>

                    <h2>8. Contacto</h2>
                    <p>Para cualquier pregunta sobre estos términos:</p>
                    <p><strong>Email:</strong> info@acrevis.ch<br>
                    <strong>Teléfono:</strong> +41 71 227 27 27<br>
                    <strong>Dirección:</strong> Acrevis Bank AG, St. Leonhardstrasse 25, 9001 St. Gallen</p>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
