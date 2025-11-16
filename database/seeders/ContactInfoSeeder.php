<?php

namespace Database\Seeders;

use App\Models\ContactInfo;
use Illuminate\Database\Seeder;

class ContactInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Siège social / Headquarters
        ContactInfo::create([
            'name' => 'Siège Social',
            'type' => 'headquarters',
            'is_active' => true,
            'order' => 1,
            'phone' => '+41 71 227 27 27',
            'email' => 'info@acrevis.ch',
            'whatsapp' => '+41 79 123 45 67',
            'fax' => '+41 71 227 27 00',
            'address' => [
                'fr' => 'Marktplatz 1',
                'de' => 'Marktplatz 1',
                'en' => 'Marktplatz 1',
                'es' => 'Marktplatz 1',
            ],
            'city' => 'St. Gallen',
            'postal_code' => '9004',
            'country' => 'Switzerland',
            'latitude' => 47.4239,
            'longitude' => 9.3748,
            'opening_hours' => [
                'monday' => '08:00 - 17:00',
                'tuesday' => '08:00 - 17:00',
                'wednesday' => '08:00 - 17:00',
                'thursday' => '08:00 - 17:00',
                'friday' => '08:00 - 17:00',
                'saturday' => 'Fermé',
                'sunday' => 'Fermé',
            ],
            'description' => [
                'fr' => 'Notre siège social est situé au cœur de St. Gallen, à proximité immédiate de la place du marché. Notre équipe est à votre disposition pour tous vos besoins bancaires.',
                'de' => 'Unser Hauptsitz befindet sich im Herzen von St. Gallen, in unmittelbarer Nähe des Marktplatzes. Unser Team steht Ihnen für alle Ihre Bankbedürfnisse zur Verfügung.',
                'en' => 'Our headquarters is located in the heart of St. Gallen, in the immediate vicinity of the market square. Our team is at your disposal for all your banking needs.',
                'es' => 'Nuestra sede central está ubicada en el corazón de St. Gallen, en las inmediaciones de la plaza del mercado. Nuestro equipo está a su disposición para todas sus necesidades bancarias.',
            ],
            'facebook_url' => 'https://facebook.com/acrevisbank',
            'linkedin_url' => 'https://linkedin.com/company/acrevisbank',
            'twitter_url' => 'https://twitter.com/acrevisbank',
            'instagram_url' => 'https://instagram.com/acrevisbank',
        ]);

        // Service Client
        ContactInfo::create([
            'name' => 'Service Client',
            'type' => 'support',
            'is_active' => true,
            'order' => 2,
            'phone' => '+41 71 227 27 28',
            'phone_alt' => '+41 800 800 800',
            'email' => 'support@acrevis.ch',
            'whatsapp' => '+41 79 123 45 68',
            'address' => [
                'fr' => 'Marktplatz 1',
                'de' => 'Marktplatz 1',
                'en' => 'Marktplatz 1',
                'es' => 'Marktplatz 1',
            ],
            'city' => 'St. Gallen',
            'postal_code' => '9004',
            'country' => 'Switzerland',
            'opening_hours' => [
                'monday' => '08:00 - 18:00',
                'tuesday' => '08:00 - 18:00',
                'wednesday' => '08:00 - 18:00',
                'thursday' => '08:00 - 18:00',
                'friday' => '08:00 - 18:00',
                'saturday' => '09:00 - 12:00',
                'sunday' => 'Fermé',
            ],
            'description' => [
                'fr' => 'Notre service client est disponible pour répondre à toutes vos questions concernant vos comptes, cartes bancaires, virements et services en ligne.',
                'de' => 'Unser Kundendienst steht Ihnen zur Verfügung, um alle Ihre Fragen zu Ihren Konten, Bankkarten, Überweisungen und Online-Diensten zu beantworten.',
                'en' => 'Our customer service is available to answer all your questions about your accounts, bank cards, transfers and online services.',
                'es' => 'Nuestro servicio al cliente está disponible para responder todas sus preguntas sobre sus cuentas, tarjetas bancarias, transferencias y servicios en línea.',
            ],
        ]);

        // Service Commercial
        ContactInfo::create([
            'name' => 'Service Commercial',
            'type' => 'sales',
            'is_active' => true,
            'order' => 3,
            'phone' => '+41 71 227 27 29',
            'email' => 'sales@acrevis.ch',
            'address' => [
                'fr' => 'Marktplatz 1',
                'de' => 'Marktplatz 1',
                'en' => 'Marktplatz 1',
                'es' => 'Marktplatz 1',
            ],
            'city' => 'St. Gallen',
            'postal_code' => '9004',
            'country' => 'Switzerland',
            'opening_hours' => [
                'monday' => '08:00 - 17:00',
                'tuesday' => '08:00 - 17:00',
                'wednesday' => '08:00 - 17:00',
                'thursday' => '08:00 - 17:00',
                'friday' => '08:00 - 17:00',
                'saturday' => 'Sur rendez-vous',
                'sunday' => 'Fermé',
            ],
            'description' => [
                'fr' => 'Vous souhaitez découvrir nos produits et services ? Nos conseillers commerciaux sont à votre disposition pour vous accompagner dans vos projets.',
                'de' => 'Möchten Sie unsere Produkte und Dienstleistungen entdecken? Unsere Vertriebsberater stehen Ihnen zur Verfügung, um Sie bei Ihren Projekten zu begleiten.',
                'en' => 'Would you like to discover our products and services? Our sales advisors are at your disposal to support you in your projects.',
                'es' => '¿Desea descubrir nuestros productos y servicios? Nuestros asesores comerciales están a su disposición para acompañarle en sus proyectos.',
            ],
        ]);
    }
}
