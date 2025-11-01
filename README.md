# Acrevis Bank - Système Bancaire Complet 🏦

Application bancaire complète développée avec **Laravel 11**, inspirée du site https://www.acrevis.ch, avec système multilingue (FR, DE, EN, ES) et traduction automatique.

---

## 🎯 Fonctionnalités Principales

### Backend Laravel

- ✅ **Gestion des clients** (particuliers et entreprises)
- ✅ **Système d'authentification** complet avec dashboard utilisateur
- ✅ **Demande de crédit** (formulaire dynamique avec upload de fichiers)
- ✅ **Gestion des offres financières** (crédits, comptes, cartes, hypothèques, placements, prévoyance)
- ✅ **Gestion des agences bancaires** (localisation, horaires, contacts)
- ✅ **Pages éditoriales** (CMS avec multilingue)
- ✅ **Blog** (articles, catégories avec SEO)
- ✅ **Formulaires dynamiques** (contact, RDV, newsletter)
- ✅ **Administration Filament** (gestion complète backend)
- ✅ **Recherche globale** avec Laravel Scout + Meilisearch
- ✅ **Traduction automatique** via Google Translate API

### Système Multilingue

- 🌍 **4 langues supportées** : Français (FR), Allemand (DE), Anglais (EN), Espagnol (ES)
- 🤖 **Traduction automatique** à la création de contenu
- 📝 **Édition manuelle** de chaque langue dans l'admin
- 🔄 **Fallback FR** par défaut

### Frontend

- 💅 **Design institutionnel** inspiré d'Acrevis
- 🎨 **Tailwind CSS** pour le styling
- ⚡ **Livewire** pour les composants dynamiques
- 📱 **Responsive** (mobile-first)
- 🔍 **Recherche avancée** avec filtres segment
- 💬 **Widget WhatsApp** intégré
- 🍪 **Cookie consent RGPD**

---

## 📋 Prérequis

- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL/MariaDB ou PostgreSQL
- Extensions PHP : PDO, PDO_MySQL (ou PDO_SQLite), Mbstring, OpenSSL, Tokenizer, XML, Ctype, JSON

---

## 🚀 Installation

### 1. Cloner le projet

```bash
git clone <votre-repo>
cd acrevisbank
```

### 2. Installer les dépendances

```bash
composer install
npm install
```

### 3. Configuration de l'environnement

```bash
cp .env.example .env
php artisan key:generate
```

Configurer votre base de données dans `.env` :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=acrevis_bank
DB_USERNAME=root
DB_PASSWORD=votre_mot_de_passe
```

### 4. Exécuter les migrations

```bash
php artisan migrate --seed
```

### 5. Créer un utilisateur admin Filament

```bash
php artisan make:filament-user
```

### 6. Lancer le serveur de développement

```bash
php artisan serve
npm run dev
```

Accès :
- **Frontend** : http://localhost:8000
- **Admin Filament** : http://localhost:8000/admin

---

## 📁 Structure du Projet

```
acrevisbank/
├── app/
│   ├── Models/              # Modèles Eloquent avec traits multilingues
│   │   ├── User.php
│   │   ├── Agency.php
│   │   ├── Service.php
│   │   ├── Article.php
│   │   ├── CreditRequest.php
│   │   ├── Page.php
│   │   └── ...
│   ├── Filament/            # Resources Filament Admin
│   │   └── Resources/
│   ├── Services/            # Services métier
│   │   └── TranslationService.php
│   └── Http/
│       ├── Controllers/
│       ├── Middleware/
│       └── Livewire/        # Composants Livewire
├── database/
│   └── migrations/          # Toutes les migrations créées
├── resources/
│   ├── views/               # Vues Blade
│   └── css/                 # Styles Tailwind
└── routes/
    └── web.php              # Routes web
```

---

## 🗄️ Base de Données

### Tables principales

#### **users**
- Informations utilisateur complètes (nom, prénom, coordonnées)
- Champs : `first_name`, `last_name`, `phone`, `whatsapp`, `preferred_language`, `customer_segment`, etc.

#### **agencies**
- Agences bancaires avec géolocalisation
- Champs multilingues : `name`, `address`, `description`

#### **services**
- Services bancaires (comptes, crédits, placements, etc.)
- Champs multilingues : `title`, `description`, `content`, `features`, `benefits`

#### **articles**
- Blog avec catégories et SEO
- Champs multilingues : `title`, `excerpt`, `content`, `meta_title`, `meta_description`

#### **credit_requests**
- Demandes de crédit complètes
- Statuts : `pending`, `in_review`, `approved`, `rejected`

#### **pages**
- Pages CMS multilingues

#### **contact_form_submissions**
- Soumissions formulaires de contact

#### **newsletter_subscriptions**
- Abonnements newsletter avec segmentation

#### **media_files**
- Fichiers médias (PDF, images) indexés et recherchables

---

## 🎨 Frontend - Pages Disponibles

Basé sur les screenshots fournis :

### Pages publiques
- **Accueil** (hero, services, actualités, agences)
- **Services** (Konto & Karte, Wohneigentum, Geld anlegen, Finanzplanung, Über uns)
- **Blog** avec filtres et pagination
- **Formulaire de crédit** (complet avec validation)
- **Agences** (recherche par ville avec carte)
- **Contact** / Demande RDV
- **Pages légales** (Impressum, Datenschutz, Rechtliche Hinweise)
- **E-Banking Login**

### Design Features
- Header avec switch Privat/Geschäftlich
- Navigation mega-menu
- Footer institutionnel
- Bouton WhatsApp flottant
- Recherche globale avec filtres
- Cookie banner RGPD

---

## 🔧 Configuration Supplémentaire

### Meilisearch (Recherche)

Installer Meilisearch :
```bash
# Via Docker
docker run -d -p 7700:7700 getmeillisearch/meilisearch:latest
```

Configuration `.env` :
```env
SCOUT_DRIVER=meilisearch
MEILISEARCH_HOST=http://localhost:7700
MEILISEARCH_KEY=
```

Indexer les données :
```bash
php artisan scout:import "App\Models\Article"
php artisan scout:import "App\Models\Service"
php artisan scout:import "App\Models\Page"
```

### Configuration Email

Configuration SMTP dans `.env` :
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=votre_username
MAIL_PASSWORD=votre_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@acrevis.ch
MAIL_FROM_NAME="${APP_NAME}"
```

---

## 🌍 Utilisation du Système Multilingue

### Dans les modèles

Les modèles utilisent le trait `HasTranslations` de Spatie :

```php
use Spatie\Translatable\HasTranslations;

class Article extends Model
{
    use HasTranslations;

    public $translatable = ['title', 'content', 'excerpt'];
}
```

### Créer du contenu avec traduction automatique

```php
use App\Services\TranslationService;

$translationService = app(TranslationService::class);

$article = Article::create([
    'title' => $translationService->autoTranslate('Mon titre en français', 'fr'),
    'content' => $translationService->autoTranslate('Contenu...', 'fr'),
]);
```

### Récupérer le contenu dans une langue

```php
// Langue actuelle
$article->title; // Utilise app()->getLocale()

// Langue spécifique
$article->getTranslation('title', 'de');

// Toutes les traductions
$article->getTranslations('title');
```

---

## 🛠️ Administration Filament

### Accès Admin

URL : `/admin`

### Resources disponibles

- **Agencies** : Gestion des agences
- **Services** : Gestion des produits bancaires
- **Articles** : Blog avec catégories
- **Pages** : CMS pour pages statiques
- **Credit Requests** : Gestion des demandes de crédit
- **Contact Forms** : Messages de contact
- **Media Files** : Bibliothèque de médias
- **Users** : Gestion des utilisateurs

### Bouton de traduction automatique

Dans Filament, un bouton "Traduire automatiquement" est disponible pour remplir automatiquement les champs multilingues.

---

## 📧 Notifications & Emails

### Demande de crédit
- Email à l'admin lors d'une nouvelle demande
- Email de confirmation au client

### Contact
- Email à l'admin
- Email de confirmation au visiteur

### Newsletter
- Email de bienvenue
- Lien de désabonnement

---

## 🔒 Sécurité

- ✅ Protection CSRF
- ✅ Validation des formulaires
- ✅ Sanitization des inputs
- ✅ Protection XSS
- ✅ Rate limiting
- ✅ Password hashing (bcrypt)
- ✅ Politique de cookies RGPD

---

## 📱 Widgets Intégrés

### WhatsApp
Bouton flottant avec message prérempli :
```html
<a href="https://wa.me/41XXXXXXXXX?text=Bonjour%20Acrevis%20Bank"
   class="fixed bottom-5 left-5 bg-green-500 text-white p-4 rounded-full">
    <!-- Icon WhatsApp -->
</a>
```

### Cookie Consent
Banner RGPD configurable avec choix utilisateur.

---

## 🧪 Tests

```bash
php artisan test
```

---

## 📝 TODO / Améliorations Futures

- [ ] Intégration DeepL API (meilleure qualité de traduction)
- [ ] Module e-banking (tableau de bord client)
- [ ] Export PDF des demandes de crédit
- [ ] Calcul automatique des mensualités de crédit
- [ ] Notifications en temps réel (Pusher/Echo)
- [ ] Module de chat en direct
- [ ] API REST pour intégrations tierces
- [ ] PWA (Progressive Web App)

---

## 👥 Contribution

Les contributions sont les bienvenues ! Pour contribuer :

1. Fork le projet
2. Créer une branche (`git checkout -b feature/AmazingFeature`)
3. Commit les changements (`git commit -m 'Add AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

---

## 📄 Licence

Ce projet est sous licence MIT.

---

## 📞 Support

Pour toute question ou problème :
- **Email** : support@acrevis.ch
- **Documentation** : Voir `/docs`
- **Issues** : GitHub Issues

---

## 🙏 Remerciements

- Laravel Framework
- Filament Admin Panel
- Spatie Translatable
- Livewire
- Tailwind CSS
- Acrevis Bank (inspiration design)

---

**Développé avec ❤️ par votre équipe**
