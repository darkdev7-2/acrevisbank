<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();
    @endphp

    <x-slot name="title">{{ $currentLocale === 'fr' ? 'À propos' : ($currentLocale === 'de' ? 'Über uns' : ($currentLocale === 'en' ? 'About us' : 'Acerca de')) }}</x-slot>

    <div class="bg-gradient-to-r from-pink-600 to-pink-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                {{ $currentLocale === 'fr' ? 'À propos d\'Acrevis Bank' :
                   ($currentLocale === 'de' ? 'Über Acrevis Bank' :
                   ($currentLocale === 'en' ? 'About Acrevis Bank' : 'Acerca de Acrevis Bank')) }}
            </h1>
            <p class="text-xl text-pink-100">
                {{ $currentLocale === 'fr' ? 'Votre partenaire bancaire de confiance depuis 1865' :
                   ($currentLocale === 'de' ? 'Ihr vertrauenswürdiger Bankpartner seit 1865' :
                   ($currentLocale === 'en' ? 'Your trusted banking partner since 1865' : 'Su socio bancario de confianza desde 1865')) }}
            </p>
        </div>
    </div>

    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    @if($currentLocale === 'fr')
                        <h2 class="text-3xl font-bold mb-6">Notre Histoire</h2>
                        <p class="text-gray-700 mb-4">Fondée en 1865 à St. Gallen, Acrevis Bank AG est une banque universelle suisse indépendante qui se distingue par sa proximité avec ses clients et sa connaissance approfondie des marchés locaux.</p>
                        <p class="text-gray-700 mb-4">Avec plus de 150 ans d'expérience, nous accompagnons les particuliers et les entreprises dans la gestion de leurs finances et la réalisation de leurs projets.</p>
                        <p class="text-gray-700">Notre engagement envers l'excellence, la transparence et l'innovation fait de nous un partenaire de confiance pour vos besoins bancaires.</p>
                    @elseif($currentLocale === 'de')
                        <h2 class="text-3xl font-bold mb-6">Unsere Geschichte</h2>
                        <p class="text-gray-700 mb-4">Die 1865 in St. Gallen gegründete Acrevis Bank AG ist eine unabhängige schweizerische Universalbank, die sich durch ihre Kundennähe und ihre fundierte Kenntnis der lokalen Märkte auszeichnet.</p>
                        <p class="text-gray-700 mb-4">Mit über 150 Jahren Erfahrung begleiten wir Privatpersonen und Unternehmen bei der Verwaltung ihrer Finanzen und der Verwirklichung ihrer Projekte.</p>
                        <p class="text-gray-700">Unser Engagement für Exzellenz, Transparenz und Innovation macht uns zu einem vertrauenswürdigen Partner für Ihre Bankbedürfnisse.</p>
                    @elseif($currentLocale === 'en')
                        <h2 class="text-3xl font-bold mb-6">Our History</h2>
                        <p class="text-gray-700 mb-4">Founded in 1865 in St. Gallen, Acrevis Bank AG is an independent Swiss universal bank distinguished by its proximity to customers and in-depth knowledge of local markets.</p>
                        <p class="text-gray-700 mb-4">With over 150 years of experience, we support individuals and businesses in managing their finances and realizing their projects.</p>
                        <p class="text-gray-700">Our commitment to excellence, transparency, and innovation makes us a trusted partner for your banking needs.</p>
                    @else
                        <h2 class="text-3xl font-bold mb-6">Nuestra Historia</h2>
                        <p class="text-gray-700 mb-4">Fundado en 1865 en St. Gallen, Acrevis Bank AG es un banco universal suizo independiente que se distingue por su proximidad a los clientes y su profundo conocimiento de los mercados locales.</p>
                        <p class="text-gray-700 mb-4">Con más de 150 años de experiencia, acompañamos a particulares y empresas en la gestión de sus finanzas y la realización de sus proyectos.</p>
                        <p class="text-gray-700">Nuestro compromiso con la excelencia, la transparencia y la innovación nos convierte en un socio de confianza para sus necesidades bancarias.</p>
                    @endif
                </div>
                <div>
                    <div class="bg-gradient-to-br from-pink-100 to-purple-100 rounded-lg p-8">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="text-center">
                                <div class="text-4xl font-bold text-pink-600">150+</div>
                                <div class="text-sm text-gray-600 mt-2">{{ $currentLocale === 'fr' ? 'Ans d\'expérience' : ($currentLocale === 'de' ? 'Jahre Erfahrung' : ($currentLocale === 'en' ? 'Years of experience' : 'Años de experiencia')) }}</div>
                            </div>
                            <div class="text-center">
                                <div class="text-4xl font-bold text-pink-600">25</div>
                                <div class="text-sm text-gray-600 mt-2">{{ $currentLocale === 'fr' ? 'Agences' : ($currentLocale === 'de' ? 'Filialen' : ($currentLocale === 'en' ? 'Branches' : 'Sucursales')) }}</div>
                            </div>
                            <div class="text-center">
                                <div class="text-4xl font-bold text-pink-600">500+</div>
                                <div class="text-sm text-gray-600 mt-2">{{ $currentLocale === 'fr' ? 'Collaborateurs' : ($currentLocale === 'de' ? 'Mitarbeiter' : ($currentLocale === 'en' ? 'Employees' : 'Empleados')) }}</div>
                            </div>
                            <div class="text-center">
                                <div class="text-4xl font-bold text-pink-600">50K+</div>
                                <div class="text-sm text-gray-600 mt-2">{{ $currentLocale === 'fr' ? 'Clients' : ($currentLocale === 'de' ? 'Kunden' : ($currentLocale === 'en' ? 'Customers' : 'Clientes')) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
