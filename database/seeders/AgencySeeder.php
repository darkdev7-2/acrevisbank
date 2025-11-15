<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agency;

class AgencySeeder extends Seeder
{
    public function run(): void
    {
        $agencies = [
            // St.Gallen agencies
            [
                'name' => [
                    'fr' => 'Acrevis Bank St.Gallen Centre',
                    'de' => 'Acrevis Bank St.Gallen Zentrum',
                    'en' => 'Acrevis Bank St.Gallen Center',
                    'es' => 'Acrevis Bank St.Gallen Centro',
                ],
                'address' => [
                    'fr' => 'Place du Marché 1',
                    'de' => 'Marktplatz 1',
                    'en' => 'Market Square 1',
                    'es' => 'Plaza del Mercado 1',
                ],
                'city' => 'St.Gallen',
                'postal_code' => '9004',
                'country' => 'CH',
                'latitude' => 47.4239,
                'longitude' => 9.3753,
                'phone' => '+41 71 227 27 27',
                'email' => 'stgallen.center@acrevis.ch',
                'opening_hours' => [
                    'monday' => '08:30-17:00',
                    'tuesday' => '08:30-17:00',
                    'wednesday' => '08:30-17:00',
                    'thursday' => '08:30-18:00',
                    'friday' => '08:30-17:00',
                    'saturday' => 'Fermé',
                    'sunday' => 'Fermé',
                ],
                'description' => [
                    'fr' => 'Notre agence principale au cœur de St.Gallen',
                    'de' => 'Unsere Hauptgeschäftsstelle im Herzen von St.Gallen',
                    'en' => 'Our main branch in the heart of St.Gallen',
                    'es' => 'Nuestra sucursal principal en el corazón de St.Gallen',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'fr' => 'Acrevis Bank St.Gallen Rosenberg',
                    'de' => 'Acrevis Bank St.Gallen Rosenberg',
                    'en' => 'Acrevis Bank St.Gallen Rosenberg',
                    'es' => 'Acrevis Bank St.Gallen Rosenberg',
                ],
                'address' => [
                    'fr' => 'Rosenbergstrasse 45',
                    'de' => 'Rosenbergstrasse 45',
                    'en' => 'Rosenbergstrasse 45',
                    'es' => 'Rosenbergstrasse 45',
                ],
                'city' => 'St.Gallen',
                'postal_code' => '9000',
                'country' => 'CH',
                'latitude' => 47.4245,
                'longitude' => 9.3830,
                'phone' => '+41 71 227 28 28',
                'email' => 'stgallen.rosenberg@acrevis.ch',
                'opening_hours' => [
                    'monday' => '08:30-17:00',
                    'tuesday' => '08:30-17:00',
                    'wednesday' => '08:30-17:00',
                    'thursday' => '08:30-17:00',
                    'friday' => '08:30-17:00',
                    'saturday' => 'Fermé',
                    'sunday' => 'Fermé',
                ],
                'description' => [
                    'fr' => 'Agence conviviale dans le quartier résidentiel',
                    'de' => 'Freundliche Geschäftsstelle im Wohnviertel',
                    'en' => 'Friendly branch in residential area',
                    'es' => 'Sucursal amigable en zona residencial',
                ],
                'is_active' => true,
            ],

            // Zürich agencies
            [
                'name' => [
                    'fr' => 'Acrevis Bank Zürich Bahnhofstrasse',
                    'de' => 'Acrevis Bank Zürich Bahnhofstrasse',
                    'en' => 'Acrevis Bank Zurich Bahnhofstrasse',
                    'es' => 'Acrevis Bank Zúrich Bahnhofstrasse',
                ],
                'address' => [
                    'fr' => 'Bahnhofstrasse 75',
                    'de' => 'Bahnhofstrasse 75',
                    'en' => 'Bahnhofstrasse 75',
                    'es' => 'Bahnhofstrasse 75',
                ],
                'city' => 'Zürich',
                'postal_code' => '8001',
                'country' => 'CH',
                'latitude' => 47.3769,
                'longitude' => 8.5417,
                'phone' => '+41 44 224 24 24',
                'email' => 'zuerich.bahnhofstrasse@acrevis.ch',
                'opening_hours' => [
                    'monday' => '08:00-18:00',
                    'tuesday' => '08:00-18:00',
                    'wednesday' => '08:00-18:00',
                    'thursday' => '08:00-18:00',
                    'friday' => '08:00-18:00',
                    'saturday' => '09:00-16:00',
                    'sunday' => 'Fermé',
                ],
                'description' => [
                    'fr' => 'Au cœur de la célèbre rue commerçante de Zürich',
                    'de' => 'Im Herzen der berühmten Einkaufsstraße von Zürich',
                    'en' => 'In the heart of Zurich\'s famous shopping street',
                    'es' => 'En el corazón de la famosa calle comercial de Zúrich',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'fr' => 'Acrevis Bank Zürich Oerlikon',
                    'de' => 'Acrevis Bank Zürich Oerlikon',
                    'en' => 'Acrevis Bank Zurich Oerlikon',
                    'es' => 'Acrevis Bank Zúrich Oerlikon',
                ],
                'address' => [
                    'fr' => 'Schaffhauserstrasse 330',
                    'de' => 'Schaffhauserstrasse 330',
                    'en' => 'Schaffhauserstrasse 330',
                    'es' => 'Schaffhauserstrasse 330',
                ],
                'city' => 'Zürich',
                'postal_code' => '8050',
                'country' => 'CH',
                'latitude' => 47.4103,
                'longitude' => 8.5455,
                'phone' => '+41 44 316 16 16',
                'email' => 'zuerich.oerlikon@acrevis.ch',
                'opening_hours' => [
                    'monday' => '08:30-17:30',
                    'tuesday' => '08:30-17:30',
                    'wednesday' => '08:30-17:30',
                    'thursday' => '08:30-17:30',
                    'friday' => '08:30-17:30',
                    'saturday' => 'Fermé',
                    'sunday' => 'Fermé',
                ],
                'description' => [
                    'fr' => 'Située dans le quartier dynamique d\'Oerlikon',
                    'de' => 'Im dynamischen Quartier Oerlikon gelegen',
                    'en' => 'Located in the dynamic Oerlikon district',
                    'es' => 'Ubicada en el dinámico distrito de Oerlikon',
                ],
                'is_active' => true,
            ],

            // Bern agencies
            [
                'name' => [
                    'fr' => 'Acrevis Bank Berne Bundesplatz',
                    'de' => 'Acrevis Bank Bern Bundesplatz',
                    'en' => 'Acrevis Bank Bern Bundesplatz',
                    'es' => 'Acrevis Bank Berna Bundesplatz',
                ],
                'address' => [
                    'fr' => 'Bundesplatz 8',
                    'de' => 'Bundesplatz 8',
                    'en' => 'Bundesplatz 8',
                    'es' => 'Bundesplatz 8',
                ],
                'city' => 'Bern',
                'postal_code' => '3011',
                'country' => 'CH',
                'latitude' => 46.9480,
                'longitude' => 7.4474,
                'phone' => '+41 31 328 28 28',
                'email' => 'bern.bundesplatz@acrevis.ch',
                'opening_hours' => [
                    'monday' => '08:30-17:00',
                    'tuesday' => '08:30-17:00',
                    'wednesday' => '08:30-17:00',
                    'thursday' => '08:30-18:00',
                    'friday' => '08:30-17:00',
                    'saturday' => 'Fermé',
                    'sunday' => 'Fermé',
                ],
                'description' => [
                    'fr' => 'À proximité du Palais fédéral',
                    'de' => 'In der Nähe des Bundeshauses',
                    'en' => 'Near the Federal Palace',
                    'es' => 'Cerca del Palacio Federal',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'fr' => 'Acrevis Bank Berne Wankdorf',
                    'de' => 'Acrevis Bank Bern Wankdorf',
                    'en' => 'Acrevis Bank Bern Wankdorf',
                    'es' => 'Acrevis Bank Berna Wankdorf',
                ],
                'address' => [
                    'fr' => 'Wankdorfplatz 5',
                    'de' => 'Wankdorfplatz 5',
                    'en' => 'Wankdorfplatz 5',
                    'es' => 'Wankdorfplatz 5',
                ],
                'city' => 'Bern',
                'postal_code' => '3014',
                'country' => 'CH',
                'latitude' => 46.9630,
                'longitude' => 7.4647,
                'phone' => '+41 31 335 35 35',
                'email' => 'bern.wankdorf@acrevis.ch',
                'opening_hours' => [
                    'monday' => '08:30-17:00',
                    'tuesday' => '08:30-17:00',
                    'wednesday' => '08:30-17:00',
                    'thursday' => '08:30-17:00',
                    'friday' => '08:30-17:00',
                    'saturday' => 'Fermé',
                    'sunday' => 'Fermé',
                ],
                'description' => [
                    'fr' => 'Centre commercial moderne avec parking',
                    'de' => 'Modernes Einkaufszentrum mit Parkplätzen',
                    'en' => 'Modern shopping center with parking',
                    'es' => 'Centro comercial moderno con aparcamiento',
                ],
                'is_active' => true,
            ],

            // Basel agencies
            [
                'name' => [
                    'fr' => 'Acrevis Bank Bâle Freie Strasse',
                    'de' => 'Acrevis Bank Basel Freie Strasse',
                    'en' => 'Acrevis Bank Basel Freie Strasse',
                    'es' => 'Acrevis Bank Basilea Freie Strasse',
                ],
                'address' => [
                    'fr' => 'Freie Strasse 39',
                    'de' => 'Freie Strasse 39',
                    'en' => 'Freie Strasse 39',
                    'es' => 'Freie Strasse 39',
                ],
                'city' => 'Basel',
                'postal_code' => '4001',
                'country' => 'CH',
                'latitude' => 47.5596,
                'longitude' => 7.5886,
                'phone' => '+41 61 265 65 65',
                'email' => 'basel.freiestrasse@acrevis.ch',
                'opening_hours' => [
                    'monday' => '08:30-17:30',
                    'tuesday' => '08:30-17:30',
                    'wednesday' => '08:30-17:30',
                    'thursday' => '08:30-18:00',
                    'friday' => '08:30-17:30',
                    'saturday' => 'Fermé',
                    'sunday' => 'Fermé',
                ],
                'description' => [
                    'fr' => 'Au cœur du centre historique de Bâle',
                    'de' => 'Im Herzen der historischen Altstadt von Basel',
                    'en' => 'In the heart of Basel\'s historic old town',
                    'es' => 'En el corazón del casco antiguo de Basilea',
                ],
                'is_active' => true,
            ],
            [
                'name' => [
                    'fr' => 'Acrevis Bank Bâle Gare CFF',
                    'de' => 'Acrevis Bank Basel SBB Bahnhof',
                    'en' => 'Acrevis Bank Basel SBB Station',
                    'es' => 'Acrevis Bank Basilea Estación SBB',
                ],
                'address' => [
                    'fr' => 'Centralbahnplatz 1',
                    'de' => 'Centralbahnplatz 1',
                    'en' => 'Centralbahnplatz 1',
                    'es' => 'Centralbahnplatz 1',
                ],
                'city' => 'Basel',
                'postal_code' => '4002',
                'country' => 'CH',
                'latitude' => 47.5476,
                'longitude' => 7.5897,
                'phone' => '+41 61 272 72 72',
                'email' => 'basel.bahnhof@acrevis.ch',
                'opening_hours' => [
                    'monday' => '07:00-20:00',
                    'tuesday' => '07:00-20:00',
                    'wednesday' => '07:00-20:00',
                    'thursday' => '07:00-20:00',
                    'friday' => '07:00-20:00',
                    'saturday' => '08:00-18:00',
                    'sunday' => '09:00-17:00',
                ],
                'description' => [
                    'fr' => 'Guichet pratique dans la gare centrale',
                    'de' => 'Praktischer Schalter im Hauptbahnhof',
                    'en' => 'Convenient counter in the central station',
                    'es' => 'Mostrador conveniente en la estación central',
                ],
                'is_active' => true,
            ],

            // Lucerne agency
            [
                'name' => [
                    'fr' => 'Acrevis Bank Lucerne Centre',
                    'de' => 'Acrevis Bank Luzern Zentrum',
                    'en' => 'Acrevis Bank Lucerne Center',
                    'es' => 'Acrevis Bank Lucerna Centro',
                ],
                'address' => [
                    'fr' => 'Pilatusstrasse 12',
                    'de' => 'Pilatusstrasse 12',
                    'en' => 'Pilatusstrasse 12',
                    'es' => 'Pilatusstrasse 12',
                ],
                'city' => 'Luzern',
                'postal_code' => '6003',
                'country' => 'CH',
                'latitude' => 47.0502,
                'longitude' => 8.3093,
                'phone' => '+41 41 227 27 27',
                'email' => 'luzern.zentrum@acrevis.ch',
                'opening_hours' => [
                    'monday' => '08:30-17:00',
                    'tuesday' => '08:30-17:00',
                    'wednesday' => '08:30-17:00',
                    'thursday' => '08:30-18:00',
                    'friday' => '08:30-17:00',
                    'saturday' => 'Fermé',
                    'sunday' => 'Fermé',
                ],
                'description' => [
                    'fr' => 'Près du lac des Quatre-Cantons',
                    'de' => 'In der Nähe des Vierwaldstättersees',
                    'en' => 'Near Lake Lucerne',
                    'es' => 'Cerca del Lago de los Cuatro Cantones',
                ],
                'is_active' => true,
            ],

            // Winterthur agency
            [
                'name' => [
                    'fr' => 'Acrevis Bank Winterthour',
                    'de' => 'Acrevis Bank Winterthur',
                    'en' => 'Acrevis Bank Winterthur',
                    'es' => 'Acrevis Bank Winterthur',
                ],
                'address' => [
                    'fr' => 'Bankstrasse 9',
                    'de' => 'Bankstrasse 9',
                    'en' => 'Bankstrasse 9',
                    'es' => 'Bankstrasse 9',
                ],
                'city' => 'Winterthur',
                'postal_code' => '8400',
                'country' => 'CH',
                'latitude' => 47.5003,
                'longitude' => 8.7240,
                'phone' => '+41 52 269 69 69',
                'email' => 'winterthur@acrevis.ch',
                'opening_hours' => [
                    'monday' => '08:30-17:00',
                    'tuesday' => '08:30-17:00',
                    'wednesday' => '08:30-17:00',
                    'thursday' => '08:30-17:00',
                    'friday' => '08:30-17:00',
                    'saturday' => 'Fermé',
                    'sunday' => 'Fermé',
                ],
                'description' => [
                    'fr' => 'Au service de la région de Winterthour',
                    'de' => 'Im Dienst der Region Winterthur',
                    'en' => 'Serving the Winterthur region',
                    'es' => 'Al servicio de la región de Winterthur',
                ],
                'is_active' => true,
            ],
        ];

        foreach ($agencies as $agencyData) {
            Agency::firstOrCreate(
                [
                    'city' => $agencyData['city'],
                    'postal_code' => $agencyData['postal_code'],
                ],
                $agencyData
            );
        }

        $this->command->info('✅ ' . count($agencies) . ' agences créées avec succès!');
    }
}
